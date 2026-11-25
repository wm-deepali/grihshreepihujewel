@extends('layouts.app')

@section('title', ($category->meta_title ?: $category->name) . ' | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@php
  $sortOptions = [['recommended', 'Recommended'], ['newest', 'New Arrivals'], ['sold', 'Best Selling'], ['rating', 'Customer Rating'], ['discount', 'Biggest Discount'], ['low', 'Price: Low to High'], ['high', 'Price: High to Low']];

  $priceRanges = [['0-1000', 'Under ₹1,000'], ['1000-2500', '₹1,000 – ₹2,500'], ['2500-5000', '₹2,500 – ₹5,000'], ['5000-10000', '₹5,000 – ₹10,000'], ['10000+', 'Above ₹10,000']];
  $ratings     = [['4.5', '4.5 & Above'], ['4', '4.0 & Above'], ['3', '3.0 & Above']];
  $discounts   = [['10', '10% & Above'], ['20', '20% & Above'], ['30', '30% & Above']];

  $infoItems = [
    ['fa-wand-magic-sparkles', 'Thoughtfully Curated', 'Collections selected with care for your home and personal style.'],
    ['fa-shield-halved', 'Secure Shopping', 'A secure checkout experience for added peace of mind.'],
    ['fa-truck-fast', 'Convenient Delivery', 'Order delivery with clear shipping information and tracking.'],
    ['fa-headset', 'Dedicated Support', "We're here to help with your shopping queries and orders."],
  ];

  // banner collage: top 2 best sellers of this category, static images as fallback
  $collageFallback = ['pro2.png', 'pro4.png'];
@endphp

@section('content')
  {{-- ===================== PRODUCT BANNER ===================== --}}
  <section class="product-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        @if($category->parent)
          <li><a href="{{ route('category.show', $category->parent->slug) }}">{{ $category->parent->name }}</a></li>
          <li><i class="fa-solid fa-chevron-right"></i></li>
        @endif
        <li class="current">{{ $category->name }}</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">{{ $category->parent->name ?? 'Shop by Category' }}</span>
          <h1 class="banner-title">{{ $category->name }}</h1>
          <p class="banner-desc">{{ $category->sub_title ?: 'Explore our ' . $category->name . ' collection, thoughtfully curated for you.' }}</p>
          <div class="banner-btns">
            <a href="#listing" class="btn btn-primary">Shop All Styles</a>
            @if($bestSellers->isNotEmpty())
              <a href="#best-sellers" class="btn btn-outline-black">Best Sellers</a>
            @endif
          </div>
        </div>

        <div class="banner-collage">
          <figure class="col-item col-big">
            <img src="{{ $category->image ? $category->image_url : asset('assets/images/home/jewellery.jpg') }}" alt="{{ $category->name }}" />
            <figcaption class="img-tag">
              <span class="tag-gem"></span>
              <span class="tag-text"><b>{{ $category->name }}</b>@if($category->sub_title)<small>{{ $category->sub_title }}</small>@endif</span>
            </figcaption>
          </figure>
          @foreach($collageFallback as $i => $fallback)
            @php $c = $bestSellers[$i] ?? null; @endphp
            <figure class="col-item">
              <img src="{{ $c['img_url'] ?? asset('assets/images/home/' . $fallback) }}" alt="{{ $c['name'] ?? $category->name }}" />
            </figure>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== LISTING (TABS + GRID) ===================== --}}
  <section class="product-secB" id="listing">
    <div class="container">
      {{-- subcategory tabs are plain links now (each subcategory has its own page) --}}
      @if($tabs->isNotEmpty())
        <ul class="tab-nav">
          <li class="{{ $category->id === $root->id ? 'active' : '' }}"><a href="{{ route('category.show', $root->slug) }}">All {{ $root->name }}</a></li>
          @foreach($tabs as $t)
            <li class="{{ $category->id === $t->id ? 'active' : '' }}"><a href="{{ route('category.show', $t->slug) }}">{{ $t->name }}</a></li>
          @endforeach
        </ul>
      @endif

      <div class="tab-nav-content">
        <div class="tabs active">
          {{-- empty form that the filter popup + sort controls submit to (they point to it with form="catFilter") --}}
          <form id="catFilter" action="{{ url()->current() }}" method="get"></form>

          <div class="prod-toolbar">
            <p class="prod-count"><b>{{ $listing->total() }}</b> {{ $listing->total() === 1 ? 'Style' : 'Styles' }}</p>
            <div class="prod-tools">
              <button type="button" class="tool-btn filter-btn" data-model=".filter-pop"><i class="fa-solid fa-sliders"></i> Filter</button>
              <button type="button" class="tool-btn sort-btn" data-model=".sort-pop"><i class="fa-solid fa-arrow-down-wide-short"></i> Sort</button>
              <div class="prod-sort">
                <label for="prodSort1">Sort By</label>
                <div class="sort-box">
                  <select id="prodSort1" name="sort" form="catFilter">
                    @foreach($sortOptions as [$value, $label])
                      <option value="{{ $value }}" @selected(request('sort', 'recommended') === $value)>{{ $label }}</option>
                    @endforeach
                  </select>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="prod-grid">
            @forelse($listing as $card)
              @include('partials.product-card', ['p' => $card])
            @empty
              <p class="prod-empty">No styles match these filters. <a href="{{ url()->current() }}">Clear all filters</a></p>
            @endforelse
          </div>

          @if($listing->total() > 0)
            <div class="load-more">
              @if($listing->hasMorePages())
                <a href="{{ $listing->nextPageUrl() }}" class="btn btn-outline-black" id="loadMore" rel="next">Load More Styles</a>
              @endif
              <p id="loadMoreCount" data-first="{{ $listing->firstItem() }}" data-last="{{ $listing->lastItem() }}" data-total="{{ $listing->total() }}">
                Showing {{ $listing->firstItem() }}–{{ $listing->lastItem() }} of {{ $listing->total() }} styles
              </p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== RECENTLY VIEWED ===================== --}}
  @if($recentlyViewed->isNotEmpty())
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
              @foreach($recentlyViewed as $card)
                <div class="swiper-slide">
                  @include('partials.product-card', ['p' => $card, 'showBadge' => false])
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
  @endif

  {{-- ===================== LEFT IMAGE + RIGHT CONTENT ===================== --}}
  <section class="product-secC">
    <div class="container">
      <div class="info-wrap">
        <div class="info-media">
          <figure class="info-main"><img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Celebrate every moment beautifully" loading="lazy" /></figure>
          <figure class="info-sub"><img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="{{ $category->name }}" loading="lazy" /></figure>
          <span class="info-tag">{{ $category->name }}</span>
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

          <div class="info-btn"><a href="#listing" class="btn btn-primary">Explore {{ $category->name }}</a></div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== BEST SELLERS ===================== --}}
  @if($bestSellers->isNotEmpty())
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
              @foreach($bestSellers as $card)
                <div class="swiper-slide">
                  @include('partials.product-card', ['p' => $card])
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
  @endif

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

  {{-- ===================== FILTER POP (inputs belong to #catFilter via form="catFilter") ===================== --}}
  <div class="model filter-pop">
    <button type="button" class="close" aria-label="Close filter">
      <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg>
    </button>
    <div class="model-body">
      <div class="title"><h4>Filter By</h4></div>

      <div class="f-groups">
        {{-- PRICE + RATING + DISCOUNT (single choice) --}}
        @foreach([['Price', 'price', $priceRanges, true], ['Customer Rating', 'rating', $ratings, false], ['Discount', 'discount', $discounts, false]] as [$title, $name, $items, $openByDefault])
          <details class="f-group" @if($openByDefault || request($name)) open @endif>
            <summary>{{ $title }} <i class="fa-solid fa-chevron-down"></i></summary>
            <ul class="f-list">
              @foreach($items as [$value, $label])
                <li><label><input type="radio" name="{{ $name }}" form="catFilter" value="{{ $value }}" @checked(request($name) === $value) /> {{ $label }}</label></li>
              @endforeach
            </ul>
          </details>
        @endforeach

        {{-- OCCASION + COLLECTION --}}
        @foreach([['Occasion', 'occasion', $occasionList], ['Collection', 'collection', $collectionList]] as [$title, $name, $items])
          @continue($items->isEmpty())
          <details class="f-group" @if(request($name)) open @endif>
            <summary>{{ $title }} <i class="fa-solid fa-chevron-down"></i></summary>
            <ul class="f-list">
              @foreach($items as $item)
                <li><label><input type="checkbox" name="{{ $name }}[]" form="catFilter" value="{{ $item->id }}" @checked(in_array($item->id, (array) request($name, []))) /> {{ $item->name }}</label></li>
              @endforeach
            </ul>
          </details>
        @endforeach

        {{-- ATTRIBUTES (button type + colour swatch) --}}
        @foreach($filterAttributes as $attr)
          @continue(!$attr->has_values || $attr->values->isEmpty())
          @php
            $isSwatch = str_contains((string) $attr->type, 'color') || str_contains((string) $attr->type, 'swatch');
            $picked   = (array) request("attr.{$attr->id}", []);
          @endphp
          <details class="f-group" @if($picked) open @endif>
            <summary>{{ $attr->name }} <i class="fa-solid fa-chevron-down"></i></summary>
            <ul class="f-list">
              @foreach($attr->values as $val)
                <li>
                  <label>
                    <input type="checkbox" name="attr[{{ $attr->id }}][]" form="catFilter" value="{{ $val->id }}" @checked(in_array($val->id, $picked)) />
                    @if($isSwatch)<i class="f-swatch" style="--c: {{ $val->hex_code }}"></i>@endif
                    {{ $val->value }}
                  </label>
                </li>
              @endforeach
            </ul>
          </details>
        @endforeach

        {{-- AVAILABILITY --}}
        <details class="f-group" @if(request()->boolean('in_stock')) open @endif>
          <summary>Availability <i class="fa-solid fa-chevron-down"></i></summary>
          <ul class="f-list">
            <li><label><input type="checkbox" name="in_stock" form="catFilter" value="1" @checked(request()->boolean('in_stock')) /> In Stock Only</label></li>
          </ul>
        </details>
      </div>

      <div class="f-foot">
        <a href="{{ url()->current() }}" class="btn btn-outline-primary">Clear All</a>
        <button type="submit" form="catFilter" class="btn btn-primary">Apply Filters</button>
      </div>
    </div>
  </div>

  {{-- ===================== SORT POP (mobile) ===================== --}}
  <div class="model sort-pop">
    <button type="button" class="close" aria-label="Close sort">
      <svg width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg>
    </button>
    <div class="model-body">
      <div class="title"><h4>Sort By</h4></div>
      <ul class="sort-list">
        @foreach($sortOptions as [$value, $label])
          <li><label><input type="radio" name="SortBy" value="{{ $value }}" @checked(request('sort', 'recommended') === $value) /> {{ $label }}</label></li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // ---------- sort: desktop select + mobile popup both submit #catFilter ----------
  (function () {
    var form = document.getElementById("catFilter");
    var select = document.getElementById("prodSort1");
    if (!form || !select) return;

    select.addEventListener("change", function () { form.submit(); });

    document.querySelectorAll('input[name="SortBy"]').forEach(function (radio) {
      radio.addEventListener("change", function () {
        select.value = radio.value;
        form.submit();
      });
    });
  })();

  // ---------- load more: appends the next page without reloading (plain link works without JS) ----------
  (function () {
    var btn = document.getElementById("loadMore");
    var grid = document.querySelector(".prod-grid");
    var info = document.getElementById("loadMoreCount");
    if (!btn || !grid) return;
    var first = info ? info.dataset.first : 1;

    btn.addEventListener("click", function (e) {
      e.preventDefault();
      if (btn.classList.contains("is-loading")) return;
      btn.classList.add("is-loading");
      btn.textContent = "Loading…";

      fetch(btn.href, { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then(function (r) { return r.text(); })
        .then(function (html) {
          var doc = new DOMParser().parseFromString(html, "text/html");
          doc.querySelectorAll(".prod-grid > *").forEach(function (node) { grid.appendChild(node); });

          var nextInfo = doc.getElementById("loadMoreCount");
          if (info && nextInfo) {
            info.textContent = "Showing " + first + "–" + nextInfo.dataset.last + " of " + nextInfo.dataset.total + " styles";
          }

          var nextBtn = doc.getElementById("loadMore");
          if (nextBtn) {
            btn.href = nextBtn.getAttribute("href");
            btn.textContent = "Load More Styles";
            btn.classList.remove("is-loading");
          } else {
            btn.remove();
          }
        })
        .catch(function () { window.location.href = btn.href; });
    });
  })();
</script>
@endpush