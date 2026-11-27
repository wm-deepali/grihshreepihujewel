<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Single settings row. Re-running the seeder updates it instead of adding a second row.
        $setting = Setting::first() ?? new Setting();

        $setting->fill([
            // Branding (logo fields left null so the fallbacks in Setting::fileUrl() are used)
            'site_name'            => 'Grih Shree & Pihu Jewel',
            'tagline'              => 'A Beautiful World of Home & Jewellery',
            'header_logo'          => null,
            'footer_logo'          => null,
            'favicon'              => null,
            'admin_login_logo'     => null,
            'admin_dashboard_logo' => null,

            // Contact
            'admin_email'          => 'admin@example.com',
            'support_email'        => 'support@example.com',
            'phone'                => '+91 98765 43210',
            'whatsapp'             => '9876543210',
            'business_address'     => 'Your business address here',
            'business_hours'       => 'Mon - Sat, 10:00 AM - 7:00 PM',
            'google_map_url'       => null,

            // Footer
            'footer_description'   => 'Grih Shree & Pihu Jewel brings together thoughtfully curated home essentials, handcrafted treasures and beautiful jewellery. Discover two distinctive collections, all in one place.',
            'footer_copyright'     => 'Copyright © {year} Grih Shree & Pihu Jewel. All Rights Reserved.',

            // Social (null = hidden on the site)
            'facebook'             => null,
            'instagram'            => 'https://www.instagram.com/grihshreestudio/',
            'twitter'              => null,
            'linkedin'             => null,
            'youtube'              => null,
            'pinterest'            => null,

            // Store
            'currency'             => 'INR',
            'currency_symbol'      => '₹',
            'timezone'             => 'Asia/Kolkata',

            // System
            'maintenance_mode'      => false,
            'admin_session_timeout' => 120, // minutes

            // Features
            'product_reviews'      => true,
            'wishlist'             => true,
            'stock_alerts'         => true,
            'cod_enabled'          => true,
        ]);

        // save() fires the model event that clears the 'site.settings' cache
        $setting->save();
    }
}