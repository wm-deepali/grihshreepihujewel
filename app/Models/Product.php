<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;


    protected $fillable = [

        'category_id',
        'subcategory_id',
        'brand_id',

        'name',
        'slug',

        'sku',

        'short_description',
        'fabric_material',
        'care_instructions',
        'shipping_delivery',
        'returns_exchange',
        'offers_how_to_avail',

        'mrp',
        'discount_type',
        'discount',
        'price',

        'stock',
        'min_qty',

        'delivery_time',

        'colour_customization',
        'dye_price',

        'meta_title',
        'meta_description',

        'status',

    ];

    protected $casts = [

        'status' => 'boolean',
        'colour_customization' => 'boolean',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    // ✅ new: brand relation (Grih Shree / Pihu Jewel)
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * ✅ Used across all grid/listing views (homepage sections, product
     * listing pages, luxury tabs, etc). Prefers the compressed THUMB
     * (400px) since these are always shown small — falls back to the
     * full image for older rows created before the thumb column existed.
     *
     * Uses the already-loaded `images` relation (forCard() eager loads it)
     * so a grid of 12 cards doesn't fire 1-2 extra queries per card.
     */
    public function getDisplayImageAttribute()
    {
        $img = $this->images->firstWhere('is_default', 1) ?? $this->images->first();

        return $img
            ? asset('storage/' . ($img->thumb ?? $img->image))
            : asset('assets/images/home/pro2.png');
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // ✅ new: product videos (Media → Video)
    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    // ✅ new: addon options (Addon Options section)
    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }

    // OCCASIONS
    public function occasions()
    {
        return $this->belongsToMany(
            GiftingOccasion::class,
            'occasion_product',
            'product_id',
            'occasion_id'
        );
    }

    public function collections()
    {
        return $this->belongsToMany(
            Collection::class,
            'collection_product',
            'product_id',
            'collection_id'
        );
    }

    public function cartItems()
    {
        return $this->hasMany(
            CartItem::class
        );
    }

    public function scopeVisible($query)
    {
        $query->where('status', 1);

        if (StockSetting::current()->auto_disable_out_of_stock) {
            $query->where('stock', '>', 0);
        }

        return $query;
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(ProductReview::class)->where('status', 'approved');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    // card ke liye jo relations aur rating chahiye, ek jagah
    public function scopeForCard($query)
    {
        return $query->with(['images', 'brand:id,name', 'collections:id,name', 'category:id,name', 'subcategory:id,name'])
            ->withAvg('approvedReviews as avg_rating', 'rating');
    }

    // recently viewed: product detail page se call hoga
    public static function trackView(int $id, int $limit = 10): void
    {
        $ids = array_values(array_diff(session('recently_viewed', []), [$id]));
        array_unshift($ids, $id);
        session(['recently_viewed' => array_slice($ids, 0, $limit)]);
    }

    public function getDiscountPercentAttribute(): int
    {
        return $this->mrp > $this->price
            ? (int) round((($this->mrp - $this->price) / $this->mrp) * 100)
            : 0;
    }

    // partials.product-card ko jo array chahiye (static cards jaisa hi shape)
    // needs forCard() so images, brand and avg_rating are loaded
    // $badge = optional override, e.g. ['best', 'fa-crown', 'Best Seller']; default = "New" for products < 30 days old
    public function toCard(?array $badge = null): array
    {
        $pct = $this->discount_percent;

        // first collection of the product becomes the badge text
        $collection = $this->collections->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'img_url' => $this->display_image,
            'url' => url('product/' . $this->slug),
            'brand' => $this->brand?->name,
            'rate' => $this->avg_rating ? number_format($this->avg_rating, 1) : null,
            'sub' => Str::limit(strip_tags((string) $this->short_description), 70),
            'price' => '₹' . number_format($this->price),
            'old' => $pct ? '₹' . number_format($this->mrp) : null,
            'save' => $pct ? $pct . '%' : null,
            'badge' => $badge ?? (
                $collection
                ? ['collection', 'fa-gem', $collection->name]
                : (
                    ($this->created_at && $this->created_at->gt(now()->subDays(30)))
                    ? ['new', 'fa-sparkles', 'New']
                    : null
                )
            ),
        ];
    }

    /**
     * Listing page filters. Keys of $f (all optional):
     * brand, category_ids[], price_min, price_max, in_stock, occasion[],
     * collection[], rating, discount, attrs[attribute_id => value_ids[]]
     */
    public function scopeFilter($query, array $f)
    {
        return $query
            ->when(!empty($f['brand']), fn($q) => $q->where('brand_id', $f['brand']))

            // category matches either the main category or the subcategory
            ->when(!empty($f['category_ids']), fn($q) => $q->where(function ($w) use ($f) {
                $w->whereIn('category_id', $f['category_ids'])
                    ->orWhereIn('subcategory_id', $f['category_ids']);
            }))

            ->when(!empty($f['price_min']), fn($q) => $q->where('price', '>=', $f['price_min']))
            ->when(!empty($f['price_max']), fn($q) => $q->where('price', '<=', $f['price_max']))

            ->when(!empty($f['in_stock']), fn($q) => $q->where('stock', '>', 0))

            ->when(!empty($f['occasion']), fn($q) => $q->whereHas(
                'occasions',
                fn($o) => $o->whereIn($o->getModel()->getQualifiedKeyName(), $f['occasion'])
            ))

            ->when(!empty($f['collection']), fn($q) => $q->whereHas(
                'collections',
                fn($c) => $c->whereIn($c->getModel()->getQualifiedKeyName(), $f['collection'])
            ))

            // avg of approved reviews >= selected rating
            ->when(!empty($f['rating']), fn($q) => $q->whereRaw(
                '(select avg(rating) from product_reviews where product_reviews.product_id = products.id and product_reviews.status = ?) >= ?',
                ['approved', $f['rating']]
            ))

            // discount % = (mrp - price) / mrp * 100
            ->when(!empty($f['discount']), fn($q) => $q->whereRaw(
                'mrp > 0 and ((mrp - price) / mrp) * 100 >= ?',
                [$f['discount']]
            ))

            // OR within one attribute, AND across different attributes
            ->when(!empty($f['attrs']), function ($q) use ($f) {
                foreach ($f['attrs'] as $valueIds) {
                    $q->whereHas('attributeValues', fn($a) => $a->whereIn('attribute_value_id', $valueIds));
                }
            });
    }

    public function scopeOrderForListing($query, ?string $sort)
    {
        switch ($sort) {
            case 'low':
                $query->orderBy('price');
                break;
            case 'high':
                $query->orderByDesc('price');
                break;
            case 'rating':
                $query->orderByDesc('avg_rating'); // forCard() ka alias
                break;
            case 'sold':
                if (method_exists($this, 'orderDetails')) {
                    $query->withSum('orderDetails as sold_qty', 'quantity')->orderByDesc('sold_qty');
                } else {
                    $query->orderByDesc('created_at'); // relation nahi to crash ki jagah newest
                }
                break;
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            case 'discount':
                $query->orderByRaw('CASE WHEN mrp > 0 THEN (mrp - price) / mrp ELSE 0 END DESC');
                break;
        }

        // tie-breaker: barabar values par bhi order stable rahe
        return $query->orderByDesc('id');
    }

    /**
     * Customer ka pehla aisa order item jo is product ka hai, deliver ho chuka hai,
     * aur jis par abhi tak review nahi diya gaya. Nahi mila to null.
     */
    public function reviewableOrderItemFor(int $customerId): ?OrderItem
    {
        $reviewed = ProductReview::where('customer_id', $customerId)
            ->where('product_id', $this->id)
            ->whereNotNull('order_item_id')
            ->pluck('order_item_id');

        return OrderItem::where('product_id', $this->id)
            ->whereNotIn('id', $reviewed)
            ->whereHas('order', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId)
                    ->whereIn('status', ['delivered', 'completed']); // apne status values yahan rakho
            })
            ->orderBy('id')
            ->first();
    }

}