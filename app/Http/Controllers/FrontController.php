<?php

namespace App\Http\Controllers;

use App\Models\{Brand, Category, CategoryAttribute, Collection, GiftingOccasion, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProductReview;

class FrontController extends Controller
{
    public function home()
    {
        return view('front-pages.home');
    }

    /*
    |--------------------------------------------------------------------------
    | /products  — all products listing
    |--------------------------------------------------------------------------
    */
    public function products(Request $request)
    {
        // "Explore by Category" pills
        $categories = Category::active()
            ->popular()
            ->withCount(['products', 'subCategoryProducts'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(12)
            ->get();

        // ---------- read filters ----------
        $catSlugs = array_filter((array) $request->input('category', []));
        $categoryIds = $catSlugs ? Category::whereIn('slug', $catSlugs)->pluck('id')->all() : [];

        $priceCeiling = max(500, (int) (ceil(Product::visible()->max('price') / 500) * 500));
        $priceMin = (int) $request->input('price_min', 0);
        $priceMax = (int) $request->input('price_max', $priceCeiling);
        $quick = $request->input('price_quick');
        if ($quick === 'premium') {
            $priceMin = 5000;
            $priceMax = $priceCeiling;
        } elseif (is_numeric($quick)) {
            $priceMin = 0;
            $priceMax = (int) $quick;
        }

        $brands = Brand::orderBy('name')->get(['id', 'name', 'slug']);
        $brandCounts = Product::visible()->selectRaw('brand_id, count(*) as c')->groupBy('brand_id')->pluck('c', 'brand_id');

        $filters = array_merge($this->commonFilters($request), [
            'brand' => $brands->firstWhere('slug', $request->input('brand'))?->id,
            'category_ids' => $categoryIds,
            'price_min' => $priceMin > 0 ? $priceMin : null,
            'price_max' => $priceMax < $priceCeiling ? $priceMax : null,
        ]);

        // ---------- listing ----------
        $listing = Product::visible()
            ->forCard()
            ->filter($filters)
            ->orderForListing($request->input('sort'))
            ->paginate(12)
            ->withQueryString()
            ->fragment('listing');

        $listing->through(fn($p) => $p->toCard());

        // ---------- sidebar data ----------
        $filterCategories = Category::active()->parents()
            ->withCount('products')
            ->with([
                'children' => fn($q) => $q->where('status', 1)
                    ->withCount(['products', 'subCategoryProducts'])
                    ->orderBy('sort_order')->orderBy('name')
            ])
            ->orderBy('sort_order')->orderBy('name')->get();

        $occasionList = GiftingOccasion::where('status', 1)->orderBy('title')->get(['id', 'title as name']);
        $collectionList = Collection::where('status', 1)->orderBy('name')->get(['id', 'name']);

        // attributes: only those flagged show_in_filter; narrowed to the selected categories (+ their parents)
        $scopeCatIds = $categoryIds
            ? Category::whereIn('id', $categoryIds)->get()->flatMap(fn($c) => [$c->id, $c->parent_id])->filter()->unique()->all()
            : null;

        $filterAttributes = $this->filterAttributes($scopeCatIds);

        // ---------- applied chips ----------
        $drop = function ($keys, $value = null) use ($request) {
            $q = $request->except('page');
            foreach ((array) $keys as $k) {
                if ($value === null) {
                    Arr::forget($q, $k);
                    continue;
                }
                $left = array_values(array_diff((array) Arr::get($q, $k, []), [$value]));
                $left ? Arr::set($q, $k, $left) : Arr::forget($q, $k);
            }
            return route('products', $q);
        };

        $catNames = Category::whereIn('slug', $catSlugs)->pluck('name', 'slug');
        $occNames = $occasionList->pluck('name', 'id');
        $colNames = $collectionList->pluck('name', 'id');
        $valueNames = $filterAttributes->flatMap(fn($a) => $a->values)->pluck('value', 'id');

        $applied = [];
        foreach ($catSlugs as $s)
            $applied[] = [$catNames[$s] ?? $s, $drop('category', $s)];
        foreach ($filters['occasion'] as $id)
            if (isset($occNames[$id]))
                $applied[] = [$occNames[$id], $drop('occasion', $id)];
        foreach ($filters['collection'] as $id)
            if (isset($colNames[$id]))
                $applied[] = [$colNames[$id], $drop('collection', $id)];
        foreach ($filters['attrs'] as $attrId => $ids)
            foreach ($ids as $id)
                if (isset($valueNames[$id]))
                    $applied[] = [$valueNames[$id], $drop("attr.$attrId", $id)];
        if ($filters['price_min'] || $filters['price_max'])
            $applied[] = ['₹' . number_format($priceMin) . ' – ₹' . number_format($priceMax), $drop(['price_min', 'price_max', 'price_quick'])];
        if ($filters['rating'])
            $applied[] = [number_format($filters['rating'], 1) . '★ & Above', $drop('rating')];
        if ($filters['discount'])
            $applied[] = [$filters['discount'] . '% & Above', $drop('discount')];
        if ($filters['in_stock'])
            $applied[] = ['In Stock', $drop('in_stock')];

        // ---------- best sellers + recently viewed ----------
        $bestSellers = $this->bestSellers();
        $recentlyViewed = $this->recentlyViewed();

        return view('front-pages.products', compact(
            'categories',
            'listing',
            'brands',
            'brandCounts',
            'filterCategories',
            'occasionList',
            'collectionList',
            'filterAttributes',
            'priceCeiling',
            'priceMin',
            'priceMax',
            'applied',
            'bestSellers',
            'recentlyViewed'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | /categories/{slug}  — category listing (view: front-pages.categories)
    |--------------------------------------------------------------------------
    */
    public function category(Request $request, string $slug)
    {
        $childrenQuery = fn($q) => $q->where('status', 1)->orderBy('sort_order')->orderBy('name');

        $category = Category::active()
            ->where('slug', $slug)
            ->with(['parent', 'children' => $childrenQuery])
            ->firstOrFail();

        // tabs always show the top category's family: "All <root>" + its subcategories
        $root = $category->parent_id
            ? (Category::active()->with(['children' => $childrenQuery])->find($category->parent_id) ?? $category)
            : $category;
        $tabs = $root->children;

        // products of this category (+ its subcategories when it's a parent)
        $familyIds = collect([$category->id])->merge($category->children->pluck('id'))->unique()->all();

        // ---------- filters ----------
        $priceMin = $priceMax = null;
        if ($range = $request->input('price')) {
            if (str_ends_with($range, '+')) {
                $priceMin = (int) $range;
            } else {
                [$from, $to] = array_pad(explode('-', $range, 2), 2, null);
                $priceMin = (int) $from ?: null;
                $priceMax = is_numeric($to) ? (int) $to : null;
            }
        }

        $filters = array_merge($this->commonFilters($request), [
            'category_ids' => $familyIds,
            'price_min' => $priceMin,
            'price_max' => $priceMax,
        ]);

        $listing = Product::visible()
            ->forCard()
            ->filter($filters)
            ->orderForListing($request->input('sort'))
            ->paginate(12)
            ->withQueryString()
            ->fragment('listing');

        $listing->through(fn($p) => $p->toCard());

        // ---------- filter popup data ----------
        $occasionList = GiftingOccasion::where('status', 1)->orderBy('title')->get(['id', 'title as name']);
        $collectionList = Collection::where('status', 1)->orderBy('name')->get(['id', 'name']);

        $attrScopeIds = collect([$category->id, $category->parent_id])
            ->merge($category->children->pluck('id'))->filter()->unique()->all();
        $filterAttributes = $this->filterAttributes($attrScopeIds);

        // ---------- best sellers (this category) + recently viewed ----------
        $bestSellers = $this->bestSellers($familyIds);
        $recentlyViewed = $this->recentlyViewed();

        return view('front-pages.category-detail', compact(
            'category',
            'root',
            'tabs',
            'listing',
            'occasionList',
            'collectionList',
            'filterAttributes',
            'bestSellers',
            'recentlyViewed'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | helpers
    |--------------------------------------------------------------------------
    */

    // filters shared by every listing page
    private function commonFilters(Request $request): array
    {
        return [
            'in_stock' => $request->boolean('in_stock'),
            'occasion' => array_filter((array) $request->input('occasion', [])),
            'collection' => array_filter((array) $request->input('collection', [])),
            'rating' => (float) $request->input('rating') ?: null,
            'discount' => (int) $request->input('discount') ?: null,
            'attrs' => collect($request->input('attr', []))
                ->map(fn($v) => array_filter((array) $v))->filter()->all(),
        ];
    }

    // attributes flagged show_in_filter (optionally only for the given category ids)
    private function filterAttributes(?array $categoryIds)
    {
        return CategoryAttribute::where('show_in_filter', true)->where('status', 1)
            ->when($categoryIds, fn($q) => $q->whereIn('category_id', $categoryIds))
            ->with(['attribute' => fn($q) => $q->where('status', 1)->with('values')])
            ->orderBy('sort_order')->get()
            ->pluck('attribute')->filter()->unique('id')->values();
    }

    // best sellers by units sold, then rating (optionally limited to some categories)
    private function bestSellers(array $categoryIds = [])
    {
        return Product::visible()
            ->forCard()
            ->when($categoryIds, fn($q) => $q->filter(['category_ids' => $categoryIds]))
            ->withSum('orderDetails as sold_qty', 'quantity')
            ->orderByDesc('sold_qty')
            ->orderByDesc('avg_rating')
            ->limit(10)
            ->get()
            ->map(fn($p) => $p->toCard($p->sold_qty > 0 ? ['best', 'fa-crown', 'Best Seller'] : null));
    }

    // recently viewed: session list filled by Product::trackView() (newest first)
    private function recentlyViewed()
    {
        $ids = array_map('intval', session('recently_viewed', []));
        if (!$ids) {
            return collect();
        }

        return Product::visible()
            ->forCard()
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn($p) => array_search($p->id, $ids))
            ->values()
            ->map(fn($p) => $p->toCard());
    }

    public function productShow(string $slug)
    {
        // status check only, so an out-of-stock product still opens (scopeVisible would 404 it)
        $product = Product::where('status', 1)
            ->where('slug', $slug)
            ->with([
                'images',
                'brand:id,name',
                'category:id,name,slug',
                'subcategory:id,name,slug',
            ])
            ->withAvg('approvedReviews as avg_rating', 'rating')
            ->withCount('approvedReviews as reviews_count')
            ->firstOrFail();

        Product::trackView($product->id);

        // ---------- breadcrumb: All Products > Category > Subcategory ----------
        $crumbs = [['All Products', route('products')]];
        foreach ([$product->category, $product->subcategory] as $c) {
            if ($c) {
                $crumbs[] = [$c->name, route('category.show', $c->slug)];
            }
        }

        // ---------- gallery: default image first, placeholder if there are none ----------
        $gallery = $product->images
            ->sortByDesc('is_default')
            ->values()
            ->map(fn($img) => [
                'url' => asset('storage/' . $img->image),
                'thumb' => asset('storage/' . ($img->thumb ?? $img->image)),
                'alt' => $product->name,
            ]);

        if ($gallery->isEmpty()) {
            $placeholder = asset('assets/images/home/pro2.png');
            $gallery = collect([['url' => $placeholder, 'thumb' => $placeholder, 'alt' => $product->name]]);
        }

        // ---------- recently viewed (current product removed) ----------
        $recentlyViewed = $this->recentlyViewed()
            ->reject(fn($card) => $card['id'] === $product->id)
            ->values();

        // ---------- you may also love: same category family, same subcategory first ----------
        $related = Product::visible()
            ->forCard()
            ->where('id', '!=', $product->id)
            ->filter(['category_ids' => array_filter([$product->category_id, $product->subcategory_id])])
            ->orderByRaw('(subcategory_id = ?) desc', [$product->subcategory_id ?? 0])
            ->orderByDesc('id')
            ->limit(10)
            ->get()
            ->map(fn($p) => $p->toCard());

        // ---------- reviews (approved only) ----------
        $reviews = $product->approvedReviews()
            ->with(['customer:id,name', 'images'])
            ->latest()
            ->get()
            ->map(function ($r) {
                $name = $r->customer?->name ?: 'Customer';

                return [
                    'init' => collect(preg_split('/\s+/', trim($name)))->take(2)
                        ->map(fn($w) => Str::upper(Str::substr($w, 0, 1)))->implode(''),
                    'user' => $name,
                    'stars' => $r->rating,
                    'title' => $r->title,
                    'text' => $r->review,
                    'verified' => $r->verified_purchase,
                    'photos' => $r->images->map(fn($i) => $i->url)->all(),
                    'date' => $r->created_at?->format('F Y'),
                ];
            });

        $reviewCount = $reviews->count();
        $reviewAvg = $reviewCount ? round($reviews->avg('stars'), 1) : 0;
        $reviewPhotos = $reviews->pluck('photos')->flatten()->values();

        // [star, percent, count] for the bars
        $reviewBars = collect([5, 4, 3, 2, 1])->map(function ($s) use ($reviews, $reviewCount) {
            $c = $reviews->where('stars', $s)->count();
            return [$s, $reviewCount ? round($c / $reviewCount * 100) : 0, $c];
        });

        $reviewTabs = [
            1 => ['label' => 'All', 'items' => $reviews->values(), 'photos' => true],
            2 => ['label' => 'With Photos', 'items' => $reviews->filter(fn($r) => count($r['photos']))->values(), 'photos' => true],
            3 => ['label' => '5 Star', 'items' => $reviews->where('stars', 5)->values(), 'photos' => false],
        ];

        // ---------- who may write a review ----------
// guest | can (bought, delivered, not yet reviewed) | reviewed | blocked (never bought / not delivered yet)
        $reviewState = 'guest';
        if ($customer = auth('customer')->user()) {
            if ($product->reviewableOrderItemFor($customer->id)) {
                $reviewState = 'can';
            } elseif (ProductReview::where('customer_id', $customer->id)->where('product_id', $product->id)->exists()) {
                $reviewState = 'reviewed';
            } else {
                $reviewState = 'blocked';
            }
        }

        return view('front-pages.product-detail', compact(
            'product',
            'crumbs',
            'gallery',
            'recentlyViewed',
            'related',
            'reviewCount',
            'reviewAvg',
            'reviewPhotos',
            'reviewBars',
            'reviewTabs',
            'reviewState'
        ));
    }

}