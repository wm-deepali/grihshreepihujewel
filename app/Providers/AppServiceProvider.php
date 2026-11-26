<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\GoogleSetting;
use App\Models\SeoPage;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Collection;
use App\Models\Announcement;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Built once per request, then reused for every view / partial
            static $shared = null;

            if ($shared === null) {
                $name = Route::currentRouteName();

                $cart = auth('customer')->check()
                    ? Cart::where('customer_id', auth('customer')->id())->first()
                    : Cart::where('session_id', session()->getId())->first();

                if ($cart) {
                    $cart->load([
                        'items.product.category',
                        'items.product.subcategory',
                        'items.imageVariant',
                        'items.priceVariant',
                        'items.stockVariant',
                        'items.addons',
                        'items.product.images',
                        'items.imageVariant.images',
                    ]);
                }

                $shared = [
                    'seo' => $name ? SeoPage::forKey($name) : null,
                    'general' => Setting::first() ?? new Setting(),
                    'miniCart' => $cart ?? new Cart(),
                    'cartCount' => $cart ? (int) $cart->items->sum('quantity') : 0,
                ];
            }

            $view->with($shared);
        });
    }
}