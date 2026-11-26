@extends('layouts.app')

@section('title', 'All Products Listing | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/product-listing/product-listing.css') }}" />
@endpush

@php
  // ---------- filter: quick price chips [value, label] ----------
  $priceQuick = [['499', 'Under ₹499'], ['999', 'Under ₹999'], ['1999', 'Under ₹1,999'], ['2999', 'Under ₹2,999'], ['premium', 'Premium ₹5,000+']];

  $ratings   = [['4.5', 5, '4.5 & Above'], ['4', 4, '4.0 & Above'], ['3', 3, '3.0 & Above']];
  $discounts = [['10', '10% & Above'], ['20', '20% & Above'], ['30', '30% & Above']];

  $selCats = (array) request('category', []);
@endphp

@section('content')
  {{-- ===================== BANNER ===================== --}}
  <section class="ap-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">All Products</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Grih Shree &amp; Pihu Jewel</span>
          <h1 class="banner-title">All Products</h1>
          <p class="banner-desc">Thoughtfully curated home essentials and beautiful jewellery, all in one place.</p>
          <div class="banner-btns">
            <a href="#listing" class="btn btn-primary">Shop All Products</a>
            <a href="#best-sellers" class="btn btn-outline-black">Best Sellers</a>
          </div>
        </div>

        <div class="banner-collage">
          <figure class="col-item col-big">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" />
            <figcaption class="img-tag">
              <span class="tag-gem"></span>
              <span class="tag-text"><b>Home &amp; Jewellery</b><small>Beautiful Living, Timeless Adornment</small></span>
            </figcaption>
          </figure>
          <figure class="col-item">
            <img src="{{ asset('assets/images/home/pro1.png') }}" alt="Handloom Cotton Bedsheet Set" />
          </figure>
          <figure class="col-item">
            <img src="{{ asset('assets/images/home/pro4.png') }}" alt="Pearl Drop Earrings" />
          </figure>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== EXPLORE BY CATEGORY (dynamic) ===================== --}}
  @if(isset($categories) && $categories->isNotEmpty())
    <section class="ap-cats">
      <div class="container">
        <div class="heading">
          <span>Shop by Category</span>
          <h3>Explore by <span>Category</span></h3>
          <p>Find the perfect handcrafted pieces for your home, rituals and everyday moments.</p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper fourSlider" data-mob="1.3" data-sm="2" data-lg="4" data-xl="5">
            <div class="swiper-wrapper">
              @foreach($categories as $category)
                <div class="swiper-slide">
                  <a href="{{ url('category/' . $category->slug) }}" class="cat_pill">
                    <figure>
                      <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy" />
                    </figure>
                    <div class="txt">
                      <h4>{{ $category->name }}</h4>
                      <span>{{ $category->products_total }} {{ $category->products_total === 1 ? 'item' : 'items' }}</span>
                    </div>
                  </a>
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

  {{-- ===================== LISTING ===================== --}}
  <section class="ap-main" id="listing">
    <div class="container">
      {{-- hidden state holders --}}
      <input type="checkbox" id="filterToggle" class="filter-toggle" hidden />
      <input type="radio" name="brand" id="bAll" value="" form="filterPanel" hidden @checked(!request('brand')) />
      @foreach($brands as $b)
        <input type="radio" name="brand" id="b{{ $b->id }}" value="{{ $b->slug }}" form="filterPanel" hidden @checked(request('brand') === $b->slug) />
      @endforeach

      {{-- brand pill bar (add a .brand-tabs label.active style in your CSS) --}}
      <div class="brand-tabs">
        <label for="bAll" class="{{ request('brand') ? '' : 'active' }}">All Products <small>{{ $brandCounts->sum() }}</small></label>
        @foreach($brands as $b)
          <label for="b{{ $b->id }}" class="{{ request('brand') === $b->slug ? 'active' : '' }}">{{ $b->name }} <small>{{ $brandCounts[$b->id] ?? 0 }}</small></label>
        @endforeach
      </div>

      {{-- toolbar --}}
      <div class="ap-toolbar">
        <p class="ap-count">
          @if($listing->total())
            Showing <b>{{ $listing->firstItem() }}–{{ $listing->lastItem() }}</b> of <b>{{ $listing->total() }}</b> products
          @else
            No products found
          @endif
        </p>
        <div class="ap-tools">
          <label for="filterToggle" class="tool-btn"><i class="fa-solid fa-sliders"></i> Filter</label>
          <div class="ap-sort">
            <label for="apSort">Sort By</label>
            <div class="sort-box">
              <select id="apSort" name="sort" form="filterPanel">
                @foreach(['recommended' => 'Recommended', 'newest' => 'New Arrivals', 'sold' => 'Best Selling', 'rating' => 'Customer Rating', 'discount' => 'Biggest Discount', 'low' => 'Price: Low to High', 'high' => 'Price: High to Low'] as $v => $l)
                  <option value="{{ $v }}" @selected(request('sort', 'recommended') === $v)>{{ $l }}</option>
                @endforeach
              </select>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>

          {{-- grid view switch --}}
          <div class="view-switch" role="group" aria-label="Product grid view">
            <button type="button" class="view-btn v-1" data-cols="1" aria-label="1 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="4" y="4" width="16" height="7" rx="2" />
                <rect x="4" y="13" width="16" height="7" rx="2" />
              </svg>
            </button>
            <button type="button" class="view-btn v-2" data-cols="2" aria-label="2 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="4" y="4" width="7" height="16" rx="2" />
                <rect x="13" y="4" width="7" height="16" rx="2" />
              </svg>
            </button>
            <button type="button" class="view-btn v-3" data-cols="3" aria-label="3 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="3" y="4" width="5" height="16" rx="1.6" />
                <rect x="9.5" y="4" width="5" height="16" rx="1.6" />
                <rect x="16" y="4" width="5" height="16" rx="1.6" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      {{-- applied filters --}}
      @if(count($applied))
        <div class="ap-applied">
          <span class="lbl">Applied</span>
          @foreach($applied as [$label, $url])
            <a href="{{ $url }}" class="a-chip">{{ $label }} <i class="fa-solid fa-xmark"></i></a>
          @endforeach
          <a href="{{ route('products') }}" class="a-clear">Clear All</a>
        </div>
      @endif

      <div class="ap-layout">
        <label for="filterToggle" class="filter-overlay" aria-hidden="true"></label>

        {{-- ================= FILTER ================= --}}
        <form class="ap-filter" id="filterPanel" action="{{ route('products') }}" method="get" aria-label="Product filters">
          <div class="f-head">
            <div class="f-ttl">
              <span class="f-icon"><i class="fa-solid fa-sliders"></i></span>
              <h4>Filters</h4>
            </div>
            <a href="{{ route('products') }}" class="f-clear">Clear All</a>
            <label for="filterToggle" class="f-close" aria-label="Close filters"><i class="fa-solid fa-xmark"></i></label>
          </div>

          <div class="f-scroll">
            {{-- QUICK --}}
            <details class="f-group" open>
              <summary>Quick Filters</summary>
              <div class="f-body f-switches">
                <label class="f-switch">
                  <input type="checkbox" name="in_stock" value="1" @checked(request()->boolean('in_stock')) />
                  <span class="f-text">In Stock Only</span>
                  <span class="f-track"></span>
                </label>
              </div>
            </details>

            {{-- CATEGORY (parent -> subcategories) --}}
            @if($filterCategories->isNotEmpty())
              <details class="f-group" open>
                <summary>Category</summary>
                <div class="f-body">
                  <div class="f-tree">
                    @foreach($filterCategories as $parent)
                      <details class="f-sub" @if(in_array($parent->slug, $selCats) || $parent->children->pluck('slug')->intersect($selCats)->isNotEmpty()) open @endif>
                        <summary>{{ $parent->name }} <em>{{ $parent->products_count }}</em></summary>
                        <div class="f-sub-body">
                          @foreach(collect([$parent])->concat($parent->children) as $c)
                            <label class="f-check">
                              <input type="checkbox" name="category[]" value="{{ $c->slug }}" @checked(in_array($c->slug, $selCats)) /><span class="f-box"></span>
                              <span class="f-text">{{ $loop->first ? 'All ' . $c->name : $c->name }}</span>
                            </label>
                          @endforeach
                        </div>
                      </details>
                    @endforeach
                  </div>
                </div>
              </details>
            @endif

            {{-- PRICE --}}
            <details class="f-group" open>
              <summary>Price</summary>
              <div class="f-body">
                <div class="f-chips f-quick">
                  @foreach($priceQuick as [$value, $label])
                    <label class="f-chip"><input type="radio" name="price_quick" value="{{ $value }}" @checked(request('price_quick') === $value) /><span>{{ $label }}</span></label>
                  @endforeach
                </div>

                <div class="price-range" data-min="0" data-max="{{ $priceCeiling }}">
                  <div class="range-track"><span class="range-fill"></span></div>
                  <input type="range" class="range-min" min="0" max="{{ $priceCeiling }}" step="500" value="{{ $priceMin }}" aria-label="Minimum price" />
                  <input type="range" class="range-max" min="0" max="{{ $priceCeiling }}" step="500" value="{{ $priceMax }}" aria-label="Maximum price" />
                </div>
                <div class="price-inputs">
                  <label><span>Min</span><b>₹</b><input type="number" name="price_min" class="in-min" value="{{ $priceMin }}" min="0" max="{{ $priceCeiling }}" step="500" /></label>
                  <i class="price-dash"></i>
                  <label><span>Max</span><b>₹</b><input type="number" name="price_max" class="in-max" value="{{ $priceMax }}" min="0" max="{{ $priceCeiling }}" step="500" /></label>
                </div>
              </div>
            </details>

            {{-- OCCASION + COLLECTION --}}
            @foreach([['Occasion', 'occasion', $occasionList], ['Collection', 'collection', $collectionList]] as [$title, $name, $items])
              @continue($items->isEmpty())
              <details class="f-group" open>
                <summary>{{ $title }}</summary>
                <div class="f-body f-chips">
                  @foreach($items as $item)
                    <label class="f-chip">
                      <input type="checkbox" name="{{ $name }}[]" value="{{ $item->id }}" @checked(in_array($item->id, (array) request($name, []))) />
                      <span>{{ $item->name }}</span>
                    </label>
                  @endforeach
                </div>
              </details>
            @endforeach

            {{-- ATTRIBUTES (button chips / colour swatches) --}}
            @foreach($filterAttributes as $attr)
              @continue(!$attr->has_values || $attr->values->isEmpty())
              @php
                $isSwatch = str_contains((string) $attr->type, 'color') || str_contains((string) $attr->type, 'swatch');
                $picked   = (array) request("attr.{$attr->id}", []);
              @endphp
              <details class="f-group" @if($picked || $loop->index < 3) open @endif>
                <summary>{{ $attr->name }}</summary>
                <div class="f-body f-chips">
                  @foreach($attr->values as $val)
                    <label class="f-chip {{ $isSwatch ? 'f-dot' : '' }}">
                      <input type="checkbox" name="attr[{{ $attr->id }}][]" value="{{ $val->id }}" @checked(in_array($val->id, $picked)) />
                      @if($isSwatch)
                        <span><i style="--c: {{ $val->hex_code }}"></i>{{ $val->value }}</span>
                      @else
                        <span>{{ $val->value }}</span>
                      @endif
                    </label>
                  @endforeach
                </div>
              </details>
            @endforeach

            {{-- RATING --}}
            <details class="f-group" @if(request('rating')) open @endif>
              <summary>Customer Rating</summary>
              <div class="f-body f-list">
                @foreach($ratings as [$value, $stars, $label])
                  <label class="f-check">
                    <input type="radio" name="rating" value="{{ $value }}" @checked(request('rating') === $value) /><span class="f-box is-radio"></span>
                    <span class="f-text f-stars">
                      @for($i = 1; $i <= 5; $i++)<i class="fa-{{ $i <= $stars ? 'solid' : 'regular' }} fa-star"></i>@endfor
                      <em>{{ $label }}</em>
                    </span>
                  </label>
                @endforeach
              </div>
            </details>

            {{-- DISCOUNT --}}
            <details class="f-group" @if(request('discount')) open @endif>
              <summary>Discount</summary>
              <div class="f-body f-list">
                @foreach($discounts as [$value, $label])
                  <label class="f-check">
                    <input type="radio" name="discount" value="{{ $value }}" @checked(request('discount') === $value) /><span class="f-box is-radio"></span><span class="f-text">{{ $label }}</span>
                  </label>
                @endforeach
              </div>
            </details>
          </div>

          <div class="f-foot">
            <a href="{{ route('products') }}" class="btn btn-outline-black">Clear All</a>
            <button type="submit" class="btn btn-primary">Show Results</button>
          </div>
        </form>

        {{-- ================= PRODUCTS ================= --}}
        <div class="ap-content">
          <div class="ap-grid" id="apGrid">
            @forelse($listing as $card)
              @include('partials.product-card', ['p' => $card])
            @empty
              <p class="ap-empty">No products match these filters. <a href="{{ route('products') }}">Clear all filters</a></p>
            @endforelse
          </div>

          {{ $listing->links('partials.pagination') }}
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== BEST SELLERS ===================== --}}
  @if($bestSellers->isNotEmpty())
  <section class="ap-best" id="best-sellers">
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

  {{-- ===================== WHY / CARE ===================== --}}
  <section class="ap-why">
    <div class="container">
      <div class="info-wrap">
        <div class="info-media">
          <figure class="info-main">
            <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree home and living" loading="lazy" />
          </figure>
          <figure class="info-sub">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" loading="lazy" />
          </figure>
          <span class="info-tag">Grih Shree &middot; Pihu Jewel</span>
        </div>

        <div class="info-right">
          <div class="heading">
            <span>The Difference Is in the Details</span>
            <h3>A Shopping Experience <span>Made with Care</span></h3>
            <p>
              Thoughtful collections, easy discovery and dedicated support come together to make every shopping
              experience feel special.
            </p>
          </div>

          <ul class="info-grid">
            @foreach([
              ['fa-wand-magic-sparkles', 'Thoughtfully Curated', 'Collections selected with care for your home and personal style.'],
              ['fa-shield-halved', 'Secure Shopping', 'A secure checkout experience for added peace of mind.'],
              ['fa-truck-fast', 'Convenient Delivery', 'Order delivery with clear shipping information and tracking.'],
              ['fa-headset', 'Dedicated Support', "We're here to help with your shopping queries and orders."],
            ] as [$icon, $title, $text])
              <li class="info_item">
                <span class="item-icon"><i class="fa-solid {{ $icon }}"></i></span>
                <div class="item-txt">
                  <h4>{{ $title }}</h4>
                  <p>{{ $text }}</p>
                </div>
              </li>
            @endforeach
          </ul>

          <div class="info-btn">
            <a href="#listing" class="btn btn-primary">Shop All Products</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== RECENTLY VIEWED ===================== --}}
  @if($recentlyViewed->isNotEmpty())
  <section class="ap-recent">
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

@push('scripts')
<script>
  // ---------- sort + brand tabs submit the filter form straight away ----------
  (function () {
    var form = document.getElementById("filterPanel");
    if (!form) return;
    document.querySelectorAll('#apSort, [name="brand"][form="filterPanel"]').forEach(function (el) {
      el.addEventListener("change", function () { form.submit(); });
    });
  })();

  // ---------- price range ----------
  (function () {
    var range = document.querySelector(".price-range");
    if (!range) return;
    var form = range.closest("form");
    var minR = range.querySelector(".range-min"),
      maxR = range.querySelector(".range-max");
    var fill = range.querySelector(".range-fill");
    var minI = form.querySelector(".in-min"),
      maxI = form.querySelector(".in-max");
    var MIN = +range.dataset.min,
      MAX = +range.dataset.max,
      GAP = 500;

    // moving the slider / typing a price cancels the quick-price chip (otherwise the chip would win on the server)
    function clearQuick() {
      form.querySelectorAll('[name="price_quick"]').forEach(function (r) { r.checked = false; });
    }

    function paint() {
      var a = +minR.value,
        b = +maxR.value;
      fill.style.left = ((a - MIN) / (MAX - MIN)) * 100 + "%";
      fill.style.right = 100 - ((b - MIN) / (MAX - MIN)) * 100 + "%";
      minR.style.zIndex = a > MAX - (MAX - MIN) * 0.1 ? 3 : 2;
      maxR.style.zIndex = 2;
    }
    function fromRange(e) {
      clearQuick();
      var a = +minR.value,
        b = +maxR.value;
      if (b - a < GAP) {
        if (e.target === minR) { a = b - GAP; minR.value = a; }
        else { b = a + GAP; maxR.value = b; }
      }
      minI.value = a;
      maxI.value = b;
      paint();
    }
    function fromInput() {
      clearQuick();
      var a = +minI.value || MIN,
        b = +maxI.value || MAX;
      a = Math.max(MIN, Math.min(a, MAX - GAP));
      b = Math.min(MAX, Math.max(b, a + GAP));
      minI.value = minR.value = a;
      maxI.value = maxR.value = b;
      paint();
    }
    minR.addEventListener("input", fromRange);
    maxR.addEventListener("input", fromRange);
    minI.addEventListener("change", fromInput);
    maxI.addEventListener("change", fromInput);
    paint();
  })();

  // ---------- grid view switch ----------
  (function () {
    var grid = document.getElementById("apGrid");
    var btns = document.querySelectorAll(".view-switch .view-btn");
    if (!grid || !btns.length) return;

    var mq = window.matchMedia("(max-width: 768px)");
    var choice = null; // user's selected column count

    function currentCols() {
      var n = getComputedStyle(grid).gridTemplateColumns.split(" ").length;
      return n > 3 ? 3 : n;
    }

    function sync() {
      grid.classList.remove("is-1", "is-2", "is-3");

      // phone: 1/2 valid, tablet/desktop: 2/3 valid
      var valid = choice && (mq.matches ? choice <= 2 : choice >= 2);
      if (valid) grid.classList.add("is-" + choice);
      else choice = null;

      var active = currentCols();
      btns.forEach(function (b) {
        var on = parseInt(b.dataset.cols, 10) === active;
        b.classList.toggle("active", on);
        b.setAttribute("aria-pressed", on ? "true" : "false");
      });
    }

    btns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        choice = parseInt(btn.dataset.cols, 10);
        sync();
      });
    });

    window.addEventListener("resize", sync);
    sync();
  })();
</script>
@endpush