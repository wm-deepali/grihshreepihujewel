@extends('layouts.app')

@section('title', 'Category Listing | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@php
  // replace with DB later. badge = [css class, fa icon, label]
  $products = [
    'SKU-P1' => ['id' => 'SKU-P1', 'name' => 'Kundan Choker Necklace', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.9', 'sub' => 'Handcrafted kundan with pearl drops', 'price' => '₹1,899', 'old' => '₹2,599', 'save' => '27%', 'badge' => ['top', 'fa-star', 'Top Rated']],
    'SKU-P2' => ['id' => 'SKU-P2', 'name' => 'Pearl Drop Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Lightweight, for daily and festive wear', 'price' => '₹749', 'old' => '₹999', 'save' => '25%', 'badge' => ['best', 'fa-crown', 'Best Seller']],
    'SKU-P3' => ['id' => 'SKU-P3', 'name' => 'Meenakari Bangle Set', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Set of 6 with colourful meenakari work', 'price' => '₹1,299', 'old' => '₹1,799', 'save' => '28%', 'badge' => ['trend', 'fa-fire', 'Trending']],
    'SKU-P4' => ['id' => 'SKU-P4', 'name' => 'Temple Jewellery Ring Set', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.6', 'sub' => 'Set of 5 adjustable temple rings', 'price' => '₹999', 'old' => '₹1,399', 'save' => '29%', 'badge' => ['best', 'fa-crown', 'Best Seller']],
    'SKU-P5' => ['id' => 'SKU-P5', 'name' => 'Polki Choker Necklace Set', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Choker with matching earrings', 'price' => '₹2,299', 'old' => '₹3,199', 'save' => '28%', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P6' => ['id' => 'SKU-P6', 'name' => 'Gold Plated Jhumka Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.7', 'sub' => 'Classic jhumka with pearl finish', 'price' => '₹849', 'old' => '₹1,199', 'save' => '29%', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P7' => ['id' => 'SKU-P7', 'name' => 'Layered Kundan Necklace', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.9', 'sub' => 'Two-layer kundan for festive looks', 'price' => '₹1,599', 'old' => '₹2,199', 'save' => '27%', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P8' => ['id' => 'SKU-P8', 'name' => 'Pearl Chandbali Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Statement chandbali with pearl drops', 'price' => '₹999', 'old' => '₹1,399', 'save' => '29%', 'badge' => ['new', 'fa-sparkles', 'New']],
  ];

  $gridIds   = ['SKU-P1', 'SKU-P2', 'SKU-P3', 'SKU-P4', 'SKU-P5', 'SKU-P6', 'SKU-P7', 'SKU-P8'];
  $recentIds = ['SKU-P1', 'SKU-P2', 'SKU-P3', 'SKU-P4', 'SKU-P5'];
  $bestIds   = ['SKU-P2', 'SKU-P4', 'SKU-P1', 'SKU-P3', 'SKU-P7'];

  $tabs = ['All Jewellery', 'Necklaces', 'Earrings', 'Bangles & Bracelets', 'Rings', 'Jewellery Sets'];

  $sortOptions = [['recommended', 'Recommended'], ['newest', 'New Arrivals'], ['sold', 'Best Selling'], ['low', 'Price: Low to High'], ['high', 'Price: High to Low']];

  // filter groups: [title, input name, open, [[value, label]]]
  $filterSets = [
    'jewellery' => [
      ['Product Type', 'JewelType', true, [['necklace-set', 'Necklace Set'], ['earrings', 'Earrings'], ['maang-tikka', 'Maang Tikka'], ['bangles', 'Bangles & Bracelets'], ['rings', 'Rings'], ['pendant', 'Pendants & Chains']]],
      ['Occasion', 'JewelOccasion', false, [['wedding', 'Wedding'], ['bridal', 'Bridal Function'], ['reception', 'Reception'], ['festive', 'Festive'], ['party', 'Party'], ['family', 'Family Function']]],
      ['Colour / Finish', 'JewelFinish', false, [['antique-gold', 'Antique Gold-tone'], ['gold', 'Gold-tone'], ['silver', 'Silver-tone'], ['rose-gold', 'Rose Gold-tone'], ['oxidised', 'Oxidised']]],
      ['Stone Work', 'StoneWork', false, [['kundan', 'Kundan'], ['crystal', 'Crystal'], ['american-diamond', 'American Diamond'], ['pearl', 'Pearl'], ['meenakari', 'Meenakari']]],
      ['Stone Colour', 'StoneColour', false, [['white', 'Crystal White'], ['ruby', 'Ruby Pink'], ['emerald', 'Emerald Green'], ['multi', 'Multicolour']]],
      ['Style', 'JewelStyle', false, [['ethnic', 'Ethnic'], ['royal', 'Royal'], ['modern', 'Modern'], ['glamorous', 'Glamorous'], ['festive', 'Festive']]],
      ['Set Includes', 'SetIncludes', false, [['earrings', 'Matching Earrings'], ['maang-tikka', 'Maang Tikka']]],
      ['Price', 'JewelPrice', false, [['0-1500', 'Under ₹1,500'], ['1500-3000', '₹1,500 – ₹3,000'], ['3000-5000', '₹3,000 – ₹5,000'], ['5000-10000', '₹5,000 – ₹10,000'], ['10000+', 'Above ₹10,000']]],
    ],
    'home' => [
      ['Product Type', 'HomeType', true, [['bed-sheet', 'Bed Sheets'], ['cushion-cover', 'Cushion Covers'], ['curtain', 'Curtains'], ['table-linen', 'Table Linen'], ['home-decor', 'Home Decor']]],
      ['Fabric', 'HomeFabric', false, [['cotton', 'Cotton'], ['linen', 'Linen'], ['velvet', 'Velvet'], ['polyester', 'Polyester']]],
      ['Colour', 'HomeColour', false, [['white', 'White'], ['beige', 'Beige'], ['maroon', 'Maroon'], ['blue', 'Blue'], ['green', 'Green']]],
      ['Size', 'HomeSize', false, [['single', 'Single'], ['double', 'Double'], ['queen', 'Queen'], ['king', 'King']]],
      ['Pattern', 'HomePattern', false, [['solid', 'Solid'], ['floral', 'Floral'], ['geometric', 'Geometric'], ['ethnic', 'Ethnic Print']]],
      ['Inclusions', 'HomeInclusion', false, [['pillow-covers', 'With Pillow Covers'], ['comforter', 'With Comforter']]],
      ['Price', 'HomePrice', false, [['0-1000', 'Under ₹1,000'], ['1000-2500', '₹1,000 – ₹2,500'], ['2500-5000', '₹2,500 – ₹5,000'], ['5000+', 'Above ₹5,000']]],
    ],
  ];

  $infoItems = [
    ['fa-wand-magic-sparkles', 'Thoughtfully Curated', 'Collections selected with care for your home and personal style.'],
    ['fa-shield-halved', 'Secure Shopping', 'A secure checkout experience for added peace of mind.'],
    ['fa-truck-fast', 'Convenient Delivery', 'Order delivery with clear shipping information and tracking.'],
    ['fa-headset', 'Dedicated Support', "We're here to help with your shopping queries and orders."],
  ];
@endphp

@section('content')
  {{-- ===================== PRODUCT BANNER ===================== --}}
  <section class="product-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">Jewellery</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Pihu Jewel</span>
          <h1 class="banner-title">Jewellery</h1>
          <p class="banner-desc">Beautiful jewellery and accessories for everyday expression and special occasions.</p>
          <div class="banner-btns">
            <a href="#listing" class="btn btn-primary">Shop All Styles</a>
            <a href="#best-sellers" class="btn btn-outline-black">Best Sellers</a>
          </div>
        </div>

        <div class="banner-collage">
          <figure class="col-item col-big">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" />
            <figcaption class="img-tag">
              <span class="tag-gem"></span>
              <span class="tag-text"><b>Pihu Jewel</b><small>Elegance in Every Detail</small></span>
            </figcaption>
          </figure>
          <figure class="col-item"><img src="{{ asset('assets/images/home/pro2.png') }}" alt="Kundan Choker Necklace" /></figure>
          <figure class="col-item"><img src="{{ asset('assets/images/home/pro4.png') }}" alt="Pearl Drop Earrings" /></figure>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== LISTING (TABS + GRID) ===================== --}}
  <section class="product-secB" id="listing">
    <div class="container">
      <ul class="tab-nav">
        @foreach($tabs as $i => $label)
          <li data-tab="{{ $i + 1 }}" class="{{ $i === 0 ? 'active' : '' }}">{{ $label }}</li>
        @endforeach
      </ul>

      <div class="tab-nav-content">
        <div class="tabs active" data-tab="1">
          <div class="prod-toolbar">
            <p class="prod-count"><b>{{ count($gridIds) }}</b> Styles</p>
            <div class="prod-tools">
              <button type="button" class="tool-btn filter-btn" data-model=".filter-pop"><i class="fa-solid fa-sliders"></i> Filter</button>
              <button type="button" class="tool-btn sort-btn" data-model=".sort-pop"><i class="fa-solid fa-arrow-down-wide-short"></i> Sort</button>
              <div class="prod-sort">
                <label for="prodSort1">Sort By</label>
                <div class="sort-box">
                  <select id="prodSort1">
                    <option value="recommended">Recommended</option>
                    <option value="newest">New Arrivals</option>
                    <option value="sold">Best Selling</option>
                    <option value="low">Price: Low to High</option>
                    <option value="high">Price: High to Low</option>
                    <option value="rating">Customer Rating</option>
                  </select>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="prod-grid">
            @foreach($gridIds as $id)
              @include('partials.product-card', ['p' => $products[$id]])
            @endforeach
          </div>

          {{-- Load more: enable when backend pagination is ready
          <div class="load-more">
            <button type="button" class="btn btn-outline-black">Load More Styles</button>
            <p>Showing 8 of 8 styles</p>
          </div>
          --}}
        </div>

        @for($t = 2; $t <= count($tabs); $t++)
          <div class="tabs" data-tab="{{ $t }}"></div>
        @endfor
      </div>
    </div>
  </section>

  {{-- ===================== RECENTLY VIEWED ===================== --}}
  <section class="product-secD">
    <div class="container">
      <div class="heading">
        <span>Recently Viewed</span>
        <h3>A Second Look at <span>Your Favourites.</span></h3>
        <p>Take another look at the styles you loved and find the perfect addition to your collection.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            @foreach($recentIds as $id)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $products[$id], 'showBadge' => false])
              </div>
            @endforeach
          </div>
        </div>
        <div class="swiper-group">
          <button type="button" class="TestimonialSlider-prev btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
          <button type="button" class="TestimonialSlider-next btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== LEFT IMAGE + RIGHT CONTENT ===================== --}}
  <section class="product-secC">
    <div class="container">
      <div class="info-wrap">
        <div class="info-media">
          <figure class="info-main"><img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Celebrate every moment beautifully" loading="lazy" /></figure>
          <figure class="info-sub"><img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" loading="lazy" /></figure>
          <span class="info-tag">Pihu Jewel &middot; Jewellery</span>
        </div>

        <div class="info-right">
          <div class="heading">
            <span>The Difference Is in the Details</span>
            <h3>A Shopping Experience <span>Made with Care</span></h3>
            <p>Thoughtful collections, easy discovery and dedicated support come together to make every shopping experience feel special.</p>
          </div>

          <ul class="info-grid">
            @foreach($infoItems as [$icon, $title, $text])
              <li class="info_item">
                <span class="item-icon"><i class="fa-solid {{ $icon }}"></i></span>
                <div class="item-txt"><h4>{{ $title }}</h4><p>{{ $text }}</p></div>
              </li>
            @endforeach
          </ul>

          <div class="info-btn"><a href="#listing" class="btn btn-primary">Explore Jewellery</a></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== BEST SELLERS ===================== --}}
  <section class="product-secE" id="best-sellers">
    <div class="container">
      <div class="heading">
        <span>Our Best Sellers</span>
        <h3>Most Loved. <span>Best Selling.</span></h3>
        <p>Discover the customer favourites everyone loves, from timeless designs to must-have picks.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            @foreach($bestIds as $id)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $products[$id]])
              </div>
            @endforeach
          </div>
        </div>
        <div class="swiper-group">
          <button type="button" class="TestimonialSlider-prev btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
          <button type="button" class="TestimonialSlider-next btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
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
            <p>Sign up to discover new arrivals, special collections, festive inspiration and exclusive updates from Grih Shree &amp; Pihu Jewel.</p>
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
        <div class="news-img"><img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Grih Shree and Pihu Jewel" loading="lazy" /></div>
      </div>
    </div>
  </section>

  {{-- ===================== FILTER POP ===================== --}}
  <div class="model filter-pop">
    <button type="button" class="close" aria-label="Close filter">
      <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg>
    </button>
    <div class="model-body">
      <div class="title"><h4>Filter By</h4></div>

      @foreach($filterSets as $setKey => $groups)
        {{-- the home set is hidden on the jewellery page --}}
        <div class="f-groups" data-filter-for="{{ $setKey }}" @if($setKey === 'home') style="display: none" @endif>
          @foreach($groups as [$title, $name, $open, $items])
            <details class="f-group" {{ $open ? 'open' : '' }}>
              <summary>{{ $title }} <i class="fa-solid fa-chevron-down"></i></summary>
              <ul class="f-list">
                @foreach($items as [$value, $label])
                  <li><label><input type="checkbox" name="{{ $name }}" value="{{ $value }}" /> {{ $label }}</label></li>
                @endforeach
              </ul>
            </details>
          @endforeach
        </div>
      @endforeach

      <div class="f-foot">
        <button type="button" class="btn btn-outline-primary">Clear All</button>
        <button type="button" class="btn btn-primary">Apply Filters</button>
      </div>
    </div>
  </div>

  {{-- ===================== SORT POP ===================== --}}
  <div class="model sort-pop">
    <button type="button" class="close" aria-label="Close sort">
      <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg>
    </button>
    <div class="model-body">
      <div class="title"><h4>Sort By</h4></div>
      <ul class="sort-list">
        @foreach($sortOptions as [$value, $label])
          <li><label><input type="radio" name="SortBy" value="{{ $value }}" {{ $loop->first ? 'checked' : '' }} /> {{ $label }}</label></li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection