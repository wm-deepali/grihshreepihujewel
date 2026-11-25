<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Test data for the /products listing page (grid + every filter).
 *
 * Run:  php artisan db:seed --class=ProductListingSeeder
 *
 * - Safe to re-run: rows are matched on slug / sku / name and updated, not duplicated.
 * - Columns that don't exist in your tables are skipped automatically (see only()).
 * - Uses the DB facade (not models), so it ignores $fillable and global scopes.
 * - No product images are seeded: the card falls back to assets/images/home/tab1.png.
 */
class ProductListingSeeder extends Seeder
{
    private array $colCache = [];

    public function run(): void
    {
        $required = [
            'brands', 'categories', 'gifting_occasions', 'collections', 'attributes',
            'attribute_values', 'category_attributes', 'products',
            'product_attribute_values', 'occasion_product', 'collection_product',
        ];
        $missing = collect($required)->reject(fn ($t) => Schema::hasTable($t));
        if ($missing->isNotEmpty()) {
            $this->command->error('Missing tables: ' . $missing->implode(', ') . ' — fix the table names in this seeder.');
            return;
        }

        // ------------------------------------------------------------------ brands
        $brand = [];
        foreach (['grih-shree' => 'Grih Shree', 'pihu-jewel' => 'Pihu Jewel'] as $slug => $name) {
            $brand[$slug] = $this->put('brands', ['slug' => $slug], ['name' => $name, 'status' => 1]);
        }

        // -------------------------------------------------------------- categories
        $adminId = Schema::hasTable('users') ? (DB::table('users')->value('id') ?? 1) : 1;

        $tree = [
            'Handloom & Bedding'  => ['Bedsheets', 'Dohars & Quilts', 'Cushion Covers'],
            'Home Decor'          => ['Torans', 'Wall Decor', 'Table Decor'],
            'Earrings'            => ['Jhumkas', 'Studs', 'Chandbalis'],
            'Necklaces'           => ['Choker Sets', 'Temple Jewellery'],
            'Bangles & Bracelets' => ['Bangles', 'Kada'],
        ];

        $parentId = [];   // parent name => id
        $child    = [];   // child slug => ['id' => .., 'parent' => ..]
        $sort = 1;
        foreach ($tree as $parentName => $children) {
            $pSlug = Str::slug($parentName);
            $pid = $this->put('categories', ['slug' => $pSlug], [
                'name' => $parentName, 'parent_id' => null, 'sort_order' => $sort++,
                'is_popular' => 1, 'status' => 1, 'is_featured' => 0, 'show_in_navbar' => 1, 'added_by' => $adminId,
            ]);
            $parentId[$parentName] = $pid;

            foreach ($children as $i => $childName) {
                $cSlug = Str::slug($childName);
                $cid = $this->put('categories', ['slug' => $cSlug], [
                    'name' => $childName, 'parent_id' => $pid, 'sort_order' => $i + 1,
                    'is_popular' => 0, 'status' => 1, 'is_featured' => 0, 'show_in_navbar' => 0, 'added_by' => $adminId,
                ]);
                $child[$cSlug] = ['id' => $cid, 'parent' => $pid];
            }
        }

        // --------------------------------------------------------------- occasions
        $occ = [];
        foreach (['Wedding', 'Diwali', 'Festive', 'Housewarming', 'Anniversary', 'Birthday', 'Party'] as $i => $name) {
            $slug = Str::slug($name);
            $occ[$slug] = $this->put('gifting_occasions', ['slug' => $slug], [
                'title' => $name, 'status' => 1, 'sort_order' => $i + 1,
            ]);
        }

        // ------------------------------------------------------------- collections
        $col = [];
        foreach (['New Arrivals', 'Best Sellers', 'Festive Specials', 'Premium Collection', 'Gift Ideas'] as $i => $name) {
            $slug = Str::slug($name);
            $col[$slug] = $this->put('collections', ['slug' => $slug], [
                'name' => $name, 'status' => 1, 'sort_order' => $i + 1,
            ]);
        }

        // -------------------------------------------------------------- attributes
        // Colour = swatch type, the rest = button type
        $attrDefs = [
            'Colour' => ['color_swatch', [
                'Red' => '#b3202f', 'Maroon' => '#5e1a33', 'Ivory' => '#f3ecd9', 'Green' => '#1f6b4f',
                'Blue' => '#2a4a86', 'Pink' => '#f1c4cc', 'Black' => '#222222',
            ]],
            'Size'         => ['button', ['Single Bed', 'Double Bed', 'King Size', 'Free Size']],
            'Material'     => ['button', ['Cotton', 'Brass', 'Ceramic', 'Resin']],
            'Metal Finish' => ['button', ['Antique Gold', 'Gold-tone', 'Silver-tone', 'Rose Gold', 'Oxidised']],
            'Stone Work'   => ['button', ['Kundan', 'Polki', 'Pearl', 'Meenakari', 'Crystal']],
        ];

        $attrId = [];   // attribute name => id
        $valId  = [];   // attribute name => [value name => id]
        foreach ($attrDefs as $name => [$type, $values]) {
            $attrId[$name] = $this->put('attributes', ['slug' => Str::slug($name)], [
                'name' => $name, 'type' => $type, 'has_values' => 1, 'status' => 1, 'show_in_navbar' => 0,
            ]);

            $order = 1;
            foreach ($values as $k => $v) {
                $valueName = is_int($k) ? $v : $k;
                $color     = is_int($k) ? null : $v;
                $valId[$name][$valueName] = $this->put('attribute_values',
                    ['attribute_id' => $attrId[$name], 'value' => $valueName],
                    ['color_code' => $color, 'color' => $color, 'hex_code' => $color, 'status' => 1, 'sort_order' => $order++]
                );
            }
        }

        // which attributes show in the filter for which parent category
        $catAttrs = [
            'Handloom & Bedding'  => ['Colour', 'Size', 'Material'],
            'Home Decor'          => ['Colour', 'Material'],
            'Earrings'            => ['Metal Finish', 'Stone Work', 'Colour'],
            'Necklaces'           => ['Metal Finish', 'Stone Work', 'Colour'],
            'Bangles & Bracelets' => ['Metal Finish', 'Stone Work', 'Colour'],
        ];
        foreach ($catAttrs as $parentName => $names) {
            foreach ($names as $i => $attrName) {
                $this->put('category_attributes',
                    ['category_id' => $parentId[$parentName], 'attribute_id' => $attrId[$attrName]],
                    [
                        'is_selectable' => 1, 'used_for_variant' => 0,
                        'price_dependent' => 0, 'image_dependent' => 0, 'stock_dependent' => 0, 'sku_dependent' => 0,
                        'show_in_filter' => 1, 'show_on_listing' => 1, 'sort_order' => $i + 1, 'status' => 1,
                    ]
                );
            }
        }

        // ---------------------------------------------------------------- products
        // [name, brand, child category slug, mrp, price, stock, created N days ago,
        //  occasions[], collections[], attributes[name => [values]], rating (1-5)]
        $products = [
            // ---- Grih Shree (home & living)
            ['Handloom Cotton Bedsheet Set', 'grih-shree', 'bedsheets', 3299, 2499, 40, 90, ['housewarming', 'wedding'], ['best-sellers', 'gift-ideas'], ['Colour' => ['Ivory', 'Blue'], 'Size' => ['Double Bed'], 'Material' => ['Cotton']], 5],
            ['Jaipuri Cotton Quilt', 'grih-shree', 'dohars-quilts', 3999, 3199, 25, 60, ['festive'], ['best-sellers'], ['Colour' => ['Pink', 'Green'], 'Size' => ['Double Bed', 'King Size'], 'Material' => ['Cotton']], 5],
            ['Block Print Cotton Dohar', 'grih-shree', 'dohars-quilts', 2399, 1799, 30, 10, ['housewarming'], ['new-arrivals'], ['Colour' => ['Blue'], 'Size' => ['Single Bed', 'Double Bed'], 'Material' => ['Cotton']], 4],
            ['Embroidered Cushion Cover Set', 'grih-shree', 'cushion-covers', 1599, 1199, 60, 5, ['festive', 'diwali'], ['new-arrivals', 'gift-ideas'], ['Colour' => ['Maroon', 'Ivory'], 'Size' => ['Free Size'], 'Material' => ['Cotton']], 4],
            ['Reversible Cotton Bedsheet', 'grih-shree', 'bedsheets', 2799, 2799, 0, 120, [], [], ['Colour' => ['Green'], 'Size' => ['King Size'], 'Material' => ['Cotton']], 3],
            ['Brass Diya Gift Set', 'grih-shree', 'table-decor', 1199, 899, 80, 45, ['diwali', 'festive', 'housewarming'], ['festive-specials', 'gift-ideas'], ['Material' => ['Brass']], 5],
            ['Hand-Painted Ceramic Planter', 'grih-shree', 'table-decor', 1499, 1099, 20, 20, ['housewarming', 'birthday'], ['new-arrivals'], ['Colour' => ['Blue', 'Pink'], 'Material' => ['Ceramic']], 4],
            ['Festive Door Toran', 'grih-shree', 'torans', 999, 699, 100, 3, ['diwali', 'festive'], ['festive-specials', 'new-arrivals'], ['Colour' => ['Red', 'Green'], 'Material' => ['Cotton']], 4],
            ['Macrame Wall Hanging', 'grih-shree', 'wall-decor', 1799, 1799, 15, 200, ['housewarming'], [], ['Colour' => ['Ivory'], 'Material' => ['Cotton']], 3],
            ['Resin Art Wall Clock', 'grih-shree', 'wall-decor', 2999, 1999, 12, 12, ['anniversary', 'birthday'], ['premium-collection', 'gift-ideas'], ['Colour' => ['Blue', 'Black'], 'Material' => ['Resin']], 5],
            ['Brass Table Lamp', 'grih-shree', 'table-decor', 3499, 2799, 8, 70, ['anniversary', 'diwali'], ['premium-collection'], ['Colour' => ['Black'], 'Material' => ['Brass']], 4],

            // ---- Pihu Jewel (jewellery)
            ['Royal Radiance Bridal Necklace Set', 'pihu-jewel', 'choker-sets', 9999, 7500, 6, 8, ['wedding', 'anniversary'], ['new-arrivals', 'premium-collection'], ['Colour' => ['Red', 'Green'], 'Metal Finish' => ['Antique Gold'], 'Stone Work' => ['Kundan', 'Polki']], 5],
            ['Maharani Kundan Chandbali Earrings', 'pihu-jewel', 'chandbalis', 1999, 1400, 35, 6, ['wedding', 'festive'], ['new-arrivals', 'best-sellers'], ['Colour' => ['Pink', 'Green'], 'Metal Finish' => ['Antique Gold'], 'Stone Work' => ['Kundan']], 5],
            ['Crystal Glam Statement Earrings', 'pihu-jewel', 'studs', 2299, 1600, 25, 4, ['party', 'anniversary'], ['new-arrivals'], ['Metal Finish' => ['Silver-tone'], 'Stone Work' => ['Crystal']], 4],
            ['Kundan Choker Necklace', 'pihu-jewel', 'choker-sets', 2599, 1899, 40, 50, ['wedding', 'festive'], ['best-sellers'], ['Colour' => ['Red'], 'Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Kundan', 'Pearl']], 5],
            ['Pearl Drop Earrings', 'pihu-jewel', 'studs', 999, 749, 70, 100, ['festive', 'birthday'], ['best-sellers', 'gift-ideas'], ['Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Pearl']], 4],
            ['Meenakari Bangle Set', 'pihu-jewel', 'bangles', 1799, 1299, 55, 35, ['festive', 'wedding'], ['best-sellers'], ['Colour' => ['Red', 'Green', 'Blue'], 'Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Meenakari']], 4],
            ['Gold Plated Jhumka Earrings', 'pihu-jewel', 'jhumkas', 1199, 849, 45, 90, ['festive', 'diwali'], ['festive-specials'], ['Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Pearl']], 4],
            ['Temple Jewellery Necklace', 'pihu-jewel', 'temple-jewellery', 4999, 3499, 15, 25, ['wedding', 'festive'], ['premium-collection'], ['Metal Finish' => ['Antique Gold'], 'Stone Work' => ['Kundan']], 5],
            ['Oxidised Silver Kada', 'pihu-jewel', 'kada', 1399, 999, 50, 15, ['party', 'birthday'], ['new-arrivals'], ['Metal Finish' => ['Oxidised']], 3],
            ['Polki Choker Necklace Set', 'pihu-jewel', 'choker-sets', 3199, 2299, 22, 40, ['wedding', 'anniversary'], ['premium-collection', 'gift-ideas'], ['Metal Finish' => ['Rose Gold'], 'Stone Work' => ['Polki', 'Crystal']], 4],
            ['Rose Gold Fashion Bracelet', 'pihu-jewel', 'bangles', 899, 599, 33, 14, ['birthday', 'party'], ['new-arrivals', 'gift-ideas'], ['Metal Finish' => ['Rose Gold'], 'Stone Work' => ['Crystal']], 3],
            ['Diamond-look Premium Necklace', 'pihu-jewel', 'choker-sets', 12999, 11999, 5, 2, ['wedding', 'anniversary'], ['premium-collection', 'new-arrivals'], ['Metal Finish' => ['Silver-tone'], 'Stone Work' => ['Crystal']], 5],
            ['Classic Jhumka Studs Combo', 'pihu-jewel', 'jhumkas', 799, 799, 60, 150, ['festive'], [], ['Metal Finish' => ['Gold-tone']], 4],
        ];

        $reviewer = $this->reviewerId();
        $made = 0;

        foreach ($products as [$name, $brandSlug, $catSlug, $mrp, $price, $stock, $daysAgo, $occs, $cols, $attrs, $rating]) {
            $slug = Str::slug($name);
            $pct  = $mrp > $price ? (int) round((($mrp - $price) / $mrp) * 100) : 0;

            $pid = $this->put('products', ['slug' => $slug], [
                'category_id'          => $child[$catSlug]['parent'],
                'subcategory_id'       => $child[$catSlug]['id'],
                'brand_id'             => $brand[$brandSlug],
                'name'                 => $name,
                'sku'                  => 'SEED-' . strtoupper(substr(md5($slug), 0, 6)),
                'short_description'    => 'Beautifully made ' . Str::lower($name) . '.',
                'mrp'                  => $mrp,
                'discount_type'        => 'percentage',   // change if your enum is different (e.g. 'percent', 'flat')
                'discount'             => $pct,
                'price'                => $price,
                'stock'                => $stock,
                'min_qty'              => 1,
                'delivery_time'        => '3-5 days',
                'colour_customization' => 0,
                'status'               => 1,
                'created_at'           => now()->subDays($daysAgo),
            ]);

            // occasions
            DB::table('occasion_product')->where('product_id', $pid)->delete();
            foreach ($occs as $o) {
                DB::table('occasion_product')->insert(['product_id' => $pid, 'occasion_id' => $occ[$o]]);
            }

            // collections
            DB::table('collection_product')->where('product_id', $pid)->delete();
            foreach ($cols as $c) {
                DB::table('collection_product')->insert(['product_id' => $pid, 'collection_id' => $col[$c]]);
            }

            // attribute values
            DB::table('product_attribute_values')->where('product_id', $pid)->delete();
            foreach ($attrs as $attrName => $valueNames) {
                foreach ($valueNames as $valueName) {
                    $this->insert('product_attribute_values', [
                        'product_id'         => $pid,
                        'attribute_id'       => $attrId[$attrName],
                        'attribute_value_id' => $valId[$attrName][$valueName],
                    ]);
                }
            }

         

            $made++;
        }

        $this->command->info("Seeded: 2 brands, " . count($child) . " subcategories, " . count($occ) . " occasions, " . count($col) . " collections, " . count($attrId) . " attributes, {$made} products.");
        if (!$reviewer) {
            $this->command->warn('No customer found/created, so reviews were skipped (rating filter + sort will show nothing). Create one customer and re-run.');
        }
    }

    /** Existing customer id, else try to create a test one. Null if neither works. */
    private function reviewerId(): ?int
    {
        if (!Schema::hasTable('customers') || !Schema::hasTable('product_reviews')) {
            return null;
        }

        $id = DB::table('customers')->value('id');
        if ($id) {
            return (int) $id;
        }

        try {
            return $this->put('customers', ['email' => 'seed.reviewer@example.com'], [
                'name'     => 'Seed Reviewer',
                'phone'    => '9999999999',
                'mobile'   => '9999999999',
                'password' => Hash::make('password'),
                'status'   => 1,
            ]);
        } catch (\Throwable $e) {
            $this->command->warn('Could not create a customer: ' . $e->getMessage());
            return null;
        }
    }

    // ------------------------------------------------------------------ helpers

    /** Keep only the columns that exist on the table. */
    private function only(string $table, array $row): array
    {
        $this->colCache[$table] ??= Schema::getColumnListing($table);

        return array_intersect_key($row, array_flip($this->colCache[$table]));
    }

    /** Insert one row (unknown columns dropped, timestamps added when the table has them). */
    private function insert(string $table, array $row): void
    {
        DB::table($table)->insert($this->only($table, $row + ['created_at' => now(), 'updated_at' => now()]));
    }

    /** Update-or-insert by $match (unknown columns dropped); returns the row id. */
    private function put(string $table, array $match, array $data = []): int
    {
        $match = $this->only($table, $match);
        if (!$match) {
            throw new \RuntimeException("None of the key columns exist on `{$table}`; adjust the seeder.");
        }

        $existing = DB::table($table)->where($match)->first();
        if ($existing) {
            DB::table($table)->where($match)->update($this->only($table, $data + ['updated_at' => now()]));
            return (int) $existing->id;
        }

        return (int) DB::table($table)->insertGetId(
            $this->only($table, $match + $data + ['created_at' => now(), 'updated_at' => now()])
        );
    }
}