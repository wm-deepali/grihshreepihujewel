<?php

namespace App\Http\Controllers;

use App\Services\Tax;
use App\Models\{Brand, Category, CategoryAttribute, Collection, GiftingOccasion, Product, Coupon};
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProductReview;
use App\Models\Setting;

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
        if ($filters['q'])
            $applied[] = ['"' . $filters['q'] . '"', $drop('q')];

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
            'q' => trim((string) $request->input('q')) ?: null,
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
    // badge: collection badge first; falls back to "Best Seller" when it has actual sales
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
            ->map(fn($p) => $p->toCard(
                $p->collectionBadge() ?? ($p->sold_qty > 0 ? config('product_badges.best-seller') : null)
            ));
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

    // category + subcategory attribute config (subcategory row wins)
    private function catAttrs(Product $product)
    {
        $catIds = array_filter([$product->category_id, $product->subcategory_id]);

        return CategoryAttribute::whereIn('category_id', $catIds)
            ->where('status', 1)
            ->with('attribute')
            ->get()
            ->sortBy(fn($ca) => $ca->category_id === $product->subcategory_id ? 0 : 1)
            ->unique('attribute_id')
            ->sortBy('sort_order')
            ->values();
    }

    // gallery: default image first, placeholder if there are none
    private function buildGallery(Product $product)
    {
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

        return $gallery;
    }

    // selectable attributes (colour / size etc.)
    private function buildOptions(Product $product, $catAttrs = null)
    {
        $catAttrs ??= $this->catAttrs($product);
        $chosen = $product->attributeValues->groupBy('attribute_id');

        return $catAttrs->where('is_selectable', true)
            ->map(function ($ca) use ($chosen) {
                $vals = $chosen->get($ca->attribute_id);
                if (!$ca->attribute || !$vals)
                    return null;

                $values = $vals->map(fn($pv) => [
                    'id' => $pv->attribute_value_id,
                    'name' => $pv->value?->value,
                    'color' => $pv->value?->color_code,
                ])->filter(fn($v) => $v['name'])->values();

                if ($values->isEmpty())
                    return null;

                return [
                    'id' => $ca->attribute_id,
                    'name' => $ca->attribute->name,
                    'swatch' => $ca->attribute->type === 'color_swatch',
                    'is_size' => Str::contains(Str::lower($ca->attribute->name), 'size'),
                    'values' => $values,
                ];
            })
            ->filter()->values();
    }

    // variant data for the detail page / quick view script (price / stock / sku / images)
    private function buildPd(Product $product): array
    {
        return [
            'base' => [
                'mrp' => (float) $product->mrp,
                'price' => (float) $product->price,
                'stock' => (int) $product->stock,
                'sku' => $product->sku,
                'minQty' => max(1, (int) $product->min_qty),
                'dispatch' => $product->delivery_time,
            ],
            'variants' => $product->variants->where('status', true)->groupBy('type')
                ->map(fn($group) => $group->map(fn($v) => [
                    'id' => $v->id,
                    'values' => $v->values->pluck('attribute_value_id')->map(fn($i) => (int) $i)->values(),
                    'sku' => $v->sku,
                    'mrp' => (float) $v->mrp,
                    'price' => (float) $v->price,
                    'stock' => (int) $v->stock,
                    'available' => (bool) $v->is_available,
                    'images' => $v->images->map(fn($i) => [
                        'url' => asset('storage/' . $i->image),
                        'thumb' => asset('storage/' . ($i->thumb ?? $i->image)),
                    ])->values(),
                ])->values()),
        ];
    }

    // "Inclusive of all taxes" / "+ 18% GST extra"; null when GST is off or the product has no GST
    private function taxNote(Product $product): ?string
    {
        if (!Tax::enabled()) {
            return null;
        }

        $rate = Tax::rateFor($product);

        if ($rate <= 0) {
            return null;
        }

        return Tax::inclusive()
            ? 'Inclusive of all taxes'
            : '+ ' . rtrim(rtrim(number_format($rate, 2), '0'), '.') . '% GST extra';
    }

    /*
    |--------------------------------------------------------------------------
    | product detail
    |--------------------------------------------------------------------------
    */
    public function productShow(string $slug)
    {
        // status check only, so an out-of-stock product still opens (scopeVisible would 404 it)
        $product = Product::where('status', 1)
            ->where('slug', $slug)
            ->with([
                'images',
                'brand:id,name',
                'category:id,name,slug,size_chart',
                'subcategory:id,name,slug,size_chart',
                'occasions',
                'collections',
                'addons',
                'attributeValues.attribute',
                'attributeValues.value',
                'variants.values',
                'variants.images',
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

        // ---------- info-tags: occasions + collections ----------
        $tags = $product->occasions->pluck('title')
            ->merge($product->collections->pluck('name'))
            ->filter()->unique()->values();

        // ---------- attributes: category + subcategory config (subcategory row wins) ----------
        $catAttrs = $this->catAttrs($product);

        // values this product actually has, grouped by attribute
        $chosen = $product->attributeValues->groupBy('attribute_id');

        // info-facts: NON-selectable, highest priority (sort_order) first, max 6
        $allFacts = $catAttrs->where('is_selectable', false)
            ->map(function ($ca) use ($chosen) {
                $vals = $chosen->get($ca->attribute_id);
                if (!$ca->attribute || !$vals)
                    return null;

                $text = $vals->map(fn($pv) => $pv->value?->value)->filter()->implode(', ');
                return $text ? ['label' => $ca->attribute->name, 'value' => $text] : null;
            })
            ->filter()->values();

        $facts = $allFacts->take(6);   // key facts at the top
        $specs = $allFacts;            // full list for the Specifications accordion
        $pairsWith = $specs->firstWhere('label', 'Pairs With')['value'] ?? null;

        // opt-cards: selectable ones
        $options = $this->buildOptions($product, $catAttrs);

        // ---------- size guide: only when the category has a chart ----------
        $sizeChart = trim((string) ($product->subcategory?->size_chart ?: $product->category?->size_chart));
        $sizeChart = strip_tags($sizeChart) !== '' ? $sizeChart : null;

        // ---------- gallery ----------
        $gallery = $this->buildGallery($product);

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

        $coupons = Coupon::available()->latest('id')->limit(3)->get();

        // ---------- variant data for the page script (price / stock / sku / images) ----------
        $pd = $this->buildPd($product);
        $taxNote = $this->taxNote($product);

        return view('front-pages.product-detail', compact(
            'product',
            'crumbs',
            'tags',
            'facts',
            'options',
            'sizeChart',
            'gallery',
            'recentlyViewed',
            'related',
            'reviewCount',
            'reviewAvg',
            'reviewPhotos',
            'reviewBars',
            'reviewTabs',
            'reviewState',
            'coupons',
            'specs',
            'pairsWith',
            'pd',
            'taxNote'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | quick view popup (JSON)
    |--------------------------------------------------------------------------
    */
    public function quickView(int $product)
    {
        $product = Product::where('status', 1)
            ->with([
                'images',
                'brand:id,name',
                'category:id,name,slug',
                'subcategory:id,name,slug',
                'collections:id,name',
                'attributeValues.attribute',
                'attributeValues.value',
                'variants.values',
                'variants.images',
            ])
            ->withAvg('approvedReviews as avg_rating', 'rating')
            ->withCount('approvedReviews as reviews_count')
            ->findOrFail($product);

        return response()->json([
            'status' => true,
            'id' => $product->id,
            'name' => $product->name,
            'brand' => $product->brand?->name ?? $product->subcategory?->name ?? $product->category?->name,
            'rate' => $product->reviews_count ? number_format($product->avg_rating, 1) : null,
            'url' => route('product.show', $product->slug),
            'desc' => Str::limit(strip_tags((string) $product->short_description), 220),
            'is_new' => (bool) ($product->created_at && $product->created_at->gt(now()->subDays(30))),
            'badge' => $product->collectionBadge(),   // [class, icon, label] or null
            'gallery' => $this->buildGallery($product)->values(),
            'options' => $this->buildOptions($product)->values(),
            'pd' => $this->buildPd($product),
            'tax_note' => $this->taxNote($product),
        ]);
    }

    /*
|--------------------------------------------------------------------------
| header search dropdown (JSON)
| empty q  -> newest products ("Suggestions")
| q given  -> best matches ("Results")
|--------------------------------------------------------------------------
*/
    public function searchSuggest(Request $request)
    {
        $term = trim(Str::limit((string) $request->input('q', ''), 60, ''));
        $symbol = Setting::current()->currency_symbol ?: '₹';

        $payload = [
            'status' => true,
            'q' => $term,
            'total' => 0,
            'all_url' => route('products', $term !== '' ? ['q' => $term] : []),
            'items' => [],
        ];

        if ($term !== '' && mb_strlen($term) < 2) {
            return response()->json($payload);
        }

        $query = Product::visible()->with(['images', 'category:id,name', 'subcategory:id,name']);

        if ($term !== '') {
            $query->search($term);
        }

        $payload['total'] = (clone $query)->count();

        if ($term !== '') {
            // name starts with the term > name contains it > matched elsewhere (category, brand...)
            $query->orderByRaw(
                'CASE WHEN products.name LIKE ? THEN 0 WHEN products.name LIKE ? THEN 1 ELSE 2 END',
                [$term . '%', '%' . $term . '%']
            );
        }

        $payload['items'] = $query->orderByDesc('products.id')
            ->limit(8)
            ->get()
            ->map(fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'url' => route('product.show', $p->slug),
                'img' => $p->display_image,
                'cat' => $p->subcategory?->name ?? $p->category?->name,
                'price' => $symbol . number_format($p->price),
            ])->all();

        return response()->json($payload);
    }

}