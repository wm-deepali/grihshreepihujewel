<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Demo data for the /products listing AND the product detail page.
 *
 * Run:  php artisan db:seed --class=ProductListingSeeder
 *
 * What it covers
 * - Brands, categories (with size charts), occasions, collections
 * - Attributes: SELECTABLE (colour swatch + button) and NON-SELECTABLE (facts / specifications)
 * - category_attributes with price / image / stock / sku dependency flags
 * - Products with description, inclusions, size_fit, care, shipping/returns (one product has custom text)
 * - Variants: price, image, stock, sku  (+ one "Not offered" combination)
 * - Addons (one free, some paid), coupons (2 live, 1 flat, 1 expired, 1 used up), pincodes, reviews
 *
 * - Safe to re-run: rows are matched on slug / sku / code / email and updated, not duplicated.
 * - Columns / tables that don't exist are skipped automatically (see only() and the Schema checks).
 * - Uses the DB facade, so it ignores $fillable and global scopes.
 * - No image files are seeded: cards / gallery fall back to the placeholder. Upload variant images from admin.
 */
class ProductListingSeeder extends Seeder
{
    private array $colCache = [];
    private int $variantCount = 0;

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

        // Size charts are HTML (the detail page prints them in the Size Guide popup).
        // Earrings + Home Decor have NO chart on purpose: the Size Guide button must stay hidden there.
        // Cushion Covers has its own chart: a subcategory chart wins over its parent's.
        $bedChart = $this->table(['Size', 'Sheet (in)', 'Pillow Cover (in)'], [
            ['Single', '60 × 90', '17 × 27'], ['Double', '90 × 100', '17 × 27'], ['King', '108 × 108', '17 × 27'],
        ]);
        $cushionChart = $this->table(['Size', 'Cover (in)', 'Best For'], [
            ['Small', '12 × 12', 'Accent cushions'], ['Medium', '16 × 16', 'Sofa, bed'], ['Large', '18 × 18', 'Sofa, floor seating'],
        ]);
        $necklaceChart = $this->table(['Style', 'Length (in)', 'Sits At'], [
            ['Choker', '14 – 16', 'Base of the neck'], ['Princess', '17 – 19', 'Collarbone'], ['Matinee', '20 – 24', 'Above the bust'],
        ]);
        $bangleChart = $this->table(['Size', 'Inner Dia (in)', 'Inner Dia (cm)', 'Wrist'], [
            ['2.2', '2 1/8', '5.4', 'Small'], ['2.4', '2 1/4', '5.7', 'Small – Medium'],
            ['2.6', '2 3/8', '6.0', 'Medium'], ['2.8', '2 1/2', '6.4', 'Medium – Large'],
        ]);

        // parent => [parent chart, [child => child chart]]
        $tree = [
            'Handloom & Bedding'  => [$bedChart, ['Bedsheets' => null, 'Dohars & Quilts' => null, 'Cushion Covers' => $cushionChart]],
            'Home Decor'          => [null, ['Torans' => null, 'Wall Decor' => null, 'Table Decor' => null]],
            'Earrings'            => [null, ['Jhumkas' => null, 'Studs' => null, 'Chandbalis' => null]],
            'Necklaces'           => [$necklaceChart, ['Choker Sets' => null, 'Temple Jewellery' => null]],
            'Bangles & Bracelets' => [$bangleChart, ['Bangles' => null, 'Kada' => null]],
        ];

        $parentId = [];   // parent name => id
        $child    = [];   // child slug => ['id' => .., 'parent' => .., 'parentName' => ..]
        $sort = 1;
        foreach ($tree as $parentName => [$parentChart, $children]) {
            $pSlug = Str::slug($parentName);
            $pid = $this->put('categories', ['slug' => $pSlug], [
                'name' => $parentName, 'parent_id' => null, 'sort_order' => $sort++,
                'is_popular' => 1, 'status' => 1, 'is_featured' => 0, 'show_in_navbar' => 1,
                'added_by' => $adminId, 'size_chart' => $parentChart,
            ]);
            $parentId[$parentName] = $pid;

            $i = 0;
            foreach ($children as $childName => $childChart) {
                $cSlug = Str::slug($childName);
                $cid = $this->put('categories', ['slug' => $cSlug], [
                    'name' => $childName, 'parent_id' => $pid, 'sort_order' => ++$i,
                    'is_popular' => 0, 'status' => 1, 'is_featured' => 0, 'show_in_navbar' => 0,
                    'added_by' => $adminId, 'size_chart' => $childChart,
                ]);
                $child[$cSlug] = ['id' => $cid, 'parent' => $pid, 'parentName' => $parentName];
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
        // type: color_swatch (round colour dots) or button (text chips).
        // Whether an attribute is SELECTABLE is decided per category below (category_attributes.is_selectable).
        $attrDefs = [
            'Colour' => ['color_swatch', [
                'Red' => '#b3202f', 'Maroon' => '#5e1a33', 'Ivory' => '#f3ecd9', 'Green' => '#1f6b4f',
                'Blue' => '#2a4a86', 'Pink' => '#f1c4cc', 'Black' => '#222222',
            ]],
            'Metal Finish' => ['color_swatch', [
                'Antique Gold' => '#b08d3c', 'Gold-tone' => '#d9b24c', 'Silver-tone' => '#c8ccd2',
                'Rose Gold' => '#d9a38f', 'Oxidised' => '#6b6b6b',
            ]],
            'Size'          => ['button', ['Single Bed', 'Double Bed', 'King Size', 'Free Size']],
            'Necklace Size' => ['button', ['Free Size', 'Choker 14"', 'Princess 17"', 'Matinee 20"']],
            'Bangle Size'   => ['button', ['2.2', '2.4', '2.6', '2.8']],

            // non-selectable (facts + specifications)
            'Material'   => ['button', ['Cotton', 'Brass', 'Ceramic', 'Resin', 'Alloy']],
            'Stone Work' => ['button', ['Kundan', 'Polki', 'Pearl', 'Meenakari', 'Crystal']],
            'Style'      => ['button', ['Traditional', 'Contemporary', 'Bridal', 'Statement', 'Casual']],
            'Pattern'    => ['button', ['Floral', 'Geometric', 'Block Print', 'Paisley', 'Solid', 'Temple']],
            'Closure'    => ['button', ['Adjustable Back', 'Hook', 'Push Back', 'Screw Back', 'Snap On']],
            'Pairs With' => ['button', ['Lehenga', 'Saree', 'Gown', 'Western Wear', 'Ethnic Wear']],
            'Washcare'   => ['button', ['Machine Wash', 'Hand Wash', 'Dry Clean', 'Wipe Clean']],
            'Made In'    => ['button', ['India']],
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

        // ------------------------------------------------- category_attributes
        // sel   = selectable (opt-card on the detail page); false = fact / specification
        // price / image / stock / sku = dependency flags (what kind of variant table the attribute feeds)
        // Order in each list = sort_order = priority for the key facts (first 6 non-selectable are shown).
        $catAttrs = [
            'Handloom & Bedding' => [
                $this->ca('Colour', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Size', sel: true, price: true, stock: true, sku: true, filter: true),
                $this->ca('Material', filter: true),
                $this->ca('Pattern'), $this->ca('Style'), $this->ca('Washcare'), $this->ca('Made In'),
            ],
            'Home Decor' => [
                $this->ca('Colour', sel: true, image: true, stock: true, filter: true),
                $this->ca('Material', filter: true),
                $this->ca('Pattern'), $this->ca('Style'), $this->ca('Washcare'), $this->ca('Made In'),
            ],
            'Earrings' => [
                $this->ca('Metal Finish', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Colour', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Stone Work', filter: true),
                $this->ca('Material'), $this->ca('Style'), $this->ca('Pattern'), $this->ca('Closure'),
                $this->ca('Pairs With'), $this->ca('Made In'),
            ],
            'Necklaces' => [
                $this->ca('Metal Finish', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Colour', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Necklace Size', sel: true, price: true, stock: true, sku: true),
                $this->ca('Stone Work', filter: true),
                $this->ca('Material'), $this->ca('Style'), $this->ca('Pattern'), $this->ca('Closure'), $this->ca('Pairs With'),
            ],
            'Bangles & Bracelets' => [
                $this->ca('Metal Finish', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Colour', sel: true, image: true, stock: true, sku: true, filter: true),
                $this->ca('Bangle Size', sel: true, price: true, stock: true, sku: true),
                $this->ca('Stone Work', filter: true),
                $this->ca('Material'), $this->ca('Style'), $this->ca('Pattern'), $this->ca('Pairs With'),
            ],
        ];

        foreach ($catAttrs as $parentName => $list) {
            foreach ($list as $i => $d) {
                $this->put('category_attributes',
                    ['category_id' => $parentId[$parentName], 'attribute_id' => $attrId[$d['attr']]],
                    [
                        'is_selectable'   => (int) $d['sel'],
                        'used_for_variant' => (int) $d['var'],
                        'price_dependent' => (int) $d['price'],
                        'image_dependent' => (int) $d['image'],
                        'stock_dependent' => (int) $d['stock'],
                        'sku_dependent'   => (int) $d['sku'],
                        'show_in_filter'  => (int) $d['filter'],
                        'show_on_listing' => 1,
                        'sort_order'      => $i + 1,
                        'status'          => 1,
                    ]
                );
            }
        }

        // Values every product of a category gets when the product row doesn't list that attribute itself.
        $defaults = [
            'Handloom & Bedding' => [
                'Pattern' => ['Block Print'], 'Style' => ['Traditional'], 'Washcare' => ['Machine Wash'], 'Made In' => ['India'],
            ],
            'Home Decor' => [
                'Pattern' => ['Geometric'], 'Style' => ['Contemporary'], 'Washcare' => ['Wipe Clean'], 'Made In' => ['India'],
            ],
            'Earrings' => [
                'Material' => ['Alloy'], 'Style' => ['Traditional'], 'Pattern' => ['Floral'], 'Closure' => ['Push Back'],
                'Pairs With' => ['Lehenga', 'Saree'], 'Made In' => ['India'],
            ],
            'Necklaces' => [
                'Necklace Size' => ['Free Size', 'Choker 14"', 'Princess 17"'], 'Material' => ['Alloy'],
                'Style' => ['Bridal', 'Statement'], 'Pattern' => ['Floral'], 'Closure' => ['Adjustable Back'],
                'Pairs With' => ['Lehenga', 'Saree', 'Gown'],
            ],
            'Bangles & Bracelets' => [
                'Bangle Size' => ['2.2', '2.4', '2.6', '2.8'], 'Material' => ['Alloy'],
                'Style' => ['Traditional'], 'Pattern' => ['Floral'], 'Pairs With' => ['Saree', 'Ethnic Wear'],
            ],
        ];

        // Detail-page text per category family. %s = product name.
        $content = [
            'Handloom & Bedding' => [
                'desc' => '<p>%s is woven from soft, breathable cotton that gets better with every wash.</p><p>A calm, timeless piece that suits modern and traditional bedrooms alike.</p>',
                'incl' => "Product as shown\nMatching pillow covers (where applicable)\nCotton carry bag",
                'fit'  => '<p>Measurements are approximate and may vary by 1–2 cm. Cotton can shrink slightly after the first wash.</p>',
                'care' => '<ul><li>Wash separately in cold water.</li><li>Do not bleach.</li><li>Iron on medium heat.</li></ul>',
            ],
            'Home Decor' => [
                'desc' => '<p>%s is handcrafted by skilled artisans and finished by hand, so every piece is slightly unique.</p>',
                'incl' => "Product as shown\nGift-ready packaging",
                'fit'  => '<p>Dimensions are approximate. Slight variations are part of the handmade charm.</p>',
                'care' => '<ul><li>Dust gently with a dry soft cloth.</li><li>Keep away from moisture and direct sunlight.</li></ul>',
            ],
            'Earrings' => [
                'desc' => '<p>%s is a lightweight statement piece with a polished finish that sits comfortably all day.</p>',
                'incl' => "Pair of earrings\nJewellery pouch",
                'fit'  => '<p>Lightweight and comfortable for long wear. Check the drop length against the photos before ordering.</p>',
                'care' => '<ul><li>Keep away from water.</li><li>Avoid perfumes and sprays.</li><li>Clean gently with a dry and soft cloth.</li></ul>',
            ],
            'Necklaces' => [
                'desc' => '<p>%s brings a regal look to weddings, receptions and festive evenings.</p><p>Finished with sparkling stones and a skin-friendly plating.</p>',
                'incl' => "Necklace\nLong Earrings\nMaang Tikka",
                'fit'  => '<p>Sets come with an adjustable back closure. Pick the length that sits where you like it from the size guide.</p>',
                'care' => '<ul><li>Keep away from water.</li><li>Avoid perfumes and sprays.</li><li>Store in the box provided.</li></ul>',
            ],
            'Bangles & Bracelets' => [
                'desc' => '<p>%s is made to stack, share and gift. Smooth edges and a lasting finish.</p>',
                'incl' => "Set of bangles\nJewellery box",
                'fit'  => '<p>Measure the widest part of your hand and compare with the inner diameter in the size guide.</p>',
                'care' => '<ul><li>Keep away from water.</li><li>Wipe with a soft dry cloth after wearing.</li></ul>',
            ],
        ];

        $addonSets = [
            'grih-shree' => [
                ['Gift Wrap', 'Premium wrapping with a ribbon and message card', 99],
                ['Free Carry Bag', 'Reusable cotton carry bag', 0],
                ['Extra Pillow Cover', 'Matching cover in the same print', 249],
            ],
            'pihu-jewel' => [
                ['Gift Ready', 'Gift box with a handwritten-style message card', 0],
                ['Premium Velvet Box', 'Padded velvet box to store the piece', 299],
                ['Anti-Tarnish Pouch', 'Zip pouch that keeps the plating fresh', 149],
            ],
        ];

        // ---------------------------------------------------------------- products
        // [name, brand, child category slug, mrp, price, stock, created N days ago,
        //  occasions[], collections[], attributes[name => [values]], rating (1-5)]
        $products = [
            // ---- Grih Shree (home & living)
            ['Handloom Cotton Bedsheet Set', 'grih-shree', 'bedsheets', 3299, 2499, 40, 90, ['housewarming', 'wedding'], ['best-sellers', 'gift-ideas'], ['Colour' => ['Ivory', 'Blue'], 'Size' => ['Single Bed', 'Double Bed', 'King Size'], 'Material' => ['Cotton']], 5],
            ['Jaipuri Cotton Quilt', 'grih-shree', 'dohars-quilts', 3999, 3199, 25, 60, ['festive'], ['best-sellers'], ['Colour' => ['Pink', 'Green'], 'Size' => ['Double Bed', 'King Size'], 'Material' => ['Cotton'], 'Pattern' => ['Paisley']], 5],
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
            ['Royal Radiance Bridal Necklace Set', 'pihu-jewel', 'choker-sets', 9999, 7500, 6, 8, ['wedding', 'anniversary'], ['new-arrivals', 'premium-collection'], ['Colour' => ['Red', 'Green'], 'Metal Finish' => ['Antique Gold', 'Gold-tone', 'Silver-tone'], 'Stone Work' => ['Kundan', 'Polki']], 5],
            ['Maharani Kundan Chandbali Earrings', 'pihu-jewel', 'chandbalis', 1999, 1400, 35, 6, ['wedding', 'festive'], ['new-arrivals', 'best-sellers'], ['Colour' => ['Pink', 'Green'], 'Metal Finish' => ['Antique Gold', 'Gold-tone'], 'Stone Work' => ['Kundan']], 5],
            ['Crystal Glam Statement Earrings', 'pihu-jewel', 'studs', 2299, 1600, 25, 4, ['party', 'anniversary'], ['new-arrivals'], ['Metal Finish' => ['Silver-tone', 'Rose Gold'], 'Stone Work' => ['Crystal']], 4],
            ['Kundan Choker Necklace', 'pihu-jewel', 'choker-sets', 2599, 1899, 40, 50, ['wedding', 'festive'], ['best-sellers'], ['Colour' => ['Red'], 'Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Kundan', 'Pearl']], 5],
            ['Pearl Drop Earrings', 'pihu-jewel', 'studs', 999, 749, 70, 100, ['festive', 'birthday'], ['best-sellers', 'gift-ideas'], ['Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Pearl']], 4],
            ['Meenakari Bangle Set', 'pihu-jewel', 'bangles', 1799, 1299, 55, 35, ['festive', 'wedding'], ['best-sellers'], ['Colour' => ['Red', 'Green', 'Blue'], 'Metal Finish' => ['Gold-tone', 'Antique Gold'], 'Stone Work' => ['Meenakari']], 4],
            ['Gold Plated Jhumka Earrings', 'pihu-jewel', 'jhumkas', 1199, 849, 45, 90, ['festive', 'diwali'], ['festive-specials'], ['Metal Finish' => ['Gold-tone'], 'Stone Work' => ['Pearl']], 4],
            ['Temple Jewellery Necklace', 'pihu-jewel', 'temple-jewellery', 4999, 3499, 15, 25, ['wedding', 'festive'], ['premium-collection'], ['Metal Finish' => ['Antique Gold'], 'Stone Work' => ['Kundan'], 'Pattern' => ['Temple']], 5],
            ['Oxidised Silver Kada', 'pihu-jewel', 'kada', 1399, 999, 50, 15, ['party', 'birthday'], ['new-arrivals'], ['Metal Finish' => ['Oxidised'], 'Bangle Size' => ['2.4', '2.6', '2.8']], 3],
            ['Polki Choker Necklace Set', 'pihu-jewel', 'choker-sets', 3199, 2299, 22, 40, ['wedding', 'anniversary'], ['premium-collection', 'gift-ideas'], ['Metal Finish' => ['Rose Gold', 'Gold-tone'], 'Stone Work' => ['Polki', 'Crystal']], 4],
            ['Rose Gold Fashion Bracelet', 'pihu-jewel', 'bangles', 899, 599, 33, 14, ['birthday', 'party'], ['new-arrivals', 'gift-ideas'], ['Metal Finish' => ['Rose Gold'], 'Stone Work' => ['Crystal']], 3],
            ['Diamond-look Premium Necklace', 'pihu-jewel', 'choker-sets', 12999, 11999, 5, 2, ['wedding', 'anniversary'], ['premium-collection', 'new-arrivals'], ['Metal Finish' => ['Silver-tone'], 'Stone Work' => ['Crystal']], 5],
            ['Classic Jhumka Studs Combo', 'pihu-jewel', 'jhumkas', 799, 799, 60, 150, ['festive'], [], ['Metal Finish' => ['Gold-tone']], 4],
        ];

        $made = 0;
        $reviewPlan = [];   // product id => target rating

        foreach ($products as $n => [$name, $brandSlug, $catSlug, $mrp, $price, $stock, $daysAgo, $occs, $cols, $attrs, $rating]) {
            $slug       = Str::slug($name);
            $pct        = $mrp > $price ? (int) round((($mrp - $price) / $mrp) * 100) : 0;
            $parentName = $child[$catSlug]['parentName'];
            $sku        = 'SEED-' . strtoupper(substr(md5($slug), 0, 6));
            $text       = $content[$parentName];

            // category defaults fill whatever the product row didn't list
            $attrs = $attrs + ($defaults[$parentName] ?? []);

            // one product gets its own shipping / returns text; the rest stay empty = store default
            $custom = $slug === 'royal-radiance-bridal-necklace-set';

            $pid = $this->put('products', ['slug' => $slug], [
                'category_id'       => $child[$catSlug]['parent'],
                'subcategory_id'    => $child[$catSlug]['id'],
                'brand_id'          => $brand[$brandSlug],
                'name'              => $name,
                'sku'               => $sku,
                'short_description' => 'Beautifully made ' . Str::lower($name) . '.',
                'description'       => sprintf($text['desc'], e($name)),
                'inclusions'        => $text['incl'],
                'size_fit'          => $text['fit'],
                'care_instructions' => $text['care'],
                'shipping_delivery' => $custom ? '<ul><li>Insured, signature-on-delivery shipping.</li><li>Dispatched in 24 hours.</li></ul>' : null,
                'returns_exchange'  => $custom ? '<p>Returns accepted within 3 days of delivery with the original box, tags and certificate.</p>' : null,
                'mrp'               => $mrp,
                'discount_type'     => 'percentage',   // change if your enum differs (e.g. 'percent', 'flat')
                'discount'          => $pct,
                'price'             => $price,
                'stock'             => $stock,
                'min_qty'           => 1,
                'delivery_time'     => '3-5 days',
                'status'            => 1,
                'created_at'        => now()->subDays($daysAgo),
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

            // attribute values (selectable + non-selectable; the category flags decide how each is shown)
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

            // variants (price / image / stock / sku)
            $this->seedVariants($pid, $catAttrs[$parentName], $attrs, $valId, [
                'sku' => $sku, 'mrp' => $mrp, 'price' => $price, 'pct' => $pct,
            ]);

            // addons (sold-out products get none, to test a page without the addon cards)
            if (Schema::hasTable('product_addons')) {
                DB::table('product_addons')->where('product_id', $pid)->delete();
                if ($stock > 0) {
                    foreach ($addonSets[$brandSlug] as [$detail, $description, $addonPrice]) {
                        $this->insert('product_addons', [
                            'product_id' => $pid, 'detail' => $detail, 'description' => $description, 'price' => $addonPrice,
                        ]);
                    }
                }
            }

            $reviewPlan[$pid] = $rating;
            $made++;
        }

        $this->seedCoupons();
        $this->seedPincodes();
        $this->seedReviews($reviewPlan);

        $this->command->info(
            "Seeded: 2 brands, " . count($child) . " subcategories, " . count($occ) . " occasions, " . count($col) .
            " collections, " . count($attrId) . " attributes, {$made} products, {$this->variantCount} variants."
        );
    }

    // ----------------------------------------------------------------- variants

    /**
     * Builds the four independent variant tables for one product.
     * Each type uses only the SELECTABLE attributes whose category flag for that type is on,
     * and only the values this product actually has (cartesian product of those groups).
     */
    private function seedVariants(int $pid, array $def, array $attrs, array $valId, array $p): void
    {
        if (!Schema::hasTable('product_variants') || !Schema::hasTable('product_variant_values')) {
            return;
        }

        // wipe previous demo variants of this product
        $old = DB::table('product_variants')->where('product_id', $pid)->pluck('id');
        if ($old->isNotEmpty()) {
            DB::table('product_variant_values')->whereIn('variant_id', $old)->delete();
            if (Schema::hasTable('product_variant_images')) {
                DB::table('product_variant_images')->whereIn('variant_id', $old)->delete();
            }
            DB::table('product_variants')->whereIn('id', $old)->delete();
        }

        foreach (['price', 'image', 'stock', 'sku'] as $type) {
            $groups = [];
            foreach ($def as $d) {
                if (!$d['sel'] || !$d[$type]) {
                    continue;
                }
                $names = $attrs[$d['attr']] ?? [];
                if (!$names) {
                    continue;
                }
                $groups[] = array_map(fn ($v) => ['id' => $valId[$d['attr']][$v], 'name' => $v], $names);
            }
            if (!$groups) {
                continue;
            }

            $combos = $this->cartesian($groups);

            foreach ($combos as $i => $combo) {
                $names = array_column($combo, 'name');
                $key   = implode('-', array_column($combo, 'id'));
                $hash  = abs(crc32($pid . '-' . $key));

                $row = ['product_id' => $pid, 'type' => $type, 'status' => 1, 'is_available' => 1];

                if ($type === 'price') {
                    $mult = 1 + 0.12 * $i;   // first combination = the product's base price
                    $row += [
                        'mrp'           => (int) round($p['mrp'] * $mult),
                        'discount_type' => 'percentage',
                        'discount'      => $p['pct'],
                        'price'         => (int) round($p['price'] * $mult),
                    ];
                }

                if ($type === 'stock') {
                    $row['stock'] = ($hash % 4 === 0) ? 0 : 5 + ($hash % 25);   // some combinations sold out
                    // test "Not offered": the last combination of a 3+ list does not exist
                    if (count($combos) >= 3 && $i === count($combos) - 1) {
                        $row['is_available'] = 0;
                    }
                }

                if ($type === 'sku') {
                    $suffix = collect($names)
                        ->map(fn ($n) => strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $n), 0, 3)))
                        ->implode('-');
                    $row['sku'] = $p['sku'] . '-' . $suffix;
                }

                // image type: nothing to store here, upload images from admin (variant images need real files)

                $variantId = $this->insertId('product_variants', $row);

                foreach ($combo as $item) {
                    $this->insert('product_variant_values', [
                        'variant_id' => $variantId, 'attribute_value_id' => $item['id'],
                    ]);
                }

                $this->variantCount++;
            }
        }
    }

    private function cartesian(array $groups): array
    {
        $result = [[]];
        foreach ($groups as $group) {
            $next = [];
            foreach ($result as $r) {
                foreach ($group as $item) {
                    $next[] = array_merge($r, [$item]);
                }
            }
            $result = $next;
        }

        return $result;
    }

    // ------------------------------------------------------------------ coupons

    /**
     * Two percentage coupons + one flat are live; one is expired and one is used up
     * (both must NOT appear on the product page).
     * Adjust discount_type values and customer_type if your enum / column differs.
     */
    private function seedCoupons(): void
    {
        if (!Schema::hasTable('coupons')) {
            return;
        }

        $start = now()->subDays(5)->toDateString();
        $end   = now()->addDays(60)->toDateString();

        $coupons = [
            // code, type, value, min order, max discount, min qty, start, end, usage limit, used
            ['PIHUSPECIAL', 'percentage', 10, 2999, 500, 1, $start, $end, null, 0],
            ['FESTIVE25',   'percentage', 25, 4999, 1000, 1, $start, $end, 500, 12],
            ['FLAT200',     'fixed',      200, 1499, null, 1, $start, $end, null, 0],
            ['EXPIRED10',   'percentage', 10, 0, 300, 1, now()->subDays(40)->toDateString(), now()->subDay()->toDateString(), null, 0],
            ['USEDUP15',    'percentage', 15, 0, 400, 1, $start, $end, 10, 10],
        ];

        try {
            foreach ($coupons as [$code, $type, $value, $minAmount, $maxDiscount, $minQty, $from, $to, $limit, $used]) {
                $this->put('coupons', ['code' => $code], [
                    'discount_type'          => $type,
                    'discount_value'         => $value,
                    'minimum_order_amount'   => $minAmount,
                    'maximum_discount'       => $maxDiscount,
                    'minimum_order_quantity' => $minQty,
                    'start_date'             => $from,
                    'end_date'               => $to,
                    'usage_limit'            => $limit,
                    'used_count'             => $used,
                    'customer_type'          => 'all',
                    'status'                 => 1,
                ]);
            }
        } catch (\Throwable $e) {
            $this->command->warn('Coupons skipped: ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------- pincodes

    /** Try 110001 (2 days), 177001 (6 days), 744101 (not serviceable), 999999 (not found). */
    private function seedPincodes(): void
    {
        if (!Schema::hasTable('pincodes')) {
            return;
        }

        $rows = [
            ['110001', 'Delhi', 'New Delhi', 2, 1],
            ['400001', 'Maharashtra', 'Mumbai', 3, 1],
            ['560001', 'Karnataka', 'Bengaluru', 4, 1],
            ['226001', 'Uttar Pradesh', 'Lucknow', 3, 1],
            ['177001', 'Himachal Pradesh', 'Hamirpur', 6, 1],
            ['744101', 'Andaman and Nicobar Islands', 'Port Blair', null, 0],
        ];

        try {
            foreach ($rows as [$pin, $state, $city, $days, $serviceable]) {
                $stateId = Schema::hasTable('states') ? $this->put('states', ['name' => $state], ['status' => 1]) : null;
                $cityId  = Schema::hasTable('cities') ? $this->put('cities', ['name' => $city, 'state_id' => $stateId], ['status' => 1]) : null;

                $this->put('pincodes', ['pincode' => $pin], [
                    'state_id'       => $stateId,
                    'city_id'        => $cityId,
                    'district'       => $city,
                    'is_serviceable' => $serviceable,
                    'delivery_days'  => $days,
                    'status'         => 1,
                ]);
            }
        } catch (\Throwable $e) {
            $this->command->warn('Pincodes skipped: ' . $e->getMessage());
        }
    }

    // ------------------------------------------------------------------ reviews

    /** 3 approved reviews per product, clustered around the target rating. */
    private function seedReviews(array $plan): void
    {
        if (!Schema::hasTable('customers') || !Schema::hasTable('product_reviews')) {
            return;
        }

        try {
            $customers = [];
            foreach ([['Aarohi Sharma', 'aarohi@example.com'], ['Meera Kapoor', 'meera@example.com'], ['Isha Verma', 'isha@example.com']] as $i => [$name, $email]) {
                $customers[] = $this->put('customers', ['email' => $email], [
                    'name' => $name, 'phone' => '987650000' . $i, 'password' => Hash::make('password'), 'status' => 1,
                ]);
            }

            $titles = ['Looks stunning', 'Worth the price', 'Beautiful finish', 'Great gift', 'Lovely quality'];
            $texts  = [
                'Exactly like the pictures. Packaging was neat and delivery was quick.',
                'The finish is really good and it feels premium. Got many compliments.',
                'Lightweight and comfortable. Would happily order again.',
            ];

            foreach ($plan as $pid => $rating) {
                DB::table('product_reviews')->where('product_id', $pid)->delete();

                foreach ($customers as $i => $customerId) {
                    $stars = max(1, min(5, $i === 2 ? $rating - 1 : $rating));
                    $this->insert('product_reviews', [
                        'customer_id'       => $customerId,
                        'product_id'        => $pid,
                        'rating'            => $stars,
                        'title'             => $titles[($pid + $i) % count($titles)],
                        'review'            => $texts[$i],
                        'status'            => 'approved',
                        'verified_purchase' => $i === 0 ? 1 : 0,
                        'created_at'        => now()->subDays(5 + $i * 9),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            $this->command->warn('Reviews skipped: ' . $e->getMessage());
        }
    }

    // ------------------------------------------------------------------ helpers

    /** category_attributes row definition (named args keep the lists above readable). */
    private function ca(
        string $attr,
        bool $sel = false,
        bool $price = false,
        bool $image = false,
        bool $stock = false,
        bool $sku = false,
        bool $filter = false
    ): array {
        return [
            'attr' => $attr, 'sel' => $sel, 'price' => $price, 'image' => $image,
            'stock' => $stock, 'sku' => $sku, 'filter' => $filter,
            'var' => $sel && ($price || $image || $stock || $sku),
        ];
    }

    /** Small HTML table for the size charts. */
    private function table(array $head, array $rows): string
    {
        $html = '<table class="size-table"><thead><tr>'
            . implode('', array_map(fn ($c) => "<th>{$c}</th>", $head))
            . '</tr></thead><tbody>';

        foreach ($rows as $r) {
            $html .= '<tr>' . implode('', array_map(fn ($c) => "<td>{$c}</td>", $r)) . '</tr>';
        }

        return $html . '</tbody></table>';
    }

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

    /** Same as insert() but returns the new id. */
    private function insertId(string $table, array $row): int
    {
        return (int) DB::table($table)->insertGetId(
            $this->only($table, $row + ['created_at' => now(), 'updated_at' => now()])
        );
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