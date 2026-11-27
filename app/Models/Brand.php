<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Brand extends Model
{
    public const MENU_CACHE_KEY = 'menu.brands';

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'status',

        // menu / group display
        'menu_label',     // top nav label, e.g. "Jewellery"
        'menu_title',     // mega menu heading, e.g. "Jewellery & Accessories"
        'feature_title',  // side image caption, e.g. "Timeless Adornment"
        'feature_image',  // side image in the mega menu
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget(self::MENU_CACHE_KEY));
        static::deleted(fn() => Cache::forget(self::MENU_CACHE_KEY));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // every category (parent + sub) under this brand
    public function allCategories()
    {
        return $this->hasMany(Category::class);
    }

    // top-level categories only (mega menu columns)
    public function categories()
    {
        return $this->hasMany(Category::class)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('assets/images/logo.png');
    }

    public function getFeatureImageUrlAttribute()
    {
        return $this->feature_image
            ? asset('storage/' . $this->feature_image)
            : asset('assets/images/home/pro1.png');
    }

    public function getMenuLabelTextAttribute()
    {
        return $this->menu_label ?: $this->name;
    }

    public function getMenuTitleTextAttribute()
    {
        return $this->menu_title ?: $this->name;
    }

    /*
    |--------------------------------------------------------------------------
    | MENU TREE (header / mobile menu / footer)
    | Brand -> parent categories -> sub categories, cached for 1 hour.
    | Cache is cleared automatically when a Brand or Category is saved/deleted.
    |--------------------------------------------------------------------------
    */

    public static function menuTree()
    {
        return Cache::remember(self::MENU_CACHE_KEY, 3600, function () {
            return static::active()->ordered()
                ->with(['categories' => function ($q) {
                    $q->active()
                        ->where('show_in_navbar', 1)
                        ->with(['children' => function ($c) {
                            $c->active()
                                ->where('show_in_navbar', 1)
                                ->orderBy('sort_order')
                                ->orderBy('name');
                        }]);
                }])
                ->get();
        });
    }
}