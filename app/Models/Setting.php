<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'tagline',
        'header_logo',
        'footer_logo',
        'favicon',
        'admin_login_logo',
        'admin_dashboard_logo',
        'admin_email',
        'support_email',
        'phone',
        'whatsapp',
        'business_address',
        'business_hours',
        'footer_description',
        'footer_copyright',
        'google_map_url',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'pinterest',
        'currency',
        'currency_symbol',
        'timezone',
        'maintenance_mode',
        'admin_session_timeout',
        'product_reviews',
        'wishlist',
        'stock_alerts',
        'cod_enabled'
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'product_reviews' => 'boolean',
        'wishlist' => 'boolean',
        'stock_alerts' => 'boolean',
        'cod_enabled' => 'boolean',
    ];


    protected static function booted()
    {
        static::saved(fn() => Cache::forget('site.settings'));
        static::deleted(fn() => Cache::forget('site.settings'));
    }

    // one cached row, never null (an empty Setting when nothing is saved yet)
    public static function current(): self
    {
        return Cache::remember('site.settings', 3600, fn() => static::first() ?? new static);
    }

    // uploaded file -> url (adjust 'storage/' if the admin saves into public/uploads instead)
    private function fileUrl(?string $path, string $fallback): string
    {
        if (!$path) {
            return asset($fallback);
        }

        return Str::startsWith($path, ['http://', 'https://']) ? $path : asset('storage/' . ltrim($path, '/'));
    }

    public function getHeaderLogoUrlAttribute(): string
    {
        return $this->fileUrl($this->header_logo, 'assets/images/logo.png');
    }

    public function getFooterLogoUrlAttribute(): string
    {
        return $this->fileUrl($this->footer_logo, 'assets/images/logo.jpeg');
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon ? $this->fileUrl($this->favicon, '') : null;
    }

    public function getSiteNameTextAttribute(): string
    {
        return $this->site_name ?: 'Grih Shree & Pihu Jewel';
    }

    // wa.me link from the saved number (a 10 digit Indian number gets 91 in front)
    public function getWhatsappUrlAttribute(): ?string
    {
        $raw = trim((string) $this->whatsapp);

        if ($raw === '') {
            return null;
        }

        if (Str::startsWith($raw, ['http://', 'https://'])) {
            return $raw;
        }

        $digits = preg_replace('/\D+/', '', $raw);

        if ($digits === '') {
            return null;
        }

        return 'https://wa.me/' . (strlen($digits) === 10 ? '91' . $digits : $digits);
    }

    // only the networks that have a link saved, in display order
    public function socialLinks(): array
    {
        return collect([
            ['Instagram', 'fa-brands fa-instagram', $this->instagram],
            ['Facebook', 'fa-brands fa-facebook-f', $this->facebook],
            ['X (Twitter)', 'fa-brands fa-x-twitter', $this->twitter],
            ['WhatsApp', 'fa-brands fa-whatsapp', $this->whatsapp_url],
            ['YouTube', 'fa-brands fa-youtube', $this->youtube],
            ['Pinterest', 'fa-brands fa-pinterest-p', $this->pinterest],
            ['LinkedIn', 'fa-brands fa-linkedin-in', $this->linkedin],
        ])
            ->filter(fn($l) => filled($l[2]))
            ->map(fn($l) => ['label' => $l[0], 'icon' => $l[1], 'url' => $l[2]])
            ->values()
            ->all();
    }

}