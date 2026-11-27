<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    protected $fillable = ['name', 'rate', 'is_default', 'status'];

    protected $casts = [
        'rate' => 'float',
        'is_default' => 'boolean',
        'status' => 'boolean',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}