<?php

namespace Database\Seeders;

use App\Models\HomeBanner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        $this->banners();
    }

    /* ------------------------------------------------------------------
     | Hero sliders
     | Copies the existing static banners from public/assets/images/home
     | into storage/app/public/home-sliders so asset('storage/...') works.
     | Safe to re-run: a slide is matched by its title and never duplicated.
     ------------------------------------------------------------------ */
    private function banners(): void
    {
        // never duplicate: skip when banners already exist
        if (HomeBanner::count() > 0) {
            return;
        }

        $slides = [
            [
                'file' => 'banner.jpg',
                'eyebrow' => 'Grih Shree & Pihu Jewel',
                'title' => "Beautiful Living.\nTimeless Adornment.",
                'description' => 'Discover thoughtfully curated home essentials and beautiful jewellery for everyday moments and special occasions.',
                'button_1_text' => 'Shop Home & Living',
                'button_1_url' => '/products',
                'button_2_text' => 'Explore Jewellery',
                'button_2_url' => '/products',
            ],
            [
                'file' => 'banner2.jpg',
                'eyebrow' => 'The Art of Beautiful Living',
                'title' => "Make Every Corner\nFeel Like Home.",
                'description' => 'Bring warmth, comfort and character to your spaces with beautiful bedding, handcrafted decor and everyday essentials.',
                'button_1_text' => 'Explore Home & Living',
                'button_1_url' => '/products',
                'button_2_text' => null,
                'button_2_url' => null,
            ],
        ];

        foreach ($slides as $i => $s) {
            $source = public_path('assets/images/home/' . $s['file']);

            // copy the existing static image into storage/app/public/home-banners
            $path = null;
            if (File::exists($source)) {
                $path = 'home-banners/seed-' . $s['file'];
                Storage::disk('public')->put($path, File::get($source));
            }

            if (!$path) {
                continue; // image missing in public/assets, skip this slide
            }

            HomeBanner::create([
                'eyebrow' => $s['eyebrow'],
                'title' => $s['title'],
                'description' => $s['description'],
                'image' => $path,
                'button_1_text' => $s['button_1_text'],
                'button_1_url' => $s['button_1_url'],
                'button_2_text' => $s['button_2_text'],
                'button_2_url' => $s['button_2_url'],
                'sort_order' => $i + 1,
                'status' => true,
            ]);
        }
    }

}