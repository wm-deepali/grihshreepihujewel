@extends('layouts.app')

@php
  $productName = $product->name;
  $productSku = $product->sku;
  $inStock = $product->stock > 0;
  $minQty = max(1, (int) $product->min_qty);
  $hasText = fn($h) => trim(strip_tags((string) $h)) !== '';
  $hasReturns = $hasText($product->returns_exchange);

  // contact links from Settings
  $waDigits = preg_replace('/\D+/', '', (string) ($general->whatsapp ?? ''));
  if (strlen($waDigits) === 10) {
    $waDigits = '91' . $waDigits; // wa.me needs the country code
  }
  $waLink = $waDigits
    ? 'https://wa.me/' . $waDigits . '?text=' . rawurlencode('Hi, I need help with ' . $product->name . ' - ' . url()->current())
    : null;

  $phoneTel = preg_replace('/[^\d+]/', '', (string) ($general->phone ?? ''));
  $telLink = $phoneTel ? 'tel:' . $phoneTel : null;

  $isWished = in_array($product->id, $wishedIds ?? []);
@endphp

@section('title', $product->name . ' | ' . config('app.name'))

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
            @php
              $badge = $product->collectionBadge()
                ?? (($product->created_at && $product->created_at->gt(now()->subDays(30)))
                  ? ['new', 'fa-sparkles', 'New']
                  : null);
            @endphp
            @if($badge)
              <span class="gallery-tag {{ $badge[0] }}"><i class="fa-solid {{ $badge[1] }}"></i> {{ $badge[2] }}</span>
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
            <li><i
                class="fa-solid fa-truck-fast"></i><span>{{ $inStock ? 'Ready to Ship' : 'Currently Unavailable' }}</span>
            </li>
            <li><i class="fa-solid fa-shield-halved"></i><span>Secure Payments</span></li>
            @if($hasReturns)
              <li><i class="fa-solid fa-arrow-right-arrow-left"></i><span>Returns &amp; Exchange</span></li>
            @endif
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
              <span class="info-sku">SKU: <span class="sku-val">{{ $product->sku }}</span></span>
            @endif
          </div>

          @php $pct = $product->discount_percent; @endphp
          <div class="info-price">
            <div class="price-line">
              <span class="price-now">₹{{ number_format($product->price) }}</span>
              <span class="price-old" @if(!$pct) style="display:none" @endif>₹{{ number_format($product->mrp) }}</span>
              <span class="price-off" @if(!$pct) style="display:none" @endif>{{ $pct }}% OFF</span>
            </div>
            <div class="price-meta">
              <p class="price-save" @if(!$pct) style="display:none" @endif><i class="fa-solid fa-tags"></i> You save
                <b>₹{{ number_format($product->mrp - $product->price) }}</b>
              </p>
              @if($taxNote)<p class="price-tax">{{ $taxNote }}</p>@endif
            </div>
          </div>

          @if($product->short_description)
            <p class="info-desc">{{ strip_tags($product->short_description) }}</p>
          @endif

          @if($tags->isNotEmpty())
            <ul class="info-tags">
              @foreach($tags as $tag)
                <li>{{ $tag }}</li>
              @endforeach
            </ul>
          @endif

          <!-- ================= KEY FACTS ================= -->
          @if($facts->isNotEmpty())
            <ul class="info-facts">
              @foreach($facts as $f)
                <li><small>{{ $f['label'] }}</small><b>{{ $f['value'] }}</b></li>
              @endforeach
            </ul>
          @endif

          @php
            $swatchOpts = $options->where('swatch', true);
            $buttonOpts = $options->where('swatch', false);
            $guideShown = false;
          @endphp

          {{-- colour swatch design --}}
          @foreach($swatchOpts->chunk(2) as $pair)
            <div class="opt-duo">
              @foreach($pair as $opt)
                <div class="opt-card">
                  <div class="opt-head">
                    <span>{{ $opt['name'] }}</span><b class="opt-value">{{ $opt['values']->first()['name'] }}</b>
                  </div>
                  <div class="opt-swatches">
                    @foreach($opt['values'] as $v)
                      <label class="opt-swatch" title="{{ $v['name'] }}">
                        <input type="radio" name="attr[{{ $opt['id'] }}]" value="{{ $v['id'] }}" data-name="{{ $v['name'] }}" {{ $loop->first ? 'checked' : '' }} />
                        <span style="--c: {{ $v['color'] ?: '#cccccc' }}"></span>
                      </label>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
          @endforeach

          {{-- button design --}}
          @foreach($buttonOpts as $opt)
            @php
              $showGuide = $sizeChart && $opt['is_size'] && !$guideShown;
              $guideShown = $guideShown || $showGuide;
              $square = $opt['values']->every(fn($v) => mb_strlen($v['name']) <= 3);
            @endphp
            <div class="opt-card">
              <div class="opt-head">
                <span>{{ $opt['name'] }}</span><b class="opt-value">{{ $opt['values']->first()['name'] }}</b>
                @if($showGuide)
                  <button type="button" class="size-guide" data-model=".size-pop">
                    <i class="fa-solid fa-ruler"></i> Size Guide
                  </button>
                @endif
              </div>
              <div class="opt-sizes">
                @foreach($opt['values'] as $v)
                  <label class="opt-size {{ $square ? 'is-sq' : '' }}">
                    <input type="radio" name="attr[{{ $opt['id'] }}]" value="{{ $v['id'] }}" data-name="{{ $v['name'] }}" {{ $loop->first ? 'checked' : '' }} />
                    <span>{{ $v['name'] }}</span>
                  </label>
                @endforeach
              </div>
            </div>
          @endforeach

          {{-- chart exists but the product has no "size" attribute --}}
          @if($sizeChart && !$guideShown)
            <button type="button" class="size-guide" data-model=".size-pop">
              <i class="fa-solid fa-ruler"></i> Size Guide
            </button>
          @endif

          <!-- ================= ADDONS ================= -->
          @foreach($product->addons as $addon)
            <div class="opt-card opt-gift">
              <label class="opt-switch">
                <input type="checkbox" name="addons[]" value="{{ $addon->id }}" data-price="{{ (float) $addon->price }}" />
                <span class="os-text">{{ $addon->detail }}
                  @if($addon->description)
                    <small>{{ $addon->description }}</small>
                  @endif
                </span>
                <strong>{{ $addon->price > 0 ? '+ ₹' . number_format($addon->price) : 'Free' }}</strong>
                <span class="os-track"></span>
              </label>
            </div>
          @endforeach

          <p class="info-stock {{ $inStock ? '' : 'is-out' }}">
            <i class="fa-solid fa-circle"></i>
            <b>{{ $inStock ? 'In Stock' : 'Out of Stock' }}</b>
            <em>{{ $inStock ? ($product->delivery_time ? 'Ready to ship, dispatched in ' . $product->delivery_time : 'Ready to ship') : 'Currently unavailable' }}</em>
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
              @if($general->wishlist)
                <button type="button" class="wish-link js-wish {{ $isWished ? 'is-active' : '' }}"
                  data-product-id="{{ $product->id }}" aria-pressed="{{ $isWished ? 'true' : 'false' }}">
                  <i class="{{ $isWished ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                  <span>{{ $isWished ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                </button>
              @endif
            </div>
            <div class="act-btns">
              <button type="button" class="btn btn-outline-black js-add-cart" data-product-id="{{ $product->id }}"
                data-name="{{ $productName }}">Add to Cart</button>
              <button type="button" class="btn btn-primary js-buy-now" data-product-id="{{ $product->id }}"
                data-name="{{ $productName }}">Buy Now</button>
            </div>
          </div>

          <div class="info-delivery">
            <div class="del-head"><i class="fa-solid fa-location-dot"></i><b>Check Delivery</b></div>
            <form class="pin-form" action="{{ route('pincode.check') }}" method="get" novalidate>
              <input type="text" name="pincode" inputmode="numeric" maxlength="6" placeholder="Enter your pincode"
                aria-label="Pincode" />
              <button type="submit">Check</button>
            </form>
            <p class="pin-result">
              <i class="fa-solid fa-circle-info"></i>
              <span>Enter your pincode to see delivery time and COD availability.</span>
            </p>
            <ul class="del-points">
              @if($product->delivery_time)
                <li><i class="fa-solid fa-truck-fast"></i> Dispatched in {{ $product->delivery_time }}</li>
              @endif
              <li><i class="fa-solid fa-map-location-dot"></i> Pan-India delivery, reliable and tracked</li>
              @if($general->cod_enabled)
                <li><i class="fa-solid fa-hand-holding-dollar"></i> Cash on Delivery on selected pincodes</li>
              @endif
              @if($hasReturns)
                <li><i class="fa-solid fa-arrow-right-arrow-left"></i> Returns and exchange available</li>
              @endif
              <li><i class="fa-solid fa-shield-halved"></i> Secure payments, safe and trusted checkout</li>
            </ul>
          </div>

          @php $freeAddons = $product->addons->where('price', '<=', 0); @endphp

          @if($coupons->isNotEmpty() || $freeAddons->isNotEmpty())
            <div class="info-offers">
              <div class="offers-head">
                <h5>Offers &amp; Coupons</h5>
              </div>

              @foreach($coupons as $c)
                <div class="offer-row">
                  <span class="offer-ico"><i class="fa-solid {{ $c->is_percent ? 'fa-percent' : 'fa-tags' }}"></i></span>
                  <div class="offer-text">
                    <b>{{ $c->is_percent ? (float) $c->discount_value . '% OFF' : '₹' . number_format($c->discount_value) . ' OFF' }}</b>
                    <p>{{ $c->offer_text }}</p>
                  </div>
                  <button type="button" class="coupon-copy" data-copy="{{ $c->code }}" aria-label="Copy coupon code">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8"
                      stroke-linecap="round" stroke-linejoin="round">
                      <rect x="9" y="9" width="11" height="11" rx="2" />
                      <path d="M5 15V6a2 2 0 012-2h9" />
                    </svg>
                    <span>{{ $c->code }}</span>
                  </button>
                </div>
              @endforeach

              {{-- free addons (e.g. gift box) --}}
              @foreach($freeAddons as $a)
                <div class="offer-row">
                  <span class="offer-ico"><i class="fa-solid fa-box-open"></i></span>
                  <div class="offer-text">
                    <b>Free {{ $a->detail }}</b>
                    <p>{{ $a->description ?: 'Add it above at no extra cost.' }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          <!-- ================= PERKS ================= -->
          <div class="info-perks">
            @if($pairsWith)
              <div class="perk">
                <i class="fa-solid fa-link"></i>
                <div><b>Pairs With</b>
                  <p>{{ $pairsWith }}</p>
                </div>
              </div>
            @endif
            <div class="perk">
              <i class="fa-solid fa-truck-fast"></i>
              <div><b>{{ $inStock ? 'Ready to Ship' : 'Currently Unavailable' }}</b>
                @if($product->delivery_time)
                  <p>Dispatched in {{ $product->delivery_time }}.</p>
                @endif
              </div>
            </div>
            @if($hasReturns)
              <div class="perk">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                <div><b>Returns &amp; Exchange</b>
                  <p>Policy details below.</p>
                </div>
              </div>
            @endif
            <div class="perk">
              <i class="fa-solid fa-shield-halved"></i>
              <div><b>Secure Checkout</b>
                <p>Safe, encrypted payments.</p>
              </div>
            </div>
          </div>

          @if($waLink || $telLink)
            <div class="info-help">
              <div class="help-text">
                <b>Need help choosing?</b>
                <p>Talk to our team about options, sizes, occasions and gifting.</p>
              </div>
              <div class="help-links">
                @if($waLink)
                  <a href="{{ $waLink }}" class="help-link" target="_blank" rel="noopener"><i
                      class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                @endif
                @if($telLink)
                  <a href="{{ $telLink }}" class="help-link"><i class="fa-solid fa-phone"></i> Call Us</a>
                @endif
              </div>
            </div>
          @endif

          <!-- ============ ACCORDION (common JS, class .active) ============ -->
          @php
            $inclusions = $product->inclusion_list;
            $first = true;
          @endphp

          <div class="accordion-wrapper">

            @if($hasText($product->description))
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Description</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body rich">{!! $product->description !!}</div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($specs->isNotEmpty())
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Product Specifications</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body">
                      <div class="spec-cols">
                        @foreach($specs->chunk((int) ceil($specs->count() / 2)) as $col)
                          <ul class="spec-list">
                            @foreach($col as $s)
                              <li><span>{{ $s['label'] }}</span><b>{{ $s['value'] }}</b></li>
                            @endforeach
                          </ul>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($inclusions)
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>What's Included</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body">
                      <ul class="box-list">
                        @foreach($inclusions as $item)
                          <li><span class="bx-ico"><i class="fa-solid fa-circle-check"></i></span><b>{{ $item }}</b></li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($hasText($product->size_fit) || $sizeChart)
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Size &amp; Fit</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body rich">
                      {!! $product->size_fit !!}
                      @if($sizeChart)
                        <button type="button" class="policy-link" data-model=".size-pop">
                          Open Size Guide <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($hasText($product->care_instructions))
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Care Instructions</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body rich">{!! $product->care_instructions !!}</div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($hasText($product->shipping_delivery))
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Shipping &amp; Delivery</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body rich">{!! $product->shipping_delivery !!}</div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif

            @if($hasReturns)
              <div class="accordion-item {{ $first ? 'active' : '' }}">
                <button type="button" class="accordion-header">
                  <h4>Returns &amp; Exchange</h4><span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                  <div class="acc-inner">
                    <div class="acc-body rich">{!! $product->returns_exchange !!}</div>
                  </div>
                </div>
              </div>
              @php $first = false; @endphp
            @endif
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
          <span><strong class="ds-price">₹{{ number_format($product->price) }}</strong><em class="ds-off"
              @if(!$product->discount_percent) style="display:none" @endif>{{ $product->discount_percent }}%
              OFF</em></span>
        </div>
      </div>

      <div class="ds-actions">
        <div class="qty-box">
          <button type="button" class="qty-minus" aria-label="Decrease quantity"><i
              class="fa-solid fa-minus"></i></button>
          <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
          <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
        </div>
        <button type="button" class="btn btn-outline-black js-add-cart" data-product-id="{{ $product->id }}"
          data-name="{{ $productName }}">Add to Cart</button>
        <button type="button" class="btn btn-primary js-buy-now" data-product-id="{{ $product->id }}"
          data-name="{{ $productName }}">Buy Now</button>
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
          <p>Pick up where you left off.</p>
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
        <p>Honest words from people who bought this.</p>
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
          <p>No reviews yet. Be the first to share your thoughts on this product.</p>
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
          <p>More from {{ $product->subcategory?->name ?? $product->category?->name ?? 'our collection' }} you might like.
          </p>
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
            <label for="rvText">Tell us about your experience</label>
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
  @if($sizeChart)
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
          <div class="size-chart-content">{!! $sizeChart !!}</div>
          @if($waLink)
            <a href="{{ $waLink }}" class="sg-help" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Need
              Help? Chat with Us</a>
          @endif
        </div>
      </div>
    </div>
  @endif
@endpush

@push('scripts')
  <script>window.PD = @json($pd);</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
  <script>
    $(function () {
      var PD = window.PD || { base: {}, variants: {} };
      var minQty = PD.base.minQty || 1, maxQty = 10;
      var cur = { mrp: PD.base.mrp || 0, price: PD.base.price || 0 }; // unit price of the selected variant (without addons)
      var pad = function (n) { return ("0" + n).slice(-2); };
      var money = function (n) { return "₹" + Math.round(n).toLocaleString("en-US"); };

      // ---------- gallery ----------
      var main = new Swiper(".detailMain", {
        speed: 600,
        navigation: { nextEl: ".g-next", prevEl: ".g-prev" },
        pagination: { el: ".gallery-counter", type: "fraction", formatFractionCurrent: pad, formatFractionTotal: pad },
      });
      main.on("slideChange", function () {
        $(".thumb-list button").removeClass("active").eq(main.activeIndex).addClass("active");
      });
      $(document).on("click", ".thumb-list button", function () { main.slideTo($(this).index()); });

      var glb = GLightbox({ selector: ".glightbox", touchNavigation: true, loop: true });
      var origSlides = $(".detailMain .swiper-wrapper").html();
      var origThumbs = $(".thumb-list").html();
      var curImg = "orig";

      function setGallery(iv) {
        var key = iv && iv.images.length ? iv.id : "orig";
        if (key === curImg) return;
        curImg = key;

        var slides = origSlides, thumbs = origThumbs;
        if (key !== "orig") {
          slides = iv.images.map(function (i) {
            return '<div class="swiper-slide"><a href="' + i.url + '" class="gallery-img glightbox" data-gallery="product"><img src="' + i.url + '" alt="" /></a></div>';
          }).join("");
          thumbs = iv.images.map(function (i, n) {
            return '<button type="button" class="' + (n ? "" : "active") + '"><img src="' + i.thumb + '" alt="" /></button>';
          }).join("");
        }

        $(".detailMain .swiper-wrapper").html(slides);
        if ($(".thumb-list").length) $(".thumb-list").html(thumbs);
        main.update();
        main.slideTo(0, 0);
        if (main.pagination && main.pagination.render) { main.pagination.render(); main.pagination.update(); }
        glb.reload();
      }

      // ---------- helpers ----------
      function selectedIds() {
        return $('.detail-info input[name^="attr["]:checked').map(function () { return parseInt(this.value, 10); }).get();
      }

      // sum of checked addons (per unit)
      function addonTotal() {
        var t = 0;
        $('.detail-info input[name="addons[]"]:checked').each(function () {
          t += parseFloat($(this).data("price")) || 0;
        });
        return t;
      }

      function currentQty() {
        return parseInt($(".qty-input").first().val(), 10) || minQty;
      }

      // the most specific variant of a type whose values are all selected
      function pick(type, sel) {
        var list = (PD.variants && PD.variants[type]) || [], best = null;
        list.forEach(function (v) {
          if (!v.values.length) return;
          var ok = v.values.every(function (id) { return sel.indexOf(id) !== -1; });
          if (ok && (!best || v.values.length > best.values.length)) best = v;
        });
        return best;
      }

      // ---------- price = (variant price + addons) x qty ----------
      function renderPrice() {
        var qty = currentQty(), add = addonTotal();
        var unitNow = cur.price + add;
        var unitOld = cur.mrp + add;
        var pct = cur.mrp > cur.price ? Math.round((cur.mrp - cur.price) / cur.mrp * 100) : 0;

        $(".price-now, .ds-price").text(money(unitNow * qty));
        $(".price-old").text(money(unitOld * qty)).toggle(pct > 0);
        $(".price-off, .ds-off").text(pct + "% OFF").toggle(pct > 0);
        $(".price-save").toggle(pct > 0).find("b").text(money((cur.mrp - cur.price) * qty));
      }

      // ---------- wishlist ----------
      var IS_CUSTOMER = @json((bool) auth('customer')->check());
      var WISH_URL = "{{ route('wishlist.toggle') }}";

      function setWish($b, on) {
        $b.toggleClass("is-active", on).attr("aria-pressed", on);
        $b.find("i").attr("class", (on ? "fa-solid" : "fa-regular") + " fa-heart");
        $b.find("span").text(on ? "Added to Wishlist" : "Add to Wishlist");
      }

      $(document).on("click", ".js-wish", function () {
        var $b = $(this);

        // guests: open the login popup (the page reloads after login)
        if (!IS_CUSTOMER) {
          $('[data-model=".login-pop"]').first().trigger("click");
          return;
        }
        if ($b.data("busy")) return;
        $b.data("busy", true);

        $.ajax({
          url: WISH_URL, method: "POST", data: { product_id: $b.data("product-id") },
          headers: { "X-CSRF-TOKEN": CSRF, Accept: "application/json" }
        })
          .done(function (res) {
            res = res || {};
            if (res.status === false || res.success === false) {
              return notify("error", "Wishlist", res.message || "Could not update wishlist.");
            }
            var on = res.added !== undefined ? !!res.added
              : res.wishlisted !== undefined ? !!res.wishlisted
                : res.in_wishlist !== undefined ? !!res.in_wishlist
                  : !$b.hasClass("is-active");
            setWish($b, on);
            if (res.count !== undefined) $(".wishlist-count").text(res.count);
            notify("success", on ? "Added to Wishlist" : "Removed from Wishlist", $b.closest(".detail-info").find("h1").text());
          })
          .fail(function (xhr) {
            if (xhr.status === 401 || xhr.status === 419) {
              $('[data-model=".login-pop"]').first().trigger("click");
              return;
            }
            var j = xhr.responseJSON || {};
            notify("error", "Wishlist", j.message || "Something went wrong. Please try again.");
          })
          .always(function () { $b.data("busy", false); });
      });

      // ---------- options -> price / stock / sku / images ----------
      function refresh() {
        var sel = selectedIds();
        var pv = pick("price", sel), sv = pick("stock", sel), kv = pick("sku", sel), iv = pick("image", sel);

        // price (variant part; addons + qty applied in renderPrice)
        cur.mrp = pv ? pv.mrp : PD.base.mrp;
        cur.price = pv ? pv.price : PD.base.price;

        // sku
        var sku = kv && kv.sku ? kv.sku : PD.base.sku;
        $(".sku-val").text(sku);

        // stock
        var stock = sv ? sv.stock : PD.base.stock, avail = sv ? sv.available : true;
        var state = !avail ? "na" : stock <= 0 ? "out" : stock <= 5 ? "low" : "in";
        var dispatch = PD.base.dispatch ? "Ready to ship, dispatched in " + PD.base.dispatch : "Ready to ship";
        var copy = {
          in: ["In Stock", dispatch],
          low: ["Only " + stock + " left", "Order soon"],
          out: ["Out of Stock", "Currently unavailable"],
          na: ["Not Available", "This combination is not offered"]
        }[state];
        var blocked = state === "out" || state === "na";

        $(".info-stock").removeClass("is-out is-low").addClass(blocked ? "is-out" : state === "low" ? "is-low" : "")
          .find("b").text(copy[0]).end().find("em").text(copy[1]);

        $(".act-btns .btn, .ds-actions > .btn")
          .toggleClass("is-disabled", blocked).attr("aria-disabled", blocked)
          .css({ pointerEvents: blocked ? "none" : "", opacity: blocked ? ".5" : "" })
          .filter("button").prop("disabled", blocked);

        maxQty = Math.max(minQty, Math.min(10, stock > 0 ? stock : minQty));
        if (currentQty() > maxQty) $(".qty-input").val(maxQty);

        renderPrice();
        setGallery(iv);
      }

      $(document).on("change", ".opt-card input", function () {
        var name = $(this).data("name") || $(this).next().text();
        $(this).closest(".opt-card").find(".opt-value").text(name);
        refresh();
      });

      // ---------- quantity ----------
      $(".qty-input").val(minQty);
      $(document).on("click", ".qty-plus, .qty-minus", function () {
        var v = parseInt($(this).siblings(".qty-input").val(), 10) || minQty;
        v = $(this).hasClass("qty-plus") ? Math.min(maxQty, v + 1) : Math.max(minQty, v - 1);
        $(".qty-input").val(v);   // keeps main + sticky bar in sync
        renderPrice();
      });

      // ---------- add to cart ----------
      var CART_ADD_URL = "{{ route('cart.add') }}";   // route name apne hisaab se badlo
      var CART_URL = "{{ url('cart') }}";
      var CSRF = "{{ csrf_token() }}";

      function notify(type, title, text) {
        if (typeof window.showToast === "function") return window.showToast(title, text, type); // agar common JS me ho
        var $t = $('<div class="cart-toast"></div>').text(title + (text ? " - " + text : "")).css({
          position: "fixed", right: "20px", bottom: "20px", zIndex: 99999, padding: "12px 18px",
          borderRadius: "8px", color: "#fff", background: type === "success" ? "#1f8a5b" : "#c0392b"
        }).appendTo("body");
        setTimeout(function () { $t.fadeOut(300, function () { $t.remove(); }); }, 2800);
      }

      function cartPayload(productId) {
        var sel = selectedIds();
        var data = {
          product_id: productId,
          quantity: currentQty(),
          selected_values: sel,
          addon_ids: $('.detail-info input[name="addons[]"]:checked').map(function () { return parseInt(this.value, 10); }).get()
        };
        ["price", "image", "stock", "sku"].forEach(function (type) {
          var v = pick(type, sel);
          if (v) data[type + "_variant_id"] = v.id;
        });
        return data;
      }

      function addToCart($btn, goToCart) {
        if ($btn.prop("disabled") || $btn.data("busy")) return;
        $btn.data("busy", true).addClass("is-loading");

        $.ajax({
          url: CART_ADD_URL,
          method: "POST",
          data: cartPayload($btn.data("product-id")),
          headers: { "X-CSRF-TOKEN": CSRF, "Accept": "application/json" }
        })
          .done(function (res) {
            if (!res.status) return notify("error", "Could not add", res.message);
            $(document).trigger("cart:updated", [res]);   // header count / mini cart is event se update karo
            if (goToCart) { window.location.href = CART_URL; return; }
            notify("success", "Added to Cart", $btn.data("name") + " has been added to your cart.");
          })
          .fail(function (xhr) {
            var j = xhr.responseJSON || {}, msg = j.message || "Something went wrong. Please try again.";
            if (j.errors) msg = Object.values(j.errors)[0][0];
            notify("error", "Could not add", msg);
          })
          .always(function () { $btn.data("busy", false).removeClass("is-loading"); });
      }

      $(document).on("click", ".js-add-cart", function () { addToCart($(this), false); });
      $(document).on("click", ".js-buy-now", function () { addToCart($(this), true); });

      // ---------- sticky buy bar ----------
      var bar = document.querySelector(".detail-sticky");
      var target = document.querySelector(".info-actions");
      if (bar && target) {
        new IntersectionObserver(function (e) {
          bar.classList.toggle("show", !e[0].isIntersecting && e[0].boundingClientRect.top < 0);
        }).observe(target);
      }

      // ---------- pincode check ----------
      $(".pin-form").on("submit", function (e) {
        e.preventDefault();
        var $form = $(this), $btn = $form.find("button"), $res = $(".pin-result"),
          pin = $.trim($form.find('[name="pincode"]').val());

        function show(ok, text) {
          $res.find("i").attr("class", "fa-solid " + (ok ? "fa-circle-check" : "fa-circle-xmark"));
          $res.css("color", ok ? "#1f8a5b" : "#c0392b");
          $res.find("span").text(text);
        }

        if (!/^\d{6}$/.test(pin)) return show(false, "Please enter a valid 6-digit pincode.");

        $btn.prop("disabled", true);
        $.getJSON($form.attr("action"), { pincode: pin })
          .done(function (d) {
            if (!d.status) return show(false, d.message);
            var text = "Delivering to " + [d.district, d.state].filter(Boolean).join(", ") + " (" + d.pincode + ").";
            if (d.eta_date) text += " Expected by " + d.eta_date + " (" + d.eta + ").";
            show(true, text);
          })
          .fail(function (xhr) {
            var err = xhr.responseJSON && xhr.responseJSON.errors;
            show(false, err ? err.pincode[0] : "Something went wrong. Please try again.");
          })
          .always(function () { $btn.prop("disabled", false); });
      });

      refresh(); // apply the default selection on load
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