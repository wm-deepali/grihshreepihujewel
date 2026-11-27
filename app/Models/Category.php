<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tax_class_id',
        'brand_id',          // NEW: group (Grih Shree / Pihu Jewel)
        'name',
        'slug',
        'parent_id',
        'sub_title',
        'meta_title',
        'meta_description',
        'image',
        'size_chart',
        'sort_order',

        'is_popular',
        'status',

        'added_by',
        'is_featured',
        'show_in_navbar',
    ];

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        // A sub category always inherits the brand of its parent.
        static::saving(function (Category $category) {
            if ($category->parent_id) {
                $category->brand_id = static::withTrashed()
                    ->whereKey($category->parent_id)
                    ->value('brand_id');
            }
        });

        static::saved(function (Category $category) {
            // Brand changed -> push it down to sub categories and products
            if ($category->wasChanged('brand_id')) {
                $ids = [$category->id];

                if (is_null($category->parent_id)) {
                    $childIds = static::withTrashed()->where('parent_id', $category->id)->pluck('id')->all();

                    if ($childIds) {
                        static::withTrashed()->whereIn('id', $childIds)->update(['brand_id' => $category->brand_id]);
                    }

                    $ids = array_merge($ids, $childIds);
                }

                Product::withTrashed()
                    ->where(function ($q) use ($ids) {
                        $q->whereIn('category_id', $ids)->orWhereIn('subcategory_id', $ids);
                    })
                    ->update(['brand_id' => $category->brand_id]);
            }

            Cache::forget(Brand::MENU_CACHE_KEY);
        });

        static::deleted(fn() => Cache::forget(Brand::MENU_CACHE_KEY));
        static::restored(fn() => Cache::forget(Brand::MENU_CACHE_KEY));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Brand / group (Home & Living or Jewellery & Accessories)
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->whereNull('deleted_at'); // ignore soft deleted
    }

    public function categoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

    // Products directly under category
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Products where this category is selected as subcategory
    public function subCategoryProducts()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    // Only active
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Only parent categories
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Only subcategories
    public function scopeSubCategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    // Marked popular (used by "Explore by Category")
    public function scopePopular($query)
    {
        return $query->where('is_popular', 1);
    }

    // Only categories of one brand (accepts id or Brand model)
    public function scopeOfBrand($query, $brand)
    {
        return $query->where('brand_id', $brand instanceof Brand ? $brand->id : $brand);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (CLEAN UI)
    |--------------------------------------------------------------------------
    */

    public function getIsParentAttribute()
    {
        return is_null($this->parent_id);
    }

    public function getIsChildAttribute()
    {
        return !is_null($this->parent_id);
    }

    // Frontend image URL with a fallback (adjust the 'storage/' prefix to wherever you save category images)
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/images/home/cat1.png');
    }

    // Needs ->withCount(['products', 'subCategoryProducts'])
    public function getProductsTotalAttribute()
    {
        return (int) ($this->products_count ?? 0) + (int) ($this->sub_category_products_count ?? 0);
    }
}