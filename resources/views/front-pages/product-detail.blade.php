@extends('layouts.app')

@php
  $productName = $product->name;
  $productSku = $product->sku;

  $finishes = [
    ['v' => 'antique-gold', 'n' => 'Antique Gold-tone', 'c' => '#b08d3c', 'on' => true],
    ['v' => 'gold', 'n' => 'Gold-tone', 'c' => '#d9b24c'],
    ['v' => 'silver', 'n' => 'Silver-tone', 'c' => '#c8ccd2'],
    ['v' => 'rose-gold', 'n' => 'Rose Gold', 'c' => '#d9a38f'],
    ['v' => 'oxidised', 'n' => 'Oxidised', 'c' => '#6b6b6b', 'off' => true],
  ];

  $stones = [
    ['v' => 'crystal-white', 'n' => 'Crystal White', 'c' => '#f4f8ff', 'on' => true],
    ['v' => 'ruby-pink', 'n' => 'Ruby Pink', 'c' => '#c2185b'],
    ['v' => 'emerald-green', 'n' => 'Emerald Green', 'c' => '#1f8a5b'],
    ['v' => 'sapphire-blue', 'n' => 'Sapphire Blue', 'c' => '#2a4a86'],
    ['v' => 'multi', 'n' => 'Multicolour', 'c' => 'conic-gradient(#c2185b, #1f8a5b, #f4f8ff, #2a4a86, #c2185b)'],
    ['v' => 'pearl-white', 'n' => 'Pearl White', 'c' => '#f3ecd9', 'off' => true],
  ];

  $wearers = [
    ['v' => 'women', 'n' => 'Women', 'on' => true],
    ['v' => 'teens', 'n' => 'Teens'],
    ['v' => 'girls', 'n' => 'Girls (4–12 yrs)', 'off' => true],
  ];

  // backend: render only the group that matches the product's subcategory
  $sizeGroups = [
    [
      'label' => 'Necklace / Earrings / Sets',
      'sq' => false,
      'opts' => [
        ['v' => 'free', 'n' => 'Free Size', 't' => 'Free Size', 'on' => true],
        ['v' => 'choker-14', 'n' => 'Choker 14"', 't' => 'Choker 14"'],
        ['v' => 'princess-17', 'n' => 'Princess 17"', 't' => 'Princess 17"'],
        ['v' => 'matinee-20', 'n' => 'Matinee 20"', 't' => 'Matinee 20"', 'off' => true],
      ]
    ],
    [
      'label' => 'Ring Size (India)',
      'sq' => true,
      'opts' => [
        ['v' => 'ring-10', 'n' => 'Ring 10', 't' => '10'],
        ['v' => 'ring-12', 'n' => 'Ring 12', 't' => '12'],
        ['v' => 'ring-14', 'n' => 'Ring 14', 't' => '14'],
        ['v' => 'ring-16', 'n' => 'Ring 16', 't' => '16', 'off' => true],
        ['v' => 'ring-18', 'n' => 'Ring 18', 't' => '18'],
      ]
    ],
    [
      'label' => 'Bangle Size (inch)',
      'sq' => true,
      'opts' => [
        ['v' => 'bangle-2.2', 'n' => 'Bangle 2.2', 't' => '2.2', 'off' => true],
        ['v' => 'bangle-2.4', 'n' => 'Bangle 2.4', 't' => '2.4'],
        ['v' => 'bangle-2.6', 'n' => 'Bangle 2.6', 't' => '2.6'],
        ['v' => 'bangle-2.8', 'n' => 'Bangle 2.8', 't' => '2.8'],
      ]
    ],
  ];
@endphp

@section('title', 'Product Detail | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/sass/detail/detail.css') }}" />
@endpush

@section('content')
  <!-- ===================== SEC A : PRODUCT ===================== -->
  <section class="detail-secA">
    <div class="container">

      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        @foreach($crumbs as [$label, $url])
          <li><a href="{{ $url }}">{{ $label }}</a></li>
          <li><i class="fa-solid fa-chevron-right"></i></li>
        @endforeach
        <li class="current">{{ $product->name }}</li>
      </ul>

      <div class="detail-layout">
        <!-- ============ GALLERY ============ -->
        <div class="detail-gallery">
          <div class="gallery-main">
            @if($product->created_at && $product->created_at->gt(now()->subDays(30)))
              <span class="gallery-tag">New</span>
            @endif
            <div class="swiper detailMain">
              <div class="swiper-wrapper">
                @foreach($gallery as $g)
                  <div class="swiper-slide">
                    <a href="{{ $g['url'] }}" class="gallery-img glightbox" data-gallery="product">
                      <img src="{{ $g['url'] }}" alt="{{ $g['alt'] }}" @if($loop->first) fetchpriority="high" @else
                      loading="lazy" @endif />
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
            @if($gallery->count() > 1)
              <button type="button" class="g-prev" aria-label="Previous image"><i
                  class="fa-solid fa-chevron-left"></i></button>
              <button type="button" class="g-next" aria-label="Next image"><i
                  class="fa-solid fa-chevron-right"></i></button>
            @endif
            <span class="gallery-counter">01 / {{ str_pad($gallery->count(), 2, '0', STR_PAD_LEFT) }}</span>
          </div>

          @if($gallery->count() > 1)
            <div class="thumb-list">
              @foreach($gallery as $g)
                <button type="button" class="{{ $loop->first ? 'active' : '' }}"
                  aria-label="View image {{ $loop->iteration }}">
                  <img src="{{ $g['thumb'] }}" alt="" loading="lazy" />
                </button>
              @endforeach
            </div>
          @endif

          <ul class="gallery-trust">
            <li><i class="fa-solid fa-truck-fast"></i><span>Ready to Ship</span></li>
            <li><i class="fa-solid fa-shield-halved"></i><span>Secure Payments</span></li>
            <li><i class="fa-solid fa-arrow-right-arrow-left"></i><span>7-Day Returns</span></li>
          </ul>
        </div>

        <!-- ============ INFO ============ -->
        <div class="detail-info">
          @php
            $eyebrow = collect([
              $product->brand?->name,
              $product->subcategory?->name ?? $product->category?->name,
            ])->filter()->implode(' · ');
          @endphp

          @if($eyebrow)
            <span class="eyebrow">{{ $eyebrow }}</span>
          @endif
          <h1>{{ $productName }}</h1>

          <div class="info-rate">
            @if($product->reviews_count)
              <span class="rate-pill"><i class="fa-solid fa-star"></i> {{ number_format($product->avg_rating, 1) }}</span>
              <a href="#reviews" class="rate-count">{{ $product->reviews_count }}
                {{ $product->reviews_count === 1 ? 'Review' : 'Reviews' }}</a>
            @else
              <a href="#reviews" class="rate-count">No reviews yet</a>
            @endif
            @if($product->sku)
              <span class="info-sku">SKU: {{ $product->sku }}</span>
            @endif
          </div>

          @php $pct = $product->discount_percent; @endphp
          <div class="info-price">
            <div class="price-line">
              <span class="price-now">₹{{ number_format($product->price) }}</span>
              @if($pct)
                <span class="price-old">₹{{ number_format($product->mrp) }}</span>
                <span class="price-off">{{ $pct }}% OFF</span>
              @endif
            </div>
            <div class="price-meta">
              @if($pct)
                <p class="price-save"><i class="fa-solid fa-tags"></i> You save
                  <b>₹{{ number_format($product->mrp - $product->price) }}</b> on this piece
                </p>
              @endif
              <p class="price-tax">Inclusive of all taxes</p>
            </div>
          </div>

          @if($product->short_description)
            <p class="info-desc">{{ strip_tags($product->short_description) }}</p>
          @endif

          <ul class="info-tags">
            <li>Bridal</li>
            <li>Wedding</li>
            <li>Reception</li>
            <li>Festive</li>
          </ul>

          <!-- ================= KEY FACTS ================= -->
          <ul class="info-facts">
            <li><small>Product Type</small><b>Bridal Necklace Set</b></li>
            <li><small>Colour</small><b>Antique Gold-tone</b></li>
            <li><small>Stone Work</small><b>Sparkling White Stones</b></li>
            <li><small>Stone Colour</small><b>Crystal White</b></li>
            <li><small>Style</small><b>Bridal, Statement</b></li>
            <li><small>Occasion</small><b>Weddings, Receptions, Festivals</b></li>
          </ul>

          <!-- ================= OPTIONS ================= -->
          <div class="opt-duo">
            <div class="opt-card">
              <div class="opt-head">
                <span>Finish</span><b class="opt-value">Antique Gold-tone</b>
              </div>
              <div class="opt-swatches">
                @foreach($finishes as $o)
                  <label class="opt-swatch" title="{{ $o['n'] }}{{ !empty($o['off']) ? ' (not available)' : '' }}">
                    <input type="radio" name="finish" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}" {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
                    <span style="--c: {{ $o['c'] }}"></span>
                  </label>
                @endforeach
              </div>
            </div>

            <div class="opt-card">
              <div class="opt-head">
                <span>Stone Colour</span><b class="opt-value">Crystal White</b>
              </div>
              <div class="opt-swatches">
                @foreach($stones as $o)
                  <label class="opt-swatch" title="{{ $o['n'] }}{{ !empty($o['off']) ? ' (not available)' : '' }}">
                    <input type="radio" name="stone" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}" {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
                    <span style="--c: {{ $o['c'] }}"></span>
                  </label>
                @endforeach
              </div>
            </div>
          </div>

          <div class="opt-card">
            <div class="opt-head">
              <span>Suitable For</span><b class="opt-value">Women</b>
            </div>
            <div class="opt-sizes">
              @foreach($wearers as $o)
                <label class="opt-size">
                  <input type="radio" name="wearer" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}" {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
                  <span>{{ $o['n'] }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="opt-card">
            <div class="opt-head">
              <span>Size</span><b class="opt-value">Free Size</b>
              <button type="button" class="size-guide" data-model=".size-pop">
                <i class="fa-solid fa-ruler"></i> Size Guide
              </button>
            </div>

            @foreach($sizeGroups as $group)
              <div class="opt-group">
                <span class="opt-sub">{{ $group['label'] }}</span>
                <div class="opt-sizes">
                  @foreach($group['opts'] as $o)
                    <label class="opt-size {{ $group['sq'] ? 'is-sq' : '' }}">
                      <input type="radio" name="jsize" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}" {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
                      <span>{{ $o['t'] }}</span>
                    </label>
                  @endforeach
                </div>
              </div>
            @endforeach

            <p class="opt-note">
              <i class="fa-solid fa-circle-info"></i> Buying for a girl or teen? Check the size guide before
              choosing. Sets come with an adjustable back closure.
            </p>
          </div>

          <!-- ================= GIFT ================= -->
          <div class="opt-card opt-gift">
            <label class="opt-switch">
              <input type="checkbox" name="gift_ready" value="yes" />
              <span class="os-text">Gift Ready<small>Gift box with a handwritten-style message card</small></span>
              <strong>Free</strong>
              <span class="os-track"></span>
            </label>
            <div class="gift-msg">
              <textarea name="gift_message" rows="2" maxlength="120" placeholder="Write your gift message (optional)"
                aria-label="Gift message"></textarea>
            </div>
          </div>

          <p class="info-stock">
            <i class="fa-solid fa-circle"></i><b>In Stock</b><em>Ready to ship, dispatched within 48 hours</em>
          </p>

          <div class="info-actions">
            <div class="act-top">
              <div class="qty-box">
                <button type="button" class="qty-minus" aria-label="Decrease quantity"><i
                    class="fa-solid fa-minus"></i></button>
                <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
                <button type="button" class="qty-plus" aria-label="Increase quantity"><i
                    class="fa-solid fa-plus"></i></button>
              </div>
              <button type="button" class="wish-link"><i class="fa-regular fa-heart"></i> Add to Wishlist</button>
            </div>
            <div class="act-btns">
              <button type="button" data-id="{{ $productSku }}" data-name="{{ $productName }}"
                data-toast-title="Added to Cart" data-toast-text="{{ $productName }} has been added to your cart."
                data-toast-type="success" class="btn btn-outline-black">Add to Cart</button>
              <a href="{{ url('cart') }}" class="btn btn-primary">Buy Now</a>
            </div>
          </div>

          <div class="info-delivery">
            <div class="del-head"><i class="fa-solid fa-location-dot"></i><b>Check Delivery</b></div>
            <form class="pin-form" action="#" method="post">
              @csrf
              <input type="text" name="pincode" inputmode="numeric" maxlength="6" placeholder="Enter your pincode"
                aria-label="Pincode" />
              <button type="submit">Check</button>
            </form>
            <p class="pin-result">
              <i class="fa-solid fa-circle-info"></i>
              <span>Enter your pincode to see delivery time and COD availability.</span>
            </p>
            <ul class="del-points">
              <li><i class="fa-solid fa-truck-fast"></i> Ready to ship, dispatched within 48 hours</li>
              <li><i class="fa-solid fa-map-location-dot"></i> Pan-India delivery, reliable and tracked</li>
              <li><i class="fa-solid fa-hand-holding-dollar"></i> Cash on Delivery on selected pincodes</li>
              <li><i class="fa-solid fa-arrow-right-arrow-left"></i> Easy 7-day return and exchange</li>
              <li><i class="fa-solid fa-shield-halved"></i> Secure payments, safe and trusted checkout</li>
            </ul>
          </div>

          <!-- ================= OFFERS ================= -->
          <div class="info-offers">
            <div class="offers-head">
              <h5>Offers &amp; Coupons</h5>
            </div>

            <div class="offer-row">
              <span class="offer-ico"><i class="fa-solid fa-gift"></i></span>
              <div class="offer-text">
                <b>Jewellery Special</b>
                <p>Extra savings on selected jewellery styles.</p>
              </div>
              <button type="button" class="coupon-copy" data-copy="PIHUSPECIAL" aria-label="Copy coupon code">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" stroke-linejoin="round">
                  <rect x="9" y="9" width="11" height="11" rx="2" />
                  <path d="M5 15V6a2 2 0 012-2h9" />
                </svg>
                <span>PIHUSPECIAL</span>
              </button>
            </div>
            <div class="offer-row">
              <span class="offer-ico"><i class="fa-solid fa-percent"></i></span>
              <div class="offer-text">
                <b>Festive Offer</b>
                <p>Save up to 25% on selected jewellery.</p>
              </div>
            </div>
            <div class="offer-row">
              <span class="offer-ico"><i class="fa-solid fa-box-open"></i></span>
              <div class="offer-text">
                <b>Free Gift Box</b>
                <p>Add Gift Ready above for a free gift box and message card.</p>
              </div>
            </div>
          </div>

          <!-- ================= PERKS ================= -->
          <div class="info-perks">
            <div class="perk">
              <i class="fa-solid fa-gem"></i>
              <div><b>Statement Finish</b>
                <p>Antique gold-tone with sparkling stones.</p>
              </div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-shirt"></i>
              <div><b>Pairs With</b>
                <p>Lehengas, Sarees, Gowns, Traditional Outfits.</p>
              </div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-truck-fast"></i>
              <div><b>Ready to Ship</b>
                <p>Dispatched within 48 hours.</p>
              </div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-arrow-right-arrow-left"></i>
              <div><b>7-Day Returns</b>
                <p>Easy return and exchange.</p>
              </div>
            </div>
          </div>

          <div class="info-help">
            <div class="help-text">
              <b>Need help choosing?</b>
              <p>Talk to our styling team about sizes, outfits, occasions and gifting.</p>
            </div>
            <div class="help-links">
              <a href="javascript:void(0)" class="help-link"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
              <a href="javascript:void(0)" class="help-link"><i class="fa-solid fa-phone"></i> Call Us</a>
            </div>
          </div>

          <!-- ============ ACCORDION (common JS, class .active) ============ -->
          <div class="accordion-wrapper">
            <div class="accordion-item active">
              <button type="button" class="accordion-header">
                <h4>Product Specifications</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <div class="spec-cols">
                      <ul class="spec-list">
                        <li><span>Design</span><b>Multi-layered statement necklace</b></li>
                        <li><span>Pattern</span><b>Cascading, teardrop and geometric</b></li>
                      </ul>
                      <ul class="spec-list">
                        <li><span>Look</span><b>Royal, bridal statement</b></li>
                        <li><span>Stone Setting</span><b>Intricate stone detailing</b></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <button type="button" class="accordion-header">
                <h4>What Comes in the Box</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <ul class="box-list">
                      <li><span class="bx-ico"><i class="fa-solid fa-gem"></i></span><b>Necklace</b></li>
                      <li><span class="bx-ico"><i class="fa-solid fa-droplet"></i></span><b>Long Earrings</b></li>
                      <li><span class="bx-ico"><i class="fa-solid fa-crown"></i></span><b>Maang Tikka</b></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <button type="button" class="accordion-header">
                <h4>Size &amp; Fit</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <ul class="info-points">
                      <li>Multi-layered statement necklace designed to sit beautifully on the neckline.</li>
                      <li>Rings, bangles and kids' pieces come in specific sizes, so check the size guide.</li>
                    </ul>
                    <button type="button" class="policy-link" data-model=".size-pop">
                      Open Size Guide <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <button type="button" class="accordion-header">
                <h4>Care Instructions</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <ul class="info-points">
                      <li>Keep away from water.</li>
                      <li>Avoid perfumes and sprays.</li>
                      <li>Clean gently with a dry and soft cloth.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <button type="button" class="accordion-header">
                <h4>Shipping &amp; Delivery</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <ul class="info-points">
                      <li>Ready to ship items are dispatched within 48 hours.</li>
                      <li>Delivery in 3–7 working days depending on location.</li>
                      <li>A tracking link is shared by email and SMS.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <button type="button" class="accordion-header">
                <h4>Returns &amp; Exchange</h4>
                <span class="accordion-icon">+</span>
              </button>
              <div class="accordion-content">
                <div class="acc-inner">
                  <div class="acc-body">
                    <p>
                      Unused items with original tags and packaging can be returned or exchanged within 7 days of
                      delivery.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ============ STICKY BUY BAR (shows when .info-actions leaves the screen) ============ -->
    <div class="detail-sticky">
      <div class="ds-product">
        <img src="{{ $gallery[0]['thumb'] }}" alt="{{ $product->name }}" />
        <div class="ds-text">
          <b>{{ $product->name }}</b>
          <span><strong>₹{{ number_format($product->price) }}</strong>@if($product->discount_percent)<em>{{ $product->discount_percent }}%
          OFF</em>@endif</span>
        </div>
      </div>

      <div class="ds-actions">
        <div class="qty-box">
          <button type="button" class="qty-minus" aria-label="Decrease quantity"><i
              class="fa-solid fa-minus"></i></button>
          <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
          <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
        </div>
        <button type="button" data-id="{{ $productSku }}" data-name="{{ $productName }}" data-toast-title="Added to Cart"
          data-toast-text="{{ $productName }} has been added to your cart." data-toast-type="success"
          class="btn btn-outline-black">Add to Cart</button>
        <a href="{{ url('cart') }}" class="btn btn-primary">Buy Now</a>
      </div>
    </div>
  </section>

  <!-- ===================== SEC E : STILL ON YOUR MIND ===================== -->
  @if($recentlyViewed->isNotEmpty())
    <section class="detail-secE">
      <div class="container">
        <div class="heading">
          <span>Recently Viewed</span>
          <h3>Still on Your <span>Mind?</span></h3>
          <p>Revisit the styles that caught your eye and find your perfect match.</p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
            <div class="swiper-wrapper">
              @foreach($recentlyViewed as $card)
                <div class="swiper-slide">
                  @include('partials.product-card', ['p' => $card, 'showBadge' => false])
                </div>
              @endforeach
            </div>
          </div>
          <div class="swiper-group">
            <button type="button" class="btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
            <button type="button" class="btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- ===================== SEC C : REVIEWS ===================== -->
  <section class="detail-secC" id="reviews">
    <div class="container">
      <div class="heading">
        <span>Customer Reviews</span>
        <h3>What Our <span>Customers Say</span></h3>
        <p>Honest words from people who love what they bought.</p>
      </div>

      @if($reviewCount)
        <div class="review-board">
          <div class="rb-score">
            <b>{{ number_format($reviewAvg, 1) }}</b>
            <em>out of 5</em>
            <div class="rb-stars">
              @for($s = 1; $s <= 5; $s++)<i
              class="fa-{{ $s <= round($reviewAvg) ? 'solid' : 'regular' }} fa-star"></i>@endfor
            </div>
            <p>Based on {{ $reviewCount }} {{ $reviewCount === 1 ? 'review' : 'reviews' }}</p>
            @include('partials.review-cta', ['btnClass' => 'btn-white'])
          </div>

          <div class="rb-detail">
            <ul class="rb-bars">
              @foreach($reviewBars as [$star, $pct, $cnt])
                <li>
                  <span>{{ $star }} <i class="fa-solid fa-star"></i></span>
                  <div class="bar"><i style="width: {{ $pct }}%"></i></div>
                  <em>{{ $cnt }}</em>
                </li>
              @endforeach
            </ul>

            <div class="rb-love">
              <h5>Customers love</h5>
              <ul>
                <li><i class="fa-solid fa-gem"></i> Sparkle &amp; Shine</li>
                <li><i class="fa-solid fa-crown"></i> Premium Look</li>
                <li><i class="fa-solid fa-feather"></i> Lightweight</li>
                <li><i class="fa-solid fa-indian-rupee-sign"></i> Value for Money</li>
                <li><i class="fa-solid fa-gift"></i> Gift Packaging</li>
              </ul>
            </div>
          </div>
        </div>

        @if($reviewPhotos->isNotEmpty())
          <div class="review-photos">
            <h5>Customer Photos <span>({{ $reviewPhotos->count() }})</span></h5>
            <div class="rp-grid">
              @foreach($reviewPhotos as $img)
                <a href="{{ $img }}"
                  class="rp-item glightbox {{ $loop->index === 5 && $reviewPhotos->count() > 6 ? 'more' : '' }}"
                  data-gallery="customer-photos" @if($loop->index > 5) style="display:none" @endif>
                  <img src="{{ $img }}" alt="Customer photo {{ $loop->iteration }}" loading="lazy" />
                  @if($loop->index === 5 && $reviewPhotos->count() > 6)<span>+{{ $reviewPhotos->count() - 6 }}</span>@endif
                </a>
              @endforeach
            </div>
          </div>
        @endif

        <div class="review-bar">
          <ul class="tab-nav">
            @foreach($reviewTabs as $tabNo => $tab)
              <li class="{{ $loop->first ? 'active' : '' }}" data-tab="{{ $tabNo }}">{{ $tab['label'] }}
                ({{ $tab['items']->count() }})</li>
            @endforeach
          </ul>
        </div>

        <div class="tab-nav-content">
          @foreach($reviewTabs as $tabNo => $tab)
            <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $tabNo }}">
              @if($tab['items']->isEmpty())
                <p style="text-align:center">No reviews in this tab yet.</p>
              @else
                <div class="swiper-wrap">
                  <div class="swiper fourSlider" data-mob="1.1" data-sm="2.2" data-lg="3" data-xl="3">
                    <div class="swiper-wrapper">
                      @foreach($tab['items'] as $i => $r)
                        <div class="swiper-slide">
                          <div class="rev-card">
                            <i class="fa-solid fa-quote-right rev-quote"></i>
                            <div class="rev-stars">
                              @for($s = 1; $s <= 5; $s++)<i
                              class="fa-{{ $s <= $r['stars'] ? 'solid' : 'regular' }} fa-star"></i>@endfor
                            </div>
                            @if($r['title'])
                            <h6>{{ $r['title'] }}</h6>@endif
                            <p>{{ $r['text'] }}</p>
                            @if($tab['photos'] && count($r['photos']))
                              <div class="rev-photos">
                                @foreach($r['photos'] as $ph)
                                  <a href="{{ $ph }}" class="glightbox" data-gallery="rv-{{ $tabNo }}-{{ $i }}">
                                    <img src="{{ $ph }}" alt="Review photo" loading="lazy" />
                                  </a>
                                @endforeach
                              </div>
                            @endif
                            <div class="rev-user">
                              <span class="rev-avatar">{{ $r['init'] }}</span>
                              <div>
                                <h5>{{ $r['user'] }}</h5>
                                @if($r['verified'])
                                  <span class="rev-verified"><i class="fa-solid fa-circle-check"></i> Verified Purchase</span>
                                @endif
                              </div>
                            </div>
                            <div class="rev-foot">
                              <span class="rev-date">{{ $r['date'] }}</span>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="swiper-group">
                    <button type="button" class="btn-prev" aria-label="Previous">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M15 5l-7 7 7 7" />
                      </svg>
                    </button>
                    <button type="button" class="btn-next" aria-label="Next">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 5l7 7-7 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endif
            </div>
          @endforeach
        </div>
      @else
        <div style="text-align:center">
          <p>No reviews yet. Be the first to share your thoughts on this piece.</p>
          @include('partials.review-cta', ['btnClass' => 'btn-primary'])
        </div>
      @endif
    </div>
  </section>

  <!-- ===================== SEC D : YOU MAY ALSO LOVE ===================== -->
  @if($related->isNotEmpty())
    <section class="detail-secD">
      <div class="container">
        <div class="heading">
          <span>Curated for You</span>
          <h3>You May <span>Also Love</span></h3>
          <p>Discover more pieces selected to complete your look.</p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
            <div class="swiper-wrapper">
              @foreach($related as $card)
                <div class="swiper-slide">
                  @include('partials.product-card', ['p' => $card])
                </div>
              @endforeach
            </div>
          </div>
          <div class="swiper-group">
            <button type="button" class="btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
            <button type="button" class="btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
          </div>
        </div>

        @if($product->category)
          <div class="sec-btn">
            <a href="{{ route('category.show', $product->category->slug) }}" class="btn btn-outline-primary">View All
              {{ $product->category->name }}</a>
          </div>
        @endif
      </div>
    </section>
  @endif

@endsection

{{-- Page-only modals. Add @stack('modals') in layouts/app.blade.php just above <div class="overlay"></div> --}}
@push('modals')
  <!-- ===================== REVIEW POP ===================== -->
  @if($reviewState === 'can')
    <div class="model review-pop">
      <button type="button" class="close" aria-label="Close review">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <path d="M5 5l14 14M19 5L5 19" />
        </svg>
      </button>
      <div class="model-body">
        <div class="title">
          <h4>Write a Review</h4>
          <p>{{ $productName }}</p>
        </div>

        <form class="form review-form" action="{{ route('product.review.store', $product) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="rf-rate">
            <span>Your Rating</span>
            <div class="rate-input">
              @foreach([5, 4, 3, 2, 1] as $n)
                <input type="radio" name="rating" id="rate{{ $n }}" value="{{ $n }}" />
                <label for="rate{{ $n }}" aria-label="{{ $n }} {{ $n === 1 ? 'star' : 'stars' }}"><i
                    class="fa-solid fa-star"></i></label>
              @endforeach
            </div>
          </div>
          <div class="form-group">
            <input type="text" id="rvTitle" name="title" placeholder=" " maxlength="150" required />
            <label for="rvTitle">Review Title</label>
          </div>
          <div class="form-group">
            <textarea id="rvText" name="review" placeholder=" " minlength="10" maxlength="2000" required></textarea>
            <label for="rvText">Tell us about the finish, sparkle and fit</label>
          </div>
          <div class="rf-upload">
            <label class="upload-box" for="rvPhotos">
              <i class="fa-regular fa-image"></i>
              <b>Add Photos <em>(optional)</em></b>
              <span>Up to 5 photos · JPG, PNG or WebP · max 5MB each</span>
              <input type="file" id="rvPhotos" name="photos[]" accept="image/jpeg,image/png,image/webp" multiple />
            </label>
            <div class="upload-preview"></div>
          </div>

          <p class="rf-msg" role="status" hidden></p>

          <div class="rf-submit">
            <button type="submit" class="btn btn-primary">Submit Review</button>
            <p>Your review will appear after our team approves it.</p>
          </div>
        </form>
      </div>
    </div>
  @endif
  <!-- ===================== SIZE GUIDE POP ===================== -->
  <div class="model size-pop">
    <button type="button" class="close" aria-label="Close size guide">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <path d="M5 5l14 14M19 5L5 19" />
      </svg>
    </button>
    <div class="model-body">
      <div class="title">
        <h4>Size Guide</h4>
        <p>Measurements are approximate. Choose the size closest to your own measurements.</p>
      </div>

      <div class="sg-body">
        <!-- ================= JEWELLERY ================= -->
        <div class="sg-var for-jewel">
          <ul class="tab-nav">
            <li class="active" data-tab="1">Necklace Length</li>
            <li data-tab="2">Bangles</li>
            <li data-tab="3">Rings</li>
          </ul>

          <div class="tab-nav-content">
            <div class="tabs active" data-tab="1">
              <div class="size-table-wrap">
                <table class="size-table">
                  <thead>
                    <tr>
                      <th>Style</th>
                      <th>Length (in)</th>
                      <th>Sits At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Choker</td>
                      <td>14 – 16</td>
                      <td>Base of the neck</td>
                    </tr>
                    <tr>
                      <td>Princess</td>
                      <td>17 – 19</td>
                      <td>Collarbone</td>
                    </tr>
                    <tr>
                      <td>Matinee</td>
                      <td>20 – 24</td>
                      <td>Above the bust</td>
                    </tr>
                    <tr>
                      <td>Long Haar</td>
                      <td>28 – 36</td>
                      <td>Below the bust</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li><b>Tip:</b> measure around your neck with a soft tape, then add the length you want the necklace to
                  drop.</li>
                <li>Statement bridal sets look best on a deep neckline or an open back.</li>
              </ul>
            </div>

            <div class="tabs" data-tab="2">
              <div class="size-table-wrap">
                <table class="size-table">
                  <thead>
                    <tr>
                      <th>Size</th>
                      <th>Inner Dia (in)</th>
                      <th>Inner Dia (cm)</th>
                      <th>Wrist</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2.2</td>
                      <td>2 1/8</td>
                      <td>5.4</td>
                      <td>Small</td>
                    </tr>
                    <tr>
                      <td>2.4</td>
                      <td>2 1/4</td>
                      <td>5.7</td>
                      <td>Small – Medium</td>
                    </tr>
                    <tr>
                      <td>2.6</td>
                      <td>2 3/8</td>
                      <td>6.0</td>
                      <td>Medium</td>
                    </tr>
                    <tr>
                      <td>2.8</td>
                      <td>2 1/2</td>
                      <td>6.4</td>
                      <td>Medium – Large</td>
                    </tr>
                    <tr>
                      <td>2.10</td>
                      <td>2 5/8</td>
                      <td>6.7</td>
                      <td>Large</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li><b>Tip:</b> close your thumb and little finger together, measure around the widest part of your hand,
                  then compare with the inner diameter.</li>
              </ul>
            </div>

            <div class="tabs" data-tab="3">
              <ul class="size-tips">
                <li><b>Adjustable rings</b> fit most finger sizes. Gently open or close the band to fit.</li>
                <li><b>Fixed size:</b> wrap a thin strip of paper around your finger, mark where it meets, and measure the
                  length in mm.</li>
                <li>Measure at the end of the day, when fingers are at their largest.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- ================= HOME (hidden) ================= -->
        <div class="sg-var for-home" style="display: none">
          <ul class="tab-nav">
            <li class="active" data-tab="1">Bedsheets</li>
            <li data-tab="2">Cushion Covers</li>
          </ul>

          <div class="tab-nav-content">
            <div class="tabs active" data-tab="1">
              <div class="size-table-wrap">
                <table class="size-table">
                  <thead>
                    <tr>
                      <th>Size</th>
                      <th>Sheet (in)</th>
                      <th>Pillow Cover (in)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Single</td>
                      <td>60 × 90</td>
                      <td>17 × 27</td>
                    </tr>
                    <tr>
                      <td>Double</td>
                      <td>90 × 100</td>
                      <td>17 × 27</td>
                    </tr>
                    <tr>
                      <td>King</td>
                      <td>108 × 108</td>
                      <td>17 × 27</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li><b>Tip:</b> measure your mattress length, width and depth, then add the tuck-in allowance.</li>
                <li>Cotton can shrink slightly after the first wash.</li>
              </ul>
            </div>

            <div class="tabs" data-tab="2">
              <div class="size-table-wrap">
                <table class="size-table">
                  <thead>
                    <tr>
                      <th>Size</th>
                      <th>Cover (in)</th>
                      <th>Best For</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Small</td>
                      <td>12 × 12</td>
                      <td>Accent cushions</td>
                    </tr>
                    <tr>
                      <td>Medium</td>
                      <td>16 × 16</td>
                      <td>Sofa, bed</td>
                    </tr>
                    <tr>
                      <td>Large</td>
                      <td>18 × 18</td>
                      <td>Sofa, floor seating</td>
                    </tr>
                    <tr>
                      <td>X-Large</td>
                      <td>20 × 20</td>
                      <td>Statement cushions</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li>Choose a cover the same size as the insert for a fuller look.</li>
              </ul>
            </div>
          </div>
        </div>

        <a href="javascript:void(0)" class="sg-help"><i class="fa-brands fa-whatsapp"></i> Need Help? Chat with Us</a>
      </div>
    </div>
  </div>
@endpush

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
  <script>
    $(function () {
      var pad = function (n) {
        return ("0" + n).slice(-2);
      };

      var main = new Swiper(".detailMain", {
        speed: 600,
        navigation: { nextEl: ".g-next", prevEl: ".g-prev" },
        pagination: {
          el: ".gallery-counter",
          type: "fraction",
          formatFractionCurrent: pad,
          formatFractionTotal: pad,
        },
      });
      main.on("slideChange", function () {
        $(".thumb-list button").removeClass("active").eq(main.activeIndex).addClass("active");
      });
      $(".thumb-list button").on("click", function () {
        main.slideTo($(this).index());
      });

      // every option card (swatch / size / chip) updates its label
      $(".opt-card .opt-swatch input, .opt-card .opt-size input").on("change", function () {
        var name = $(this).data("name") || $(this).next().text();
        $(this).closest(".opt-card").find(".opt-value").text(name);
      });

      $(document).on("click", ".qty-plus, .qty-minus", function () {
        var v = parseInt($(this).siblings(".qty-input").val(), 10) || 1;
        v = $(this).hasClass("qty-plus") ? Math.min(10, v + 1) : Math.max(1, v - 1);
        $(".qty-input").val(v);
      });

      var bar = document.querySelector(".detail-sticky");
      var target = document.querySelector(".info-actions");
      if (bar && target) {
        new IntersectionObserver(function (e) {
          bar.classList.toggle("show", !e[0].isIntersecting && e[0].boundingClientRect.top < 0);
        }).observe(target);
      }

      GLightbox({ selector: ".glightbox", touchNavigation: true, loop: true });
    });
  </script>
  <script>
    (function () {
      var form = document.querySelector(".review-form");
      if (!form) return;

      var msg = form.querySelector(".rf-msg");
      var btn = form.querySelector('button[type="submit"]');
      var photos = document.getElementById("rvPhotos");

      function say(text, ok) {
        msg.textContent = text;
        msg.style.color = ok ? "#1f8a5b" : "#c0392b";
        msg.hidden = false;
      }

      // same limits as the server: 5 photos, 5MB each
      if (photos) {
        photos.addEventListener("change", function () {
          var files = Array.prototype.slice.call(photos.files);
          if (files.length > 5 || files.some(function (f) { return f.size > 5 * 1024 * 1024; })) {
            photos.value = "";
            say("Please choose up to 5 photos, each under 5MB.", false);
          } else {
            msg.hidden = true;
          }
        });
      }

      form.addEventListener("submit", function (e) {
        e.preventDefault();
        btn.disabled = true;
        say("Submitting your review...", true);

        fetch(form.action, {
          method: "POST",
          body: new FormData(form),
          credentials: "same-origin",
          headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
        })
          .then(function (r) {
            return r.json().then(
              function (d) { return { status: r.status, ok: r.ok, d: d }; },
              function () { return { status: r.status, ok: false, d: {} }; }
            );
          })
          .then(function (res) {
            if (res.ok && res.d.status) {
              say(res.d.message, true);
              form.reset();
              setTimeout(function () {
                var close = document.querySelector(".review-pop .close");
                if (close) close.click();
                msg.hidden = true;
              }, 2500);
            } else if (res.status === 422 && res.d.errors) {
              say(Object.values(res.d.errors)[0][0], false);
            } else if (res.status === 401 || res.status === 419) {
              say("Your session expired. Please log in again and retry.", false);
            } else {
              say(res.d.message || "Something went wrong. Please try again.", false);
            }
          })
          .catch(function () { say("Network error. Please try again.", false); })
          .then(function () { btn.disabled = false; });
      });
    })();
  </script>
@endpush