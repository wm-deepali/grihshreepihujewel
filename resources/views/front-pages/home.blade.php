@extends('layouts.app')

@section('title', 'Home | Grih Shree & Pihu Jewel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/home/home.css') }}" />
@endpush

@section('content')
@php
    // =====================================================
    // STATIC DATA (replace with DB queries section by section)
    // =====================================================

    // ---- Shop by Collection (secB) ----
    $collections = [
        ['cat1.png', 'Handloom & Bedding', 'Grih Shree', 'Comfort begins with beautiful details.'],
        ['cat2.png', 'Earrings', 'Pihu Jewel', 'Find your perfect finishing touch.'],
        ['cat3.png', 'Home Decor', 'Grih Shree', 'Little details that make a space yours.'],
        ['cat4.png', 'Necklaces', 'Pihu Jewel', 'Pieces that make every look memorable.'],
        ['cat5.png', 'Festive Collection', 'Grih Shree', 'Celebrate every occasion beautifully.'],
        ['cat2.png', 'Bangles & Bracelets', 'Pihu Jewel', 'Beautiful details for every occasion.'],
        ['cat1.png', 'Gifts & Hampers', 'Grih Shree', 'Thoughtful gifts for meaningful moments.'],
        ['cat4.png', 'Rings', 'Pihu Jewel', 'Small details, lasting impressions.'],
        ['cat3.png', 'Home Essentials', 'Grih Shree', 'Everyday essentials, thoughtfully chosen.'],
        ['cat2.png', 'Traditional Accessories', 'Pihu Jewel', 'Celebrate timeless Indian elegance.'],
        ['cat5.png', 'Handcrafted Collection', 'Grih Shree', 'The charm of art made by hand.'],
        ['cat4.png', 'Jewellery Sets', 'Pihu Jewel', 'Complete your look with coordinated elegance.'],
    ];
    $collections = array_map(fn ($c) => ['img' => $c[0], 'name' => $c[1], 'brand' => $c[2], 'text' => $c[3]], $collections);

    $collTabs = [
        $collections,
        array_filter($collections, fn ($c) => $c['brand'] === 'Grih Shree'),
        array_filter($collections, fn ($c) => $c['brand'] === 'Pihu Jewel'),
    ];

    // ---- Products (G = Grih Shree, P = Pihu Jewel) ----
    $products = [
        'G1' => ['pro1.png', 'Handloom Cotton Bedsheet Set', 'Grih Shree', '4.8', 'Pure cotton, double bed with 2 pillow covers', '₹2,499', '₹3,299', 'Save 24%'],
        'P1' => ['pro2.png', 'Kundan Choker Necklace', 'Pihu Jewel', '4.9', 'Handcrafted kundan with pearl drops', '₹1,899', '₹2,599', 'Save 27%'],
        'G2' => ['pro3.png', 'Brass Diya Gift Set', 'Grih Shree', '4.7', 'Set of 4 hand-finished brass diyas', '₹899', '₹1,199', 'Save 25%'],
        'P2' => ['pro4.png', 'Pearl Drop Earrings', 'Pihu Jewel', '4.8', 'Lightweight, for daily and festive wear', '₹749', '₹999', 'Save 25%'],
        'G3' => ['pro1.png', 'Jaipuri Cotton Quilt', 'Grih Shree', '4.9', 'Soft Jaipuri print, light and warm', '₹3,199', '₹3,999', 'Save 20%'],
        'P3' => ['pro4.png', 'Meenakari Bangle Set', 'Pihu Jewel', '4.8', 'Set of 6 with colourful meenakari work', '₹1,299', '₹1,799', 'Save 28%'],
        'G4' => ['pro3.png', 'Hand-Painted Ceramic Planter', 'Grih Shree', '4.7', 'Hand-painted, ideal for indoor plants', '₹1,099', '₹1,499', 'Save 27%'],
        'P4' => ['pro2.png', 'Temple Jewellery Ring Set', 'Pihu Jewel', '4.6', 'Set of 5 adjustable temple rings', '₹999', '₹1,399', 'Save 29%'],
        'G5' => ['pro1.png', 'Block Print Cotton Dohar', 'Grih Shree', '4.7', 'Hand block printed, soft and breathable', '₹1,799', '₹2,399', 'Save 25%'],
        'P5' => ['pro2.png', 'Polki Choker Necklace Set', 'Pihu Jewel', '4.8', 'Choker with matching earrings', '₹2,299', '₹3,199', 'Save 28%'],
        'G6' => ['pro3.png', 'Brass Tealight Diya Set', 'Grih Shree', '4.6', 'Set of 4 for festive tables', '₹649', '₹899', 'Save 28%'],
        'P6' => ['pro4.png', 'Gold Plated Jhumka Earrings', 'Pihu Jewel', '4.7', 'Classic jhumka with pearl finish', '₹849', '₹1,199', 'Save 29%'],
        'G7' => ['pro1.png', 'Embroidered Cushion Cover Set', 'Grih Shree', '4.8', 'Set of 5 with fine thread work', '₹1,199', '₹1,599', 'Save 25%'],
        'G8' => ['pro3.png', 'Handcrafted Brass Urli Decor', 'Grih Shree', '4.7', 'For floating flowers and candles', '₹1,499', '₹1,999', 'Save 25%'],
        'P7' => ['pro2.png', 'Layered Kundan Necklace', 'Pihu Jewel', '4.9', 'Two-layer kundan for festive looks', '₹1,599', '₹2,199', 'Save 27%'],
        'P8' => ['pro4.png', 'Pearl Chandbali Earrings', 'Pihu Jewel', '4.8', 'Statement chandbali with pearl drops', '₹999', '₹1,399', 'Save 29%'],
    ];
    $products = array_map(fn ($sku, $p) => [
        'sku' => 'SKU-' . $sku, 'img' => $p[0], 'name' => $p[1], 'brand' => $p[2],
        'rate' => $p[3], 'sub' => $p[4], 'now' => $p[5], 'old' => $p[6], 'save' => $p[7],
    ], array_keys($products), $products);
    $products = array_column($products, null, 'sku');
    $prod = fn ($key) => $products['SKU-' . $key];

    // ---- Best sellers (secC): [product key, badge] ----
    $bestSellers = [['G1', 'best'], ['P1', 'top'], ['G2', 'trend'], ['P2', 'best'], ['G3', 'top'], ['P3', 'trend'], ['G4', 'hand'], ['P4', 'best']];
    $bestTabs = [
        $bestSellers,
        array_filter($bestSellers, fn ($b) => str_starts_with($b[0], 'G')),
        array_filter($bestSellers, fn ($b) => str_starts_with($b[0], 'P')),
    ];

    // ---- New arrivals (secE) ----
    $newTabs = [
        ['G5', 'P5', 'G6', 'P6'],
        ['G5', 'G6', 'G7', 'G8'],
        ['P5', 'P6', 'P7', 'P8'],
    ];

    // ---- Recently viewed (secI) ----
    $recentlyViewed = ['G1', 'P1', 'G2', 'P2', 'G3', 'P3'];

    // ---- Price coins (secH): [img, alt, small, strong, title, text, premium?] ----
    $priceCoins = [
        ['cat2.png', 'Gifts under 299', 'Under', '₹299', 'Tiny Delights', 'Small gifts and everyday charms', false],
        ['pro4.png', 'Earrings under 499', 'Under', '₹499', 'Little Treasures', 'Earrings, diyas and accessories', false],
        ['cat3.png', 'Decor under 799', 'Under', '₹799', 'Everyday Finds', 'Home decor and festive accents', false],
        ['cat4.png', 'Necklaces under 999', 'Under', '₹999', 'Beautiful Finds', 'Necklaces, bangles and more', false],
        ['pro1.png', 'Bedding under 1499', 'Under', '₹1,499', 'Thoughtful Picks', 'Cotton bedding and cushion sets', false],
        ['cat5.png', 'Gifts under 1999', 'Under', '₹1,999', 'Gifting Favourites', 'Hampers and handcrafted sets', false],
        ['cat1.png', 'Premium picks under 2999', 'Under', '₹2,999', 'Premium Picks', 'Quilts, chokers and statement sets', false],
        ['pro2.png', 'Premium collection', 'Explore', 'Premium', 'The Finest Selection', 'Our most loved luxury pieces', true],
    ];

    // ---- Occasions (secG): [img, alt/title, cta] ----
    $occasions = [
        ['cat5.png', 'Festive Celebrations', 'Explore Festive Picks'],
        ['pro2.png', 'Wedding & Celebrations', 'Explore Collection'],
        ['pro3.png', 'Gifts & Hampers', 'Find a Special Gift'],
        ['pro1.png', 'Everyday Living', 'Explore Home Essentials'],
    ];

    // ---- Handcrafted (secK): [icon, title, text] ----
    $crafts = [
        ['fa-hand-holding-heart', 'Crochet Creations', 'Hand-worked, stitch by stitch.'],
        ['fa-house', 'Handmade Décor', 'Details with real character.'],
        ['fa-palette', 'Resin Art', 'One-of-a-kind patterns.'],
        ['fa-gem', 'Handcrafted Accessories', 'Unique touches for gifting.'],
    ];

    // ---- Why us (secL): [icon, title, text] ----
    $whyCards = [
        ['fa-wand-magic-sparkles', 'Thoughtfully Curated', 'Collections selected with care for your home and personal style.'],
        ['fa-shield-halved', 'Secure Shopping', 'A secure checkout experience for added peace of mind.'],
        ['fa-truck-fast', 'Convenient Delivery', 'Order delivery with clear shipping information and tracking.'],
        ['fa-headset', 'Dedicated Support', "We're here to help with your shopping queries and orders."],
    ];

    // ---- Reviews (secM): [stars, title, text, name, product] ----
    $reviews = [
        [5, 'Soft from the very first wash', "The cotton feels lovely and the print looks even better in person than in the photos. We've washed it a few times now and the colours are still fresh. It has made our bedroom feel so much warmer.", 'Sneha Verma', 'Handloom Cotton Bedsheet Set'],
        [5, "Perfect for my sister's wedding", 'I wore the kundan choker with a simple silk saree and got so many compliments. The pearl drops sit beautifully and it is lighter than I expected, so I was comfortable all evening.', 'Ananya Singh', 'Kundan Choker Necklace'],
        [4, 'A lovely gift for Diwali', 'Ordered the brass diya set for my parents and they loved the finish. The packaging was neat and it looked great on the puja shelf. Would have liked one more diya in the set, but the quality is really good.', 'Rohit Mishra', 'Brass Diya Gift Set'],
        [5, 'My everyday favourite earrings', "Very light and easy to wear all day, even with office outfits. The pearl finish looks elegant without being too heavy. I've already ordered a second pair for my mother.", 'Priya Gupta', 'Pearl Drop Earrings'],
    ];

    // ---- Instagram (secN) ----
    $instaBlocks = [
        [
            'url' => 'https://www.instagram.com/grihshreestudio/',
            'title' => 'Grih Shree Studio',
            'handle' => '@grihshreestudio',
            'label' => 'Grih Shree Studio',
            'tiles' => [
                ['cat1.png', 'Grih Shree Studio handloom and bedding'],
                ['cat3.png', 'Grih Shree Studio home decor'],
                ['cat5.png', 'Grih Shree Studio handcrafted collection'],
                ['banner2.jpg', 'Grih Shree Studio styling ideas'],
            ],
        ],
        [
            'url' => 'https://www.instagram.com/pihu_jewellery_studio/',
            'title' => 'Pihu Jewellery Studio',
            'handle' => '@pihu_jewellery_studio',
            'label' => 'Pihu Jewellery Studio',
            'tiles' => [
                ['cat4.png', 'Pihu Jewellery Studio necklaces'],
                ['cat2.png', 'Pihu Jewellery Studio earrings'],
                ['pro2.png', 'Pihu Jewellery Studio kundan jewellery'],
                ['jewellery.jpg', 'Pihu Jewellery Studio styling ideas'],
            ],
        ],
    ];
@endphp

{{-- ===================== HERO BANNER ===================== --}}
<section class="home-banner">
  <div class="swiper singleSlider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="{{ asset('assets/images/home/banner.jpg') }}" alt="Beautiful living" />
        </div>
        <div class="container-fluid">
          <div class="hero-grid">
            <div class="slide-content">
              <span class="hero-eyebrow">Grih Shree &amp; Pihu Jewel</span>
              <h1 class="hero-title">Beautiful Living.<br />Timeless Adornment.</h1>
              <p class="hero-desc">
                Discover thoughtfully curated home essentials and beautiful jewellery for everyday moments and
                special occasions.
              </p>
              <div class="hero-btns">
                <a href="{{ url('categories') }}" class="btn btn-white">Shop Home &amp; Living</a>
                <a href="{{ url('categories') }}" class="btn btn-outline-white">Explore Jewellery</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="slide-img">
          <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Home and living" />
          {{-- for video use this instead of img:
          <video src="{{ asset('assets/videos/hero.mp4') }}" autoplay muted loop playsinline></video> --}}
        </div>
        <div class="container-fluid">
          <div class="hero-grid">
            <div class="slide-content">
              <span class="hero-eyebrow">The Art of Beautiful Living</span>
              <h1 class="hero-title">Make Every Corner<br />Feel Like Home.</h1>
              <p class="hero-desc">
                Bring warmth, comfort and character to your spaces with beautiful bedding, handcrafted decor and
                everyday essentials.
              </p>
              <div class="hero-btns">
                <a href="{{ url('categories') }}" class="btn btn-white">Explore Home &amp; Living</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="slider-ui">
      <div class="container-fluid">
        <div class="ui-row">
          <div class="swiper-pagination"></div>
          <div class="hero-nav">
            <button type="button" class="hero-arrow singleSlider-prev" aria-label="Previous">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4l-8 8 8 8" /></svg>
            </button>
            <button type="button" class="hero-arrow singleSlider-next" aria-label="Next">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4l8 8-8 8" /></svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== SHOP BY COLLECTION ===================== --}}
<section class="home-secB">
  <div class="container">
    <div class="heading">
      <span>Curated just for you</span>
      <h3>Shop by <span>Collection</span></h3>
      <p>Discover thoughtfully selected collections for beautiful spaces, meaningful celebrations and effortless personal style.</p>
    </div>

    <ul class="tab-nav">
      @foreach(['All', 'Home & Living', 'Jewellery'] as $label)
        <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $label }}</li>
      @endforeach
    </ul>

    <div class="tab-nav-content">
      @foreach($collTabs as $items)
        <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
          <div class="swiper-wrap">
            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
              <div class="swiper-wrapper">
                @foreach($items as $c)
                  @include('partials.collection-slide', ['c' => $c])
                @endforeach
              </div>
            </div>
            @include('partials.swiper-arrows')
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== BEST SELLERS ===================== --}}
<section class="home-secC">
  <div class="container">
    <div class="heading">
      <span>Our Best Sellers</span>
      <h3>Most Loved. <span>Best Selling.</span></h3>
      <p>Discover the customer favourites everyone loves, from timeless designs to must-have picks.</p>
    </div>

    <ul class="tab-nav">
      @foreach(['All Favourites', 'Home & Living', 'Jewellery'] as $label)
        <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $label }}</li>
      @endforeach
    </ul>

    <div class="tab-nav-content">
      @foreach($bestTabs as $items)
        <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
          <div class="swiper-wrap">
            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
              <div class="swiper-wrapper">
                @foreach($items as [$key, $badge])
                  @include('partials.product-slide', ['p' => $prod($key), 'badge' => $badge])
                @endforeach
              </div>
            </div>
            @include('partials.swiper-arrows')
          </div>
        </div>
      @endforeach
    </div>

    <div class="sec-btn">
      <a href="{{ url('products') }}" class="btn btn-outline-primary">View All Bestsellers</a>
    </div>
  </div>
</section>

{{-- ===================== BRAND PANELS ===================== --}}
<section class="home-secD">
  <div class="container">
    <div class="heading">
      <span>Our World, Our Stories</span>
      <h3>Something Beautiful for <span>Every Moment</span></h3>
      <p>Explore thoughtfully curated home essentials and jewellery, all in one place.</p>
    </div>
  </div>

  <div class="brand-panels">
    <article class="brand_panel">
      <img class="panel-img" src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree bedding, home decor and handcrafted details" loading="lazy" />
      <div class="panel-content">
        <span class="panel-brand">Grih Shree</span>
        <h4 class="panel-title">The Art of Beautiful Living</h4>
        <p class="panel-desc">Bedding, home décor and handcrafted details that make every space feel special.</p>
        <a href="{{ url('categories') }}" class="btn btn-white panel-cta">
          Explore Home &amp; Living
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16M14 6l6 6-6 6" /></svg>
        </a>
      </div>
    </article>

    <article class="brand_panel">
      <img class="panel-img" src="{{ asset('assets/images/home/moments.jpg') }}" alt="Pihu Jewel necklaces and jewellery for every occasion" loading="lazy" />
      <div class="panel-content">
        <span class="panel-brand">Pihu Jewel</span>
        <h4 class="panel-title">Elegance in Every Detail</h4>
        <p class="panel-desc">Beautiful jewellery and accessories for everyday expression and special occasions.</p>
        <a href="{{ url('categories') }}" class="btn btn-white panel-cta">
          Explore Jewellery
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16M14 6l6 6-6 6" /></svg>
        </a>
      </div>
    </article>
  </div>
</section>

{{-- ===================== NEW ARRIVALS ===================== --}}
<section class="home-secE">
  <div class="container">
    <div class="heading">
      <span>Just Arrived</span>
      <h3>Fresh Finds, <span>Beautiful Discoveries</span></h3>
      <p>Explore our latest additions, thoughtfully selected to bring fresh charm to your home and a beautiful touch to your style.</p>
    </div>

    <ul class="tab-nav">
      @foreach(['All New Arrivals', 'Home & Living', 'Jewellery'] as $label)
        <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $label }}</li>
      @endforeach
    </ul>

    <div class="tab-nav-content">
      @foreach($newTabs as $keys)
        <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
          <div class="swiper-wrap">
            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
              <div class="swiper-wrapper">
                @foreach($keys as $key)
                  @include('partials.product-slide', ['p' => $prod($key), 'badge' => 'new'])
                @endforeach
              </div>
            </div>
            @include('partials.swiper-arrows')
          </div>
        </div>
      @endforeach
    </div>

    <div class="sec-btn">
      <a href="{{ url('products') }}" class="btn btn-outline-primary">View All New Arrivals</a>
    </div>
  </div>
</section>

{{-- ===================== OFFERS ===================== --}}
<section class="home-secF">
  <div class="container">
    <div class="heading">
      <span>Special Picks For You</span>
      <h3>A Little Something <span>to Make You Smile</span></h3>
      <p>Discover special offers on thoughtfully selected pieces for your home, celebrations and personal style.</p>
    </div>

    <div class="ticket-grid">
      <div class="offer_ticket">
        <article class="ticket-photo">
          <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree home and living offers" loading="lazy" />
          <div class="ticket-left">
            <span class="ticket-brand">Grih Shree &middot; Home &amp; Living</span>
            <h4 class="ticket-title">Make home feel<br />new again.</h4>
            <a href="{{ url('categories') }}" class="btn btn-white ticket-cta">
              Shop Home Offers
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16M14 6l6 6-6 6" /></svg>
            </a>
          </div>
          <div class="ticket-save">
            <small>Save up to</small>
            <strong>30<sup>%</sup></strong>
          </div>
        </article>

        <div class="coupon_box">
          <span class="coupon-icon"><i class="fa-solid fa-ticket"></i></span>
          <div class="coupon-text">
            <strong>GRIHHOME</strong>
            <p>Special savings on selected home &amp; living pieces.</p>
          </div>
          <button type="button" class="code-copy" data-code="GRIHHOME">Copy Code</button>
        </div>
      </div>

      <div class="offer_ticket">
        <article class="ticket-photo">
          <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery offers" loading="lazy" />
          <div class="ticket-left">
            <span class="ticket-brand">Pihu Jewel &middot; Jewellery</span>
            <h4 class="ticket-title">Wear the<br />moment.</h4>
            <a href="{{ url('categories') }}" class="btn btn-white ticket-cta">
              Shop Jewellery Offers
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16M14 6l6 6-6 6" /></svg>
            </a>
          </div>
          <div class="ticket-save">
            <small>Save up to</small>
            <strong>25<sup>%</sup></strong>
          </div>
        </article>

        <div class="coupon_box">
          <span class="coupon-icon"><i class="fa-solid fa-gift"></i></span>
          <div class="coupon-text">
            <strong>PIHUSPECIAL</strong>
            <p>Special savings on selected jewellery styles.</p>
          </div>
          <button type="button" class="code-copy" data-code="PIHUSPECIAL">Copy Code</button>
        </div>
      </div>
    </div>

    <p class="ticket-note">*Terms &amp; conditions apply. Offers valid on selected products.</p>
  </div>
</section>

{{-- ===================== SHOP BY PRICE ===================== --}}
<section class="home-secH">
  <div class="container">
    <div class="heading">
      <span>Beautiful Finds, Lovely Prices</span>
      <h3>Find Your Favourite <span>at Every Price</span></h3>
      <p>Explore thoughtful picks and beautiful details that fit your budget.</p>
    </div>

    <div class="swiper-wrap">
      <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
        <div class="swiper-wrapper">
          @foreach($priceCoins as [$img, $alt, $small, $strong, $title, $text, $premium])
            <div class="swiper-slide">
              <a href="{{ url('products') }}" class="price_coin {{ $premium ? 'is-premium' : '' }}">
                <figure class="pc-img">
                  <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $alt }}" loading="lazy" />
                  <span class="pc-chip"><small>{{ $small }}</small><strong>{{ $strong }}</strong></span>
                </figure>
                <div class="pc-info">
                  <div class="pc-txt">
                    <h4>{{ $title }}</h4>
                    <p>{{ $text }}</p>
                  </div>
                  <span class="pc-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      @include('partials.swiper-arrows')
    </div>
  </div>
</section>

{{-- ===================== OCCASIONS ===================== --}}
<section class="home-secG">
  <div class="container">
    <div class="occ-wrap">
      <div class="occ-media">
        <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Celebrate every moment beautifully" loading="lazy" />
        <span class="occ-caption">Festive &middot; Wedding &middot; Gifting &middot; Everyday</span>
      </div>

      <div class="occ-right">
        <div class="heading">
          <span>Made for every moment</span>
          <h3>Celebrate Every <br /><span>Moment Beautifully</span></h3>
          <p>From festive home accents to jewellery for special occasions, find thoughtful pieces for life's most beautiful moments.</p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper fourSlider" data-mob="2" data-sm="2" data-lg="3" data-xl="3">
            <div class="swiper-wrapper">
              @foreach($occasions as [$img, $title, $cta])
                <div class="swiper-slide">
                  <a href="{{ url('categories') }}" class="occ_tile">
                    <figure>
                      <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $title }}" loading="lazy" />
                    </figure>
                    <div class="info">
                      <h4>{{ $title }}</h4>
                      <span class="cta">{{ $cta }} <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
          @include('partials.swiper-arrows')
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== RECENTLY VIEWED ===================== --}}
<section class="home-secI">
  <div class="container">
    <div class="heading">
      <span>Recently Viewed</span>
      <h3>A Second Look at <span>Your Favourites.</span></h3>
      <p>Take another look at the styles you loved and find the perfect addition to your collection.</p>
    </div>

    <div class="swiper-wrap">
      <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
        <div class="swiper-wrapper">
          @foreach($recentlyViewed as $key)
            @include('partials.product-slide', ['p' => $prod($key)])
          @endforeach
        </div>
      </div>
      @include('partials.swiper-arrows')
    </div>
  </div>
</section>

{{-- ===================== VIDEO BANNER ===================== --}}
<section class="home-secJ">
  <div class="vid-bg">
    <video src="{{ asset('assets/video/video.mp4') }}" autoplay muted loop playsinline preload="metadata"></video>
  </div>

  <div class="container">
    <div class="vid-content">
      <span class="vid-eyebrow">Crafted for Beautiful Moments</span>
      <h2 class="vid-title">Beautifully Made,<br />Beautifully Worn</h2>
      <p class="vid-desc">
        From thoughtful details that make a house feel like home to jewellery that completes a special moment,
        discover pieces chosen to be part of your everyday and your celebrations.
      </p>
      <div class="vid-btns">
        <a href="{{ url('categories') }}" class="btn btn-white">Shop Home &amp; Living</a>
        <a href="{{ url('categories') }}" class="btn btn-outline-white">Explore Jewellery</a>
      </div>
    </div>
  </div>
</section>

{{-- ===================== HANDCRAFTED ===================== --}}
<section class="home-secK">
  <div class="container">
    <div class="craft-wrap">
      <div class="craft-media">
        <figure class="craft-main">
          <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Handcrafted crochet and handmade décor by Grih Shree" loading="lazy" />
        </figure>
        <figure class="craft-sub">
          <img src="{{ asset('assets/images/home/cat5.png') }}" alt="Handcrafted collection detail" loading="lazy" />
        </figure>
        <span class="craft-tag">Grih Shree &middot; Handcrafted</span>
      </div>

      <div class="craft-right">
        <div class="heading">
          <span>A Touch of Artistry</span>
          <h3>Beautifully Made, <span>Thoughtfully Chosen</span></h3>
          <p>
            Discover the charm of handcrafted details, from crochet creations and handmade décor to unique
            accessories that add character to your everyday spaces.
          </p>
        </div>

        <ul class="craft-grid">
          @foreach($crafts as [$icon, $title, $text])
            <li class="craft_item">
              <span class="item-icon"><i class="fa-solid {{ $icon }}"></i></span>
              <div class="item-txt">
                <h4>{{ $title }}</h4>
                <p>{{ $text }}</p>
              </div>
            </li>
          @endforeach
        </ul>

        <div class="craft-btn">
          <a href="{{ url('categories') }}" class="btn btn-primary">Explore Handcrafted Collection</a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===================== WHY US ===================== --}}
<section class="home-secL">
  <div class="container">
    <div class="heading">
      <span>The Difference Is in the Details</span>
      <h3>A Shopping Experience <span>Made with Care</span></h3>
      <p>Thoughtful collections, easy discovery and dedicated support come together to make every shopping experience feel special.</p>
    </div>

    <div class="swiper-wrap">
      <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="4" data-xl="4">
        <div class="swiper-wrapper">
          @foreach($whyCards as [$icon, $title, $text])
            <div class="swiper-slide">
              <div class="why_card">
                <span class="why-icon"><i class="fa-solid {{ $icon }}"></i></span>
                <h4>{{ $title }}</h4>
                <p>{{ $text }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @include('partials.swiper-arrows')
    </div>
  </div>
</section>

{{-- ===================== REVIEWS ===================== --}}
<section class="home-secM">
  <div class="container">
    <div class="heading">
      <span>Kind Words, Happy Customers</span>
      <h3>Your Love <span>Makes It Special</span></h3>
      <p>Every purchase tells a story. We're grateful to be part of your beautiful moments.</p>
    </div>

    <div class="swiper-wrap">
      <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="3" data-xl="3">
        <div class="swiper-wrapper">
          @foreach($reviews as [$stars, $title, $text, $name, $product])
            <div class="swiper-slide">
              <article class="review_card">
                <div class="rev-stars" aria-label="Rated {{ $stars }} out of 5">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= $stars ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                  @endfor
                </div>
                <h4 class="rev-title">{{ $title }}</h4>
                <p class="rev-text">{{ $text }}</p>
                <div class="rev-user">
                  <span class="rev-avatar">{{ mb_substr($name, 0, 1) }}</span>
                  <div class="rev-meta">
                    <h5>{{ $name }} <i class="fa-solid fa-circle-check" title="Verified purchase"></i></h5>
                    <small>{{ $product }}</small>
                  </div>
                </div>
              </article>
            </div>
          @endforeach
        </div>
      </div>
      @include('partials.swiper-arrows')
    </div>
  </div>
</section>

{{-- ===================== INSTAGRAM ===================== --}}
<section class="home-secN">
  <div class="container">
    <div class="heading">
      <span>Follow Our Journey</span>
      <h3>A Little Inspiration <span>from Our World</span></h3>
      <p>Explore our latest collections, styling ideas and beautiful moments from both our creative worlds.</p>
    </div>

    <div class="insta-grid">
      @foreach($instaBlocks as $block)
        <div class="insta_block">
          <div class="insta-album">
            @foreach($block['tiles'] as [$img, $alt])
              <a href="{{ $block['url'] }}" target="_blank" rel="noopener" class="insta-tile" aria-label="{{ $block['label'] }} on Instagram">
                <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $alt }}" loading="lazy" />
                <span class="tile-over"><i class="fa-brands fa-instagram"></i></span>
              </a>
            @endforeach
          </div>

          <div class="insta-foot">
            <div class="insta-who">
              <span class="insta-icon"><i class="fa-brands fa-instagram"></i></span>
              <div class="insta-name">
                <h4>{{ $block['title'] }}</h4>
                <span>{{ $block['handle'] }}</span>
              </div>
            </div>
            <a href="{{ $block['url'] }}" target="_blank" rel="noopener" class="btn btn-outline-primary insta-btn">Follow on Instagram</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===================== NEWSLETTER ===================== --}}
<section class="home-secO">
  <div class="container">
    <div class="news-card">
      <div class="news-content">
        <div class="heading">
          <span>A Note from Our World</span>
          <h3>Beautiful Things Are Worth Sharing</h3>
          <p>
            Sign up to discover new arrivals, special collections, festive inspiration and exclusive updates from
            Grih Shree &amp; Pihu Jewel.
          </p>
        </div>

        <form class="form news-form" action="#" method="post" novalidate>
          @csrf
          <div class="news-row">
            <div class="form-group news-field">
              <input type="email" id="newsEmail" name="email" placeholder=" " autocomplete="email" required />
              <label for="newsEmail">Enter your email address</label>
            </div>
            <button type="submit" class="btn btn-white news-btn">Subscribe <i class="fa-solid fa-chevron-right"></i></button>
          </div>
        </form>
      </div>

      <div class="news-img">
        <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Grih Shree and Pihu Jewel" loading="lazy" />
      </div>
    </div>
  </div>
</section>
@endsection