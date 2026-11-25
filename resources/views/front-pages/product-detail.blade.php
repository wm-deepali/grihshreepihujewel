@extends('layouts.app')

@php
  // ---------- page data (replace with DB / controller data later) ----------
  $productName = 'Royal Radiance – Premium Bridal Necklace Set';
  $productSku  = 'SKU-P9';

  $gallery = [
    ['pro2.png',       'Royal Radiance Premium Bridal Necklace Set front view'],
    ['pro4.png',       'Royal Radiance matching long earrings'],
    ['jewellery.jpg',  'Royal Radiance bridal styling'],
    ['cat4.png',       'Cascading stone detailing close up'],
    ['cat2.png',       'Matching maang tikka'],
  ];

  $finishes = [
    ['v' => 'antique-gold', 'n' => 'Antique Gold-tone', 'c' => '#b08d3c', 'on' => true],
    ['v' => 'gold',         'n' => 'Gold-tone',         'c' => '#d9b24c'],
    ['v' => 'silver',       'n' => 'Silver-tone',       'c' => '#c8ccd2'],
    ['v' => 'rose-gold',    'n' => 'Rose Gold',         'c' => '#d9a38f'],
    ['v' => 'oxidised',     'n' => 'Oxidised',          'c' => '#6b6b6b', 'off' => true],
  ];

  $stones = [
    ['v' => 'crystal-white', 'n' => 'Crystal White',  'c' => '#f4f8ff', 'on' => true],
    ['v' => 'ruby-pink',     'n' => 'Ruby Pink',      'c' => '#c2185b'],
    ['v' => 'emerald-green', 'n' => 'Emerald Green',  'c' => '#1f8a5b'],
    ['v' => 'sapphire-blue', 'n' => 'Sapphire Blue',  'c' => '#2a4a86'],
    ['v' => 'multi',         'n' => 'Multicolour',    'c' => 'conic-gradient(#c2185b, #1f8a5b, #f4f8ff, #2a4a86, #c2185b)'],
    ['v' => 'pearl-white',   'n' => 'Pearl White',    'c' => '#f3ecd9', 'off' => true],
  ];

  $wearers = [
    ['v' => 'women', 'n' => 'Women',            'on' => true],
    ['v' => 'teens', 'n' => 'Teens'],
    ['v' => 'girls', 'n' => 'Girls (4–12 yrs)', 'off' => true],
  ];

  // backend: render only the group that matches the product's subcategory
  $sizeGroups = [
    ['label' => 'Necklace / Earrings / Sets', 'sq' => false, 'opts' => [
      ['v' => 'free',        'n' => 'Free Size',    't' => 'Free Size',    'on' => true],
      ['v' => 'choker-14',   'n' => 'Choker 14"',   't' => 'Choker 14"'],
      ['v' => 'princess-17', 'n' => 'Princess 17"', 't' => 'Princess 17"'],
      ['v' => 'matinee-20',  'n' => 'Matinee 20"',  't' => 'Matinee 20"',  'off' => true],
    ]],
    ['label' => 'Ring Size (India)', 'sq' => true, 'opts' => [
      ['v' => 'ring-10', 'n' => 'Ring 10', 't' => '10'],
      ['v' => 'ring-12', 'n' => 'Ring 12', 't' => '12'],
      ['v' => 'ring-14', 'n' => 'Ring 14', 't' => '14'],
      ['v' => 'ring-16', 'n' => 'Ring 16', 't' => '16', 'off' => true],
      ['v' => 'ring-18', 'n' => 'Ring 18', 't' => '18'],
    ]],
    ['label' => 'Bangle Size (inch)', 'sq' => true, 'opts' => [
      ['v' => 'bangle-2.2', 'n' => 'Bangle 2.2', 't' => '2.2', 'off' => true],
      ['v' => 'bangle-2.4', 'n' => 'Bangle 2.4', 't' => '2.4'],
      ['v' => 'bangle-2.6', 'n' => 'Bangle 2.6', 't' => '2.6'],
      ['v' => 'bangle-2.8', 'n' => 'Bangle 2.8', 't' => '2.8'],
    ]],
  ];

  // ---------- recently viewed ----------
  $recent = [
    ['img' => 'pro4.png', 'name' => 'Pearl Drop Earrings',          'id' => 'SKU-P2', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Lightweight, for daily and festive wear', 'price' => '₹749',   'old' => '₹999',   'save' => '25%'],
    ['img' => 'pro2.png', 'name' => 'Temple Jewellery Ring Set',    'id' => 'SKU-P4', 'brand' => 'Pihu Jewel', 'rate' => '4.6', 'sub' => 'Set of 5 adjustable temple rings',        'price' => '₹999',   'old' => '₹1,399', 'save' => '29%'],
    ['img' => 'pro4.png', 'name' => 'Gold Plated Jhumka Earrings',  'id' => 'SKU-P6', 'brand' => 'Pihu Jewel', 'rate' => '4.7', 'sub' => 'Classic jhumka with pearl finish',        'price' => '₹849',   'old' => '₹1,199', 'save' => '29%'],
    ['img' => 'pro2.png', 'name' => 'Layered Kundan Necklace',      'id' => 'SKU-P7', 'brand' => 'Pihu Jewel', 'rate' => '4.9', 'sub' => 'Two-layer kundan for festive looks',      'price' => '₹1,599', 'old' => '₹2,199', 'save' => '27%'],
  ];

  // ---------- you may also love ----------
  $related = [
    ['img' => 'pro4.png', 'name' => 'Maharani Elegance – Royal Kundan Chandbali Earrings',        'id' => 'SKU-P10', 'brand' => 'Pihu Jewel', 'badge' => ['new', 'fa-sparkles', 'New'],        'sub' => 'Ruby pink, emerald green and crystal white stones', 'price' => '₹1,400'],
    ['img' => 'pro4.png', 'name' => 'Crystal Glam – Elegant Diamond Look Statement Earrings',     'id' => 'SKU-P11', 'brand' => 'Pihu Jewel', 'badge' => ['new', 'fa-sparkles', 'New'],        'sub' => 'Silver-tone geometric crystal drops',               'price' => '₹1,600'],
    ['img' => 'pro2.png', 'name' => 'Kundan Choker Necklace',                                     'id' => 'SKU-P1',  'brand' => 'Pihu Jewel', 'badge' => ['top', 'fa-star', 'Top Rated'],      'rate' => '4.9', 'sub' => 'Handcrafted kundan with pearl drops',    'price' => '₹1,899', 'old' => '₹2,599', 'save' => '27%'],
    ['img' => 'pro4.png', 'name' => 'Meenakari Bangle Set',                                       'id' => 'SKU-P3',  'brand' => 'Pihu Jewel', 'badge' => ['trend', 'fa-fire', 'Trending'],     'rate' => '4.8', 'sub' => 'Set of 6 with colourful meenakari work', 'price' => '₹1,299', 'old' => '₹1,799', 'save' => '28%'],
    ['img' => 'pro2.png', 'name' => 'Polki Choker Necklace Set',                                  'id' => 'SKU-P5',  'brand' => 'Pihu Jewel', 'badge' => ['new', 'fa-sparkles', 'New'],        'rate' => '4.8', 'sub' => 'Choker with matching earrings',          'price' => '₹2,299', 'old' => '₹3,199', 'save' => '28%'],
  ];

  // ---------- reviews ----------
  $reviews = [
    ['init' => 'PS', 'user' => 'Priya Sharma',   'stars' => 5, 'title' => 'Looked stunning with my bridal lehenga', 'text' => 'The cascading stones catch the light beautifully and the antique gold finish looks so rich. The matching earrings and maang tikka made the whole look complete.', 'for' => 'Royal Radiance Bridal Necklace Set',    'photos' => ['pro2.png', 'jewellery.jpg'], 'date' => 'November 2026', 'helpful' => 9],
    ['init' => 'NV', 'user' => 'Neha Verma',     'stars' => 5, 'title' => 'Light, royal and so easy to wear',       'text' => 'The kundan chandbalis look grand but are surprisingly light. The ruby pink and emerald stones matched my festive saree perfectly.',                          'for' => 'Maharani Elegance Chandbali Earrings', 'photos' => ['pro4.png'],                  'date' => 'November 2026', 'helpful' => 6],
    ['init' => 'AK', 'user' => 'Ayesha Khan',    'stars' => 4, 'title' => 'Sparkles like a premium piece',          'text' => 'Modern, glamorous and very elegant. Delivery took a day longer than expected, but the sparkle made up for it.',                                              'for' => 'Crystal Glam Statement Earrings',      'photos' => [],                            'date' => 'October 2026',  'helpful' => 4],
    ['init' => 'RM', 'user' => 'Ritu Malhotra',  'stars' => 5, 'title' => 'Perfect reception look',                 'text' => 'Wore it with a gown to my reception and got compliments all night. The packaging was neat and gift-ready.',                                                 'for' => 'Royal Radiance Bridal Necklace Set',    'photos' => ['cat4.png', 'cat2.png'],      'date' => 'October 2026',  'helpful' => 8],
  ];
  $reviewTabs = [
    1 => ['items' => $reviews,                                                            'photos' => true],
    2 => ['items' => array_values(array_filter($reviews, fn ($r) => count($r['photos']))), 'photos' => true],
    3 => ['items' => array_values(array_filter($reviews, fn ($r) => $r['stars'] === 5)),   'photos' => false],
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
        <li><a href="{{ url('products') }}">All Products</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li><a href="{{ url('categories') }}">Necklaces</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">{{ $productName }}</li>
      </ul>

      <div class="detail-layout">
        <!-- ============ GALLERY ============ -->
        <div class="detail-gallery">
          <div class="gallery-main">
            <span class="gallery-tag">New</span>
            <div class="swiper detailMain">
              <div class="swiper-wrapper">
                @foreach($gallery as [$gImg, $gAlt])
                  <div class="swiper-slide">
                    <a href="{{ asset('assets/images/home/' . $gImg) }}" class="gallery-img glightbox" data-gallery="product">
                      <img src="{{ asset('assets/images/home/' . $gImg) }}" alt="{{ $gAlt }}"
                        @if($loop->first) fetchpriority="high" @else loading="lazy" @endif />
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
            <button type="button" class="g-prev" aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
            <button type="button" class="g-next" aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
            <span class="gallery-counter">01 / {{ str_pad(count($gallery), 2, '0', STR_PAD_LEFT) }}</span>
          </div>

          <div class="thumb-list">
            @foreach($gallery as [$gImg])
              <button type="button" class="{{ $loop->first ? 'active' : '' }}" aria-label="View image {{ $loop->iteration }}">
                <img src="{{ asset('assets/images/home/' . $gImg) }}" alt="" loading="lazy" />
              </button>
            @endforeach
          </div>

          <ul class="gallery-trust">
            <li><i class="fa-solid fa-truck-fast"></i><span>Ready to Ship</span></li>
            <li><i class="fa-solid fa-shield-halved"></i><span>Secure Payments</span></li>
            <li><i class="fa-solid fa-arrow-right-arrow-left"></i><span>7-Day Returns</span></li>
          </ul>
        </div>

        <!-- ============ INFO ============ -->
        <div class="detail-info">
          <!-- backend: jewellery = "Pihu Jewel · Subcategory" | home = "Grih Shree · Subcategory" -->
          <span class="eyebrow">Pihu Jewel · Necklace Sets</span>
          <h1>{{ $productName }}</h1>

          <div class="info-rate">
            <span class="rate-pill"><i class="fa-solid fa-star"></i> 4.8</span>
            <a href="#reviews" class="rate-count">26 Reviews</a>
            <span class="info-sku">SKU: PJ-NKL-0701</span>
          </div>

          <!-- PRICE (backend: old / off / save only when there is a discount) -->
          <div class="info-price">
            <div class="price-line">
              <span class="price-now">₹7,500</span>
              <span class="price-old">₹9,999</span>
              <span class="price-off">25% OFF</span>
            </div>
            <div class="price-meta">
              <p class="price-save"><i class="fa-solid fa-tags"></i> You save <b>₹2,499</b> on this piece</p>
              <p class="price-tax">Inclusive of all taxes</p>
            </div>
          </div>

          <p class="info-desc">
            An elegant multi-layered statement necklace in an antique gold-tone finish, set with sparkling white
            stones in an intricate cascading pattern of teardrop and geometric detailing. Comes with coordinated
            long earrings and maang tikka.
          </p>

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
                    <input type="radio" name="finish" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}"
                      {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
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
                    <input type="radio" name="stone" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}"
                      {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
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
                  <input type="radio" name="wearer" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}"
                    {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
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
                      <input type="radio" name="jsize" value="{{ $o['v'] }}" data-name="{{ $o['n'] }}"
                        {{ !empty($o['on']) ? 'checked' : '' }} {{ !empty($o['off']) ? 'disabled' : '' }} />
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
              <textarea name="gift_message" rows="2" maxlength="120"
                placeholder="Write your gift message (optional)" aria-label="Gift message"></textarea>
            </div>
          </div>

          <p class="info-stock">
            <i class="fa-solid fa-circle"></i><b>In Stock</b><em>Ready to ship, dispatched within 48 hours</em>
          </p>

          <div class="info-actions">
            <div class="act-top">
              <div class="qty-box">
                <button type="button" class="qty-minus" aria-label="Decrease quantity"><i class="fa-solid fa-minus"></i></button>
                <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
                <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
              </div>
              <button type="button" class="wish-link"><i class="fa-regular fa-heart"></i> Add to Wishlist</button>
            </div>
            <div class="act-btns">
              <button type="button" data-id="{{ $productSku }}" data-name="{{ $productName }}"
                data-toast-title="Added to Cart"
                data-toast-text="{{ $productName }} has been added to your cart."
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
            <div class="offers-head"><h5>Offers &amp; Coupons</h5></div>

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
              <div><b>Statement Finish</b><p>Antique gold-tone with sparkling stones.</p></div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-shirt"></i>
              <div><b>Pairs With</b><p>Lehengas, Sarees, Gowns, Traditional Outfits.</p></div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-truck-fast"></i>
              <div><b>Ready to Ship</b><p>Dispatched within 48 hours.</p></div>
            </div>
            <div class="perk">
              <i class="fa-solid fa-arrow-right-arrow-left"></i>
              <div><b>7-Day Returns</b><p>Easy return and exchange.</p></div>
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
        <img src="{{ asset('assets/images/home/' . $gallery[0][0]) }}" alt="{{ $productName }}" />
        <div class="ds-text">
          <b>{{ $productName }}</b>
          <span><strong>₹7,500</strong><em>25% OFF</em></span>
        </div>
      </div>

      <div class="ds-actions">
        <div class="qty-box">
          <button type="button" class="qty-minus" aria-label="Decrease quantity"><i class="fa-solid fa-minus"></i></button>
          <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
          <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
        </div>
        <button type="button" data-id="{{ $productSku }}" data-name="{{ $productName }}"
          data-toast-title="Added to Cart"
          data-toast-text="{{ $productName }} has been added to your cart."
          data-toast-type="success" class="btn btn-outline-black">Add to Cart</button>
        <a href="{{ url('cart') }}" class="btn btn-primary">Buy Now</a>
      </div>
    </div>
  </section>

  <!-- ===================== SEC E : STILL ON YOUR MIND ===================== -->
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
            @foreach($recent as $p)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $p])
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

  <!-- ===================== SEC C : REVIEWS ===================== -->
  <section class="detail-secC" id="reviews">
    <div class="container">
      <div class="heading">
        <span>Customer Reviews</span>
        <h3>What Our <span>Customers Say</span></h3>
        <p>Honest words from people who love what they bought.</p>
      </div>

      <div class="review-board">
        <div class="rb-score">
          <b>4.8</b>
          <em>out of 5</em>
          <div class="rb-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p>Based on 26 reviews</p>
          <button type="button" class="btn btn-white" data-model=".review-pop">Write a Review</button>
        </div>

        <div class="rb-detail">
          <ul class="rb-bars">
            @foreach([[5, 85, 22], [4, 11, 3], [3, 4, 1], [2, 0, 0], [1, 0, 0]] as [$star, $pct, $cnt])
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

      <div class="review-photos">
        <h5>Customer Photos <span>(12)</span></h5>
        <div class="rp-grid">
          @foreach(['pro2.png', 'pro4.png', 'jewellery.jpg', 'cat4.png', 'cat2.png'] as $img)
            <a href="{{ asset('assets/images/home/' . $img) }}" class="rp-item glightbox" data-gallery="customer-photos">
              <img src="{{ asset('assets/images/home/' . $img) }}" alt="Customer photo {{ $loop->iteration }}" loading="lazy" />
            </a>
          @endforeach
          <a href="{{ asset('assets/images/home/pro2.png') }}" class="rp-item more glightbox" data-gallery="customer-photos">
            <img src="{{ asset('assets/images/home/pro2.png') }}" alt="More customer photos" loading="lazy" /><span>+7</span>
          </a>
        </div>
      </div>

      <div class="review-bar">
        <ul class="tab-nav">
          <li class="active" data-tab="1">All (26)</li>
          <li data-tab="2">With Photos (12)</li>
          <li data-tab="3">5 Star (22)</li>
        </ul>
        <div class="review-sort">
          <select aria-label="Sort reviews">
            <option>Most Recent</option>
            <option>Most Helpful</option>
            <option>Highest Rating</option>
            <option>Lowest Rating</option>
          </select>
        </div>
      </div>

      <div class="tab-nav-content">
        @foreach($reviewTabs as $tabNo => $tab)
          <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $tabNo }}">
            <div class="swiper-wrap">
              <div class="swiper fourSlider" data-mob="1.1" data-sm="2.2" data-lg="3" data-xl="3">
                <div class="swiper-wrapper">
                  @foreach($tab['items'] as $i => $r)
                    <div class="swiper-slide">
                      <div class="rev-card">
                        <i class="fa-solid fa-quote-right rev-quote"></i>
                        <div class="rev-stars">
                          @for($s = 1; $s <= 5; $s++)<i class="fa-{{ $s <= $r['stars'] ? 'solid' : 'regular' }} fa-star"></i>@endfor
                        </div>
                        <h6>{{ $r['title'] }}</h6>
                        <p>{{ $r['text'] }}</p>
                        <span class="rev-for">{{ $r['for'] }}</span>
                        @if($tab['photos'] && count($r['photos']))
                          <div class="rev-photos">
                            @foreach($r['photos'] as $ph)
                              <a href="{{ asset('assets/images/home/' . $ph) }}" class="glightbox" data-gallery="rv-{{ $tabNo }}-{{ $i }}">
                                <img src="{{ asset('assets/images/home/' . $ph) }}" alt="Review photo" loading="lazy" />
                              </a>
                            @endforeach
                          </div>
                        @endif
                        <div class="rev-user">
                          <span class="rev-avatar">{{ $r['init'] }}</span>
                          <div>
                            <h5>{{ $r['user'] }}</h5>
                            <span class="rev-verified"><i class="fa-solid fa-circle-check"></i> Verified Purchase</span>
                          </div>
                        </div>
                        <div class="rev-foot">
                          <span class="rev-date">{{ $r['date'] }}</span>
                          <button type="button" class="rv-helpful">
                            <i class="fa-regular fa-thumbs-up"></i> Helpful ({{ $r['helpful'] }})
                          </button>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="swiper-group">
                <button type="button" class="btn-prev" aria-label="Previous">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7" /></svg>
                </button>
                <button type="button" class="btn-next" aria-label="Next">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7" /></svg>
                </button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ===================== SEC D : YOU MAY ALSO LOVE ===================== -->
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
            @foreach($related as $p)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $p])
              </div>
            @endforeach
          </div>
        </div>

        <div class="swiper-group">
          <button type="button" class="btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
          <button type="button" class="btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>

      <div class="sec-btn">
        <a href="{{ url('categories') }}" class="btn btn-outline-primary">View All Jewellery</a>
      </div>
    </div>
  </section>
@endsection

{{-- Page-only modals. Add @stack('modals') in layouts/app.blade.php just above <div class="overlay"></div> --}}
@push('modals')
  <!-- ===================== REVIEW POP ===================== -->
  <div class="model review-pop">
    <button type="button" class="close" aria-label="Close review">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 5l14 14M19 5L5 19" /></svg>
    </button>
    <div class="model-body">
      <div class="title">
        <h4>Write a Review</h4>
        <p>{{ $productName }}</p>
      </div>
      <form class="form review-form" action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="rf-rate">
          <span>Your Rating</span>
          <div class="rate-input">
            @foreach([5, 4, 3, 2, 1] as $n)
              <input type="radio" name="rating" id="rate{{ $n }}" value="{{ $n }}" />
              <label for="rate{{ $n }}" aria-label="{{ $n }} {{ $n === 1 ? 'star' : 'stars' }}"><i class="fa-solid fa-star"></i></label>
            @endforeach
          </div>
        </div>
        <div class="form-group">
          <input type="text" id="rvTitle" name="title" placeholder=" " required />
          <label for="rvTitle">Review Title</label>
        </div>
        <div class="form-group">
          <textarea id="rvText" name="review" placeholder=" " required></textarea>
          <label for="rvText">Tell us about the finish, sparkle and fit</label>
        </div>
        <div class="rf-row">
          <div class="form-group">
            <input type="text" id="rvName" name="name" placeholder=" " required />
            <label for="rvName">Your Name</label>
          </div>
          <div class="form-group">
            <input type="email" id="rvEmail" name="email" placeholder=" " required />
            <label for="rvEmail">Email Address</label>
          </div>
        </div>
        <div class="rf-upload">
          <label class="upload-box" for="rvPhotos">
            <i class="fa-regular fa-image"></i>
            <b>Add Photos <em>(optional)</em></b>
            <span>Up to 5 photos · JPG or PNG · max 5MB each</span>
            <input type="file" id="rvPhotos" name="photos[]" accept="image/*" multiple />
          </label>
          <div class="upload-preview"></div>
        </div>
        <div class="rf-submit">
          <button type="submit" class="btn btn-primary">Submit Review</button>
          <p>Your email will not be published. Reviews appear after approval.</p>
        </div>
      </form>
    </div>
  </div>

  <!-- ===================== SIZE GUIDE POP ===================== -->
  <div class="model size-pop">
    <button type="button" class="close" aria-label="Close size guide">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 5l14 14M19 5L5 19" /></svg>
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
                  <thead><tr><th>Style</th><th>Length (in)</th><th>Sits At</th></tr></thead>
                  <tbody>
                    <tr><td>Choker</td><td>14 – 16</td><td>Base of the neck</td></tr>
                    <tr><td>Princess</td><td>17 – 19</td><td>Collarbone</td></tr>
                    <tr><td>Matinee</td><td>20 – 24</td><td>Above the bust</td></tr>
                    <tr><td>Long Haar</td><td>28 – 36</td><td>Below the bust</td></tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li><b>Tip:</b> measure around your neck with a soft tape, then add the length you want the necklace to drop.</li>
                <li>Statement bridal sets look best on a deep neckline or an open back.</li>
              </ul>
            </div>

            <div class="tabs" data-tab="2">
              <div class="size-table-wrap">
                <table class="size-table">
                  <thead><tr><th>Size</th><th>Inner Dia (in)</th><th>Inner Dia (cm)</th><th>Wrist</th></tr></thead>
                  <tbody>
                    <tr><td>2.2</td><td>2 1/8</td><td>5.4</td><td>Small</td></tr>
                    <tr><td>2.4</td><td>2 1/4</td><td>5.7</td><td>Small – Medium</td></tr>
                    <tr><td>2.6</td><td>2 3/8</td><td>6.0</td><td>Medium</td></tr>
                    <tr><td>2.8</td><td>2 1/2</td><td>6.4</td><td>Medium – Large</td></tr>
                    <tr><td>2.10</td><td>2 5/8</td><td>6.7</td><td>Large</td></tr>
                  </tbody>
                </table>
              </div>
              <ul class="size-tips">
                <li><b>Tip:</b> close your thumb and little finger together, measure around the widest part of your hand, then compare with the inner diameter.</li>
              </ul>
            </div>

            <div class="tabs" data-tab="3">
              <ul class="size-tips">
                <li><b>Adjustable rings</b> fit most finger sizes. Gently open or close the band to fit.</li>
                <li><b>Fixed size:</b> wrap a thin strip of paper around your finger, mark where it meets, and measure the length in mm.</li>
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
                  <thead><tr><th>Size</th><th>Sheet (in)</th><th>Pillow Cover (in)</th></tr></thead>
                  <tbody>
                    <tr><td>Single</td><td>60 × 90</td><td>17 × 27</td></tr>
                    <tr><td>Double</td><td>90 × 100</td><td>17 × 27</td></tr>
                    <tr><td>King</td><td>108 × 108</td><td>17 × 27</td></tr>
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
                  <thead><tr><th>Size</th><th>Cover (in)</th><th>Best For</th></tr></thead>
                  <tbody>
                    <tr><td>Small</td><td>12 × 12</td><td>Accent cushions</td></tr>
                    <tr><td>Medium</td><td>16 × 16</td><td>Sofa, bed</td></tr>
                    <tr><td>Large</td><td>18 × 18</td><td>Sofa, floor seating</td></tr>
                    <tr><td>X-Large</td><td>20 × 20</td><td>Statement cushions</td></tr>
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
@endpush