<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeBanner extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'description',
        'image',
        'mobile_image',
        'button_1_text',
        'button_1_url',
        'button_2_text',
        'button_2_url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/images/home/banner.jpg');
    }

    public function getMobileImageUrlAttribute(): ?string
    {
        return $this->mobile_image ? asset('storage/' . $this->mobile_image) : null;
    }

    // delete the uploaded files together with the row
    protected static function booted()
    {
        static::deleting(function (HomeBanner $b) {
            foreach ([$b->image, $b->mobile_image] as $path) {
                if ($path) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }
}