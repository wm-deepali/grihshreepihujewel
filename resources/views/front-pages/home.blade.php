@extends('layouts.app')

@section('title', 'Home | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/home/home.css') }}" />
@endpush

@section('content')
  @php


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
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15 4l-8 8 8 8" />
                </svg>
              </button>
              <button type="button" class="hero-arrow singleSlider-next" aria-label="Next">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M9 4l8 8-8 8" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== SHOP BY COLLECTION ===================== --}}
  @if($collTabs->first()['items']->isNotEmpty())
    <section class="home-secB">
      <div class="container">
        <div class="heading">
          <span>Curated just for you</span>
          <h3>Shop by <span>Collection</span></h3>
          <p>Discover thoughtfully selected collections for beautiful spaces, meaningful celebrations and effortless
            personal style.</p>
        </div>

        @if($collTabs->count() > 2)
          <ul class="tab-nav">
            @foreach($collTabs as $tab)
              <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $tab['label'] }}</li>
            @endforeach
          </ul>
        @endif

        <div class="tab-nav-content">
          @foreach($collTabs as $tab)
            @continue($collTabs->count() <= 2 && !$loop->first)
            <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
              <div class="swiper-wrap">
                <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                  <div class="swiper-wrapper">
                    @foreach($tab['items'] as $c)
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
  @endif

  {{-- ===================== BEST SELLERS ===================== --}}
  @if($bestSellerTabs->first()['items']->isNotEmpty())
    <section class="home-secC">
      <div class="container">
        <div class="heading">
          <span>Our Best Sellers</span>
          <h3>Most Loved. <span>Best Selling.</span></h3>
          <p>Discover the customer favourites everyone loves, from timeless designs to must-have picks.</p>
        </div>

        @if($bestSellerTabs->count() > 2)
          <ul class="tab-nav">
            @foreach($bestSellerTabs as $tab)
              <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $tab['label'] }}</li>
            @endforeach
          </ul>
        @endif

        <div class="tab-nav-content">
          @foreach($bestSellerTabs as $tab)
            @continue($bestSellerTabs->count() <= 2 && !$loop->first)
            <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
              <div class="swiper-wrap">
                <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
                  <div class="swiper-wrapper">
                    @foreach($tab['items'] as $p)
                      @include('partials.product-slide', ['p' => $p])
                    @endforeach
                  </div>
                </div>
                @include('partials.swiper-arrows')
              </div>
            </div>
          @endforeach
        </div>

        <div class="sec-btn">
          <a href="{{ route('products') }}" class="btn btn-outline-primary">View All Bestsellers</a>
        </div>
      </div>
    </section>
  @endif

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
        <img class="panel-img" src="{{ asset('assets/images/home/banner2.jpg') }}"
          alt="Grih Shree bedding, home decor and handcrafted details" loading="lazy" />
        <div class="panel-content">
          <span class="panel-brand">Grih Shree</span>
          <h4 class="panel-title">The Art of Beautiful Living</h4>
          <p class="panel-desc">Bedding, home décor and handcrafted details that make every space feel special.</p>
          <a href="{{ url('categories') }}" class="btn btn-white panel-cta">
            Explore Home &amp; Living
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M4 12h16M14 6l6 6-6 6" />
            </svg>
          </a>
        </div>
      </article>

      <article class="brand_panel">
        <img class="panel-img" src="{{ asset('assets/images/home/moments.jpg') }}"
          alt="Pihu Jewel necklaces and jewellery for every occasion" loading="lazy" />
        <div class="panel-content">
          <span class="panel-brand">Pihu Jewel</span>
          <h4 class="panel-title">Elegance in Every Detail</h4>
          <p class="panel-desc">Beautiful jewellery and accessories for everyday expression and special occasions.</p>
          <a href="{{ url('categories') }}" class="btn btn-white panel-cta">
            Explore Jewellery
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M4 12h16M14 6l6 6-6 6" />
            </svg>
          </a>
        </div>
      </article>
    </div>
  </section>

  {{-- ===================== NEW ARRIVALS ===================== --}}
  @if($newArrivalTabs->first()['items']->isNotEmpty())
    <section class="home-secE">
      <div class="container">
        <div class="heading">
          <span>Just Arrived</span>
          <h3>Fresh Finds, <span>Beautiful Discoveries</span></h3>
          <p>Explore our latest additions, thoughtfully selected to bring fresh charm to your home and a beautiful touch to
            your style.</p>
        </div>

        @if($newArrivalTabs->count() > 2)
          <ul class="tab-nav">
            @foreach($newArrivalTabs as $tab)
              <li data-tab="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">{{ $tab['label'] }}</li>
            @endforeach
          </ul>
        @endif

        <div class="tab-nav-content">
          @foreach($newArrivalTabs as $tab)
            @continue($newArrivalTabs->count() <= 2 && !$loop->first)
            <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $loop->iteration }}">
              <div class="swiper-wrap">
                <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
                  <div class="swiper-wrapper">
                    @foreach($tab['items'] as $p)
                      @include('partials.product-slide', ['p' => $p])
                    @endforeach
                  </div>
                </div>
                @include('partials.swiper-arrows')
              </div>
            </div>
          @endforeach
        </div>

        <div class="sec-btn">
          <a href="{{ route('products') }}" class="btn btn-outline-primary">View All New Arrivals</a>
        </div>
      </div>
    </section>
  @endif

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
            <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree home and living offers"
              loading="lazy" />
            <div class="ticket-left">
              <span class="ticket-brand">Grih Shree &middot; Home &amp; Living</span>
              <h4 class="ticket-title">Make home feel<br />new again.</h4>
              <a href="{{ url('categories') }}" class="btn btn-white ticket-cta">
                Shop Home Offers
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M4 12h16M14 6l6 6-6 6" />
                </svg>
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M4 12h16M14 6l6 6-6 6" />
                </svg>
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
  @if($occasionTiles->isNotEmpty())
    <section class="home-secG">
      <div class="container">
        <div class="occ-wrap">
          <div class="occ-media">
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Celebrate every moment beautifully"
              loading="lazy" />
            <span class="occ-caption">{{ $occasionTiles->take(4)->pluck('title')->implode(' · ') }}</span>
          </div>

          <div class="occ-right">
            <div class="heading">
              <span>Made for every moment</span>
              <h3>Celebrate Every <br /><span>Moment Beautifully</span></h3>
              <p>From festive home accents to jewellery for special occasions, find thoughtful pieces for life's most
                beautiful moments.</p>
            </div>

            <div class="swiper-wrap">
              <div class="swiper fourSlider" data-mob="2" data-sm="2" data-lg="3" data-xl="3">
                <div class="swiper-wrapper">
                  @foreach($occasionTiles as $o)
                    <div class="swiper-slide">
                      <a href="{{ $o['url'] }}" class="occ_tile">
                        <figure>
                          <img src="{{ $o['img'] }}" alt="{{ $o['title'] }}" loading="lazy" />
                        </figure>
                        <div class="info">
                          <h4>{{ $o['title'] }}</h4>
                          <span class="cta">Explore Collection <i class="fa-solid fa-arrow-right"></i></span>
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
  @endif

  {{-- ===================== RECENTLY VIEWED ===================== --}}
  @if($recentlyViewed->isNotEmpty())
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
              @foreach($recentlyViewed as $p)
                @include('partials.product-slide', ['p' => $p])
              @endforeach
            </div>
          </div>
          @include('partials.swiper-arrows')
        </div>
      </div>
    </section>
  @endif

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
            <img src="{{ asset('assets/images/home/banner2.jpg') }}"
              alt="Handcrafted crochet and handmade décor by Grih Shree" loading="lazy" />
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
        <p>Thoughtful collections, easy discovery and dedicated support come together to make every shopping experience
          feel special.</p>
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
  @if($homeReviews->isNotEmpty())
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
              @foreach($homeReviews as $r)
                <div class="swiper-slide">
                  <article class="review_card">
                    <div class="rev-stars" aria-label="Rated {{ $r['stars'] }} out of 5">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= $r['stars'] ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                      @endfor
                    </div>
                    @if($r['title'])
                    <h4 class="rev-title">{{ $r['title'] }}</h4>@endif
                    <p class="rev-text">{{ $r['text'] }}</p>
                    <div class="rev-user">
                      <span class="rev-avatar">{{ mb_strtoupper(mb_substr($r['name'], 0, 1)) }}</span>
                      <div class="rev-meta">
                        <h5>{{ $r['name'] }}
                          @if($r['verified'])<i class="fa-solid fa-circle-check" title="Verified purchase"></i>@endif
                        </h5>
                        <small>{{ $r['product'] }}</small>
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
  @endif
  
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
                <a href="{{ $block['url'] }}" target="_blank" rel="noopener" class="insta-tile"
                  aria-label="{{ $block['label'] }} on Instagram">
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
              <a href="{{ $block['url'] }}" target="_blank" rel="noopener" class="btn btn-outline-primary insta-btn">Follow
                on Instagram</a>
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
              <button type="submit" class="btn btn-white news-btn">Subscribe <i
                  class="fa-solid fa-chevron-right"></i></button>
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