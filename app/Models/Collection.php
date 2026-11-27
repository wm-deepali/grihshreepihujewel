<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'code',
        'status',
        'sort_order',
        'show_in_navbar'
    ];

    protected $casts = [
        'show_in_navbar' => 'boolean',
    ];


    protected static function booted()
    {
        static::saved(fn() => Cache::forget('menu.collections'));
        static::deleted(fn() => Cache::forget('menu.collections'));
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'collection_product',
            'collection_id',
            'product_id'
        );
    }
}