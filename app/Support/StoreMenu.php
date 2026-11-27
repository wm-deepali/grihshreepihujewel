<?php

namespace App\Support;

use App\Models\Brand;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\Cache;

class StoreMenu
{
    public const COLLECTIONS_KEY = 'menu.collections';
    public const OCCASIONS_KEY = 'menu.occasions';

    private static ?array $memo = null;

    public static function get(): array
    {
        return self::$memo ??= self::build();
    }

    private static function build(): array
    {
        // ---------- brand groups: Brand -> categories -> sub categories ----------
        $groups = Brand::menuTree()->map(fn ($b) => [
            'slug' => $b->slug,
            'name' => $b->name,
            'label' => $b->menu_label_text,
            'title' => $b->menu_title_text,
            'feature' => $b->feature_title,
            'img' => $b->feature_image_url,
            'url' => route('products', ['brand' => $b->slug]),
            'cols' => $b->categories->map(fn ($c) => [
                'name' => $c->name,
                'url' => route('category.show', $c->slug),
                'items' => $c->children->map(fn ($s) => [
                    'name' => $s->name,
                    'url' => route('category.show', $s->slug),
                ])->all(),
            ])->values()->all(),
        ])
            ->filter(fn ($g) => count($g['cols']))   // a group with no columns is not shown
            ->values()
            ->all();

        // ---------- collections (show_in_navbar) ----------
        $collections = Cache::remember(self::COLLECTIONS_KEY, 3600, fn () =>
            Collection::where('status', 1)->where('show_in_navbar', 1)
                ->orderBy('sort_order')->orderBy('name')
                ->get(['id', 'name'])->toArray()
        );

        // ---------- occasions ----------
        $occasions = Cache::remember(self::OCCASIONS_KEY, 3600, fn () =>
            GiftingOccasion::where('status', 1)->orderBy('title')
                ->get(['id', 'title'])->toArray()
        );

        $collectionItems = array_map(fn ($c) => [
            'name' => $c['name'],
            'url' => route('products', ['collection' => [$c['id']]]),
        ], $collections);

        $occasionItems = array_map(fn ($o) => [
            'name' => $o['title'],
            'url' => route('products', ['occasion' => [$o['id']]]),
        ], $occasions);

        $priceItems = [
            ['name' => 'Under ₹499', 'url' => route('products', ['price_quick' => 499])],
            ['name' => 'Under ₹999', 'url' => route('products', ['price_quick' => 999])],
            ['name' => '₹1,000 - ₹1,999', 'url' => route('products', ['price_min' => 1000, 'price_max' => 1999])],
            ['name' => '₹2,000 - ₹4,999', 'url' => route('products', ['price_min' => 2000, 'price_max' => 4999])],
            ['name' => '₹5,000 & Above', 'url' => route('products', ['price_quick' => 'premium'])],
        ];

        // columns of the "Shop by Collections" mega menu (empty ones are skipped)
        $collectionCols = array_values(array_filter([
            ['slug' => 'featured', 'title' => 'Featured', 'items' => $collectionItems],
            ['slug' => 'occasion', 'title' => 'Shop by Occasion', 'items' => array_slice($occasionItems, 0, 8)],
            ['slug' => 'price', 'title' => 'Price Range', 'items' => $priceItems],
        ], fn ($c) => count($c['items'])));

        return [
            'menuGroups' => $groups,
            'menuCollectionCols' => $collectionCols,
            'menuOccasions' => $occasionItems,   // Gifts dropdown
        ];
    }
}