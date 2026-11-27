@extends('layouts.app')

@section('title', 'Cart | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/cart/cart.css') }}" />
@endpush

@php
  use Illuminate\Support\Facades\Route as R;

  $items = $cart?->items ?? collect();
  $count = (int) $items->sum('quantity');
  $isEmpty = $items->isEmpty();

  // totals
  $itemsTotal = (float) $items->sum('total');
  $totalMrp = (float) $items->sum(function ($i) {
    $addon = (float) $i->addons->sum('price');
    return (((float) ($i->priceVariant->mrp ?? $i->product->mrp ?? 0)) + $addon) * $i->quantity;
  });
  $mrpDiscount = max(0, $totalMrp - $itemsTotal);
  $couponOff = (float) ($cart->discount ?? 0);
  $shipFee = (float) ($cart->shipping_charge ?? 0);
  $grand = (float) ($cart->grand_total ?? 0);
  $addonsTotal = (float) $items->sum(fn($i) => $i->addons->sum('price') * $i->quantity);
  $hasAddons = $items->contains(fn($i) => $i->addons->isNotEmpty());
  $saved = $mrpDiscount + $couponOff;

  $routeOr = fn($name, $arg = null) => R::has($name) ? ($arg === null ? route($name) : route($name, $arg)) : '';
  $productUrl = fn($p) => R::has('product.show') && $p?->slug ? route('product.show', $p->slug) : '#';

  $waDigits = preg_replace('/\D+/', '', (string) ($general->whatsapp ?? ''));
  if (strlen($waDigits) === 10) {
    $waDigits = '91' . $waDigits;
  }
  $waLink = $waDigits ? 'https://wa.me/' . $waDigits : null;

  $payMethods = [
    ['Visa', 'fa-brands fa-cc-visa'],
    ['Mastercard', 'fa-brands fa-cc-mastercard'],
    ['UPI and Wallets', 'fa-solid fa-mobile-screen-button'],
    ['Net Banking', 'fa-solid fa-building-columns'],
    ['Cash on Delivery', 'fa-solid fa-indian-rupee-sign'],
  ];

  $gstOn = \App\Services\Tax::enabled();
  $taxInclusive = \App\Services\Tax::inclusive();
@endphp

@section('content')
  @unless($isEmpty)
    <section class="cart-secA" id="cartPage" data-update-url="{{ $routeOr('cart.update-quantity') }}"
      data-remove-url="{{ $routeOr('cart.remove', '__ID__') }}" data-coupon-url="{{ $routeOr('cart.apply.coupon') }}"
      data-coupon-remove-url="{{ $routeOr('cart.remove.coupon') }}">
      <div class="container">
        <div class="cart-top">
          <ol class="cart-steps" aria-label="Checkout progress">
            <li class="step is-active" aria-current="step">
              <span class="step-icon"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
              <span class="step-label">Bag</span>
            </li>
            <li class="step">
              <span class="step-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
              <span class="step-label">Address</span>
            </li>
            <li class="step">
              <span class="step-icon"><i class="fa-solid fa-credit-card" aria-hidden="true"></i></span>
              <span class="step-label">Payment</span>
            </li>
          </ol>
          <span class="secure-tag"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> 100% Secure Checkout</span>
        </div>

        <div class="cart-head">
          <span class="eyebrow">Your Selection</span>
          <h1>My Bag</h1>
          <p>{{ $count }} {{ $count === 1 ? 'item' : 'items' }} · <b>₹{{ number_format($grand) }}</b></p>
        </div>

        <div class="cart-layout">
          <div class="cart-main">
            @if($freeShip)
              <div class="ship-progress {{ $freeShip['done'] ? 'is-done' : '' }}" style="--p: {{ $freeShip['percent'] }}%">
                <span class="ship-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                @if($freeShip['done'])
                  <p><b>Free shipping unlocked</b><span>Your order is above ₹{{ number_format($freeShip['threshold']) }}</span>
                  </p>
                @else
                  <p><b>Add ₹{{ number_format($freeShip['remaining']) }} more for free shipping</b><span>Free shipping above
                      ₹{{ number_format($freeShip['threshold']) }}</span></p>
                @endif
                <div class="ship-bar"><span></span></div>
              </div>
            @endif

            <ul class="cart-list">
              @foreach($items as $item)
                @php
                  $p = $item->product;
                  $addonUnit = (float) $item->addons->sum('price');
                  $unitNow = (float) $item->price + $addonUnit;
                  $mrp = (float) ($item->priceVariant->mrp ?? $p->mrp ?? 0);
                  $unitOld = $mrp + $addonUnit;
                  $off = $mrp > (float) $item->price ? (int) round(($mrp - $item->price) / $mrp * 100) : 0;
                  $stock = (int) ($item->stockVariant->stock ?? $p->stock ?? 0);
                  $cat = collect([$p?->brand?->name, $p?->subcategory?->name ?? $p?->category?->name])->filter()->implode(' · ');
                  $url = $productUrl($p);
                @endphp
                <li class="cart-item" data-item="{{ $item->id }}">
                  <a class="item-img" href="{{ $url }}">
                    <img src="{{ $item->display_image }}" alt="{{ $p->name ?? '' }}" width="150" height="188"
                      loading="lazy" />
                  </a>
                  <div class="item-info">
                    @if($cat)<span class="item-cat">{{ $cat }}</span>@endif
                    <h2 class="item-name"><a href="{{ $url }}">{{ $p->name ?? 'Product' }}</a></h2>

                    @if(!empty($item->selected_attributes))
                      <ul class="item-meta">
                        @foreach($item->selected_attributes as $a)
                          @continue(empty($a['attribute']) || empty($a['value']))
                          <li>
                            <span>{{ $a['attribute'] }}</span>
                            <b>@if(!empty($a['hex']))<i class="dot" style="--c: {{ $a['hex'] }}"></i> @endif{{ $a['value'] }}</b>
                          </li>
                        @endforeach
                      </ul>
                    @endif

                    <div class="item-price">
                      <strong>₹{{ number_format($unitNow) }}</strong>
                      @if($off)
                        <del>₹{{ number_format($unitOld) }}</del><span class="item-off">{{ $off }}% OFF</span>
                      @endif
                    </div>

                    @if($stock > 0 && $stock <= 5)
                      <p class="item-stock"><i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i> Only {{ $stock }}
                        {{ $stock === 1 ? 'piece' : 'pieces' }} left</p>
                    @endif

                    @foreach($item->addons as $ad)
                      <p class="item-extra">+ {{ $ad->detail }} ·
                        {{ $ad->price > 0 ? '₹' . number_format($ad->price) : 'Free' }}</p>
                    @endforeach

                    @if($p?->delivery_time)
                      <p class="item-delivery">
                        <i class="fa-solid fa-truck" aria-hidden="true"></i> Dispatched in <b>{{ $p->delivery_time }}</b>
                      </p>
                    @endif

                    <div class="item-actions">
                      <div class="cart-qty" role="group" aria-label="Quantity for {{ $p->name ?? 'item' }}">
                        <button type="button" class="qty-minus" data-id="{{ $item->id }}" aria-label="Decrease quantity"><i
                            class="fa-solid fa-minus" aria-hidden="true"></i></button>
                        <input type="text" class="qty-input" value="{{ $item->quantity }}" readonly aria-label="Quantity" />
                        <button type="button" class="qty-plus" data-id="{{ $item->id }}" aria-label="Increase quantity"><i
                            class="fa-solid fa-plus" aria-hidden="true"></i></button>
                      </div>
                      @if($general->wishlist)
                        <button type="button" class="item-link"><i class="fa-regular fa-heart" aria-hidden="true"></i> Move to
                          Wishlist</button>
                      @endif
                      <button type="button" class="item-link is-remove" data-id="{{ $item->id }}"><i
                          class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</button>
                    </div>
                  </div>
                  <div class="item-total">
                    <span>Item total</span>
                    <strong>₹{{ number_format($item->total) }}</strong>
                  </div>
                </li>
              @endforeach
            </ul>

            <a href="{{ url('products') }}" class="continue-link">
              <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i> Continue Shopping
            </a>
          </div>

          <aside class="cart-summary" aria-label="Order summary">
            <div class="sum-head">
              <h4>Order Summary</h4>
              <span>{{ $count }} {{ $count === 1 ? 'item' : 'items' }}</span>
            </div>

            <div class="box coupon-box">
              <h5><i class="fa-solid fa-ticket" aria-hidden="true"></i> Coupons &amp; Offers</h5>
              <form class="form coupon-form" action="#" method="post" novalidate>
                @csrf
                <div class="form-group">
                  <input type="text" id="couponInput" name="coupon" placeholder=" " autocomplete="off" />
                  <label for="couponInput">Enter coupon code</label>
                </div>
                <button type="submit" class="btn btn-outline-primary">Apply</button>
              </form>

              @if($cart->coupon_code)
                <div class="coupon-applied">
                  <span class="applied-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                  <div class="applied-text">
                    <strong>{{ $cart->coupon_code }} applied</strong>
                    <span>You saved ₹{{ number_format($couponOff) }} with this coupon</span>
                  </div>
                  <button type="button" class="applied-remove"
                    aria-label="Remove coupon {{ $cart->coupon_code }}">Remove</button>
                </div>
              @endif

              @if($offers->isNotEmpty())
                <p class="offers-title">Available Offers</p>
                <ul class="offer-list">
                  @foreach($offers as $o)
                    @php $applied = $cart->coupon_code === $o->code; @endphp
                    <li class="{{ $applied ? 'is-applied' : '' }}">
                      <span class="offer-icon"><i class="fa-solid {{ $applied ? 'fa-gift' : 'fa-ticket' }}"
                          aria-hidden="true"></i></span>
                      <div class="offer-text">
                        <span class="offer-code">{{ $o->code }}</span>
                        <p>{{ $o->offer_text }}</p>
                      </div>
                      @if($applied)
                        <span class="offer-state">Applied</span>
                      @else
                        <button type="button" class="offer-apply" data-code="{{ $o->code }}">Apply</button>
                      @endif
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>

            <div class="box delivery-box">
              <h5><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Delivery Details</h5>
              <form class="form pin-form" action="{{ $routeOr('pincode.check') }}" method="get" novalidate>
                <div class="form-group">
                  <input type="text" id="cartPin" name="pincode" inputmode="numeric" maxlength="6" placeholder=" " />
                  <label for="cartPin">Pincode</label>
                </div>
                <button type="submit" class="btn btn-outline-primary">Check</button>
              </form>
              <p class="pin-result" style="display:none">
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i> <span></span>
              </p>
              @if($general->cod_enabled)
                <ul class="del-points">
                  <li><i class="fa-solid fa-hand-holding-dollar" aria-hidden="true"></i> Cash on Delivery on selected pincodes
                  </li>
                </ul>
              @endif
            </div>

            <div class="box price-box">
              <h5>Price Details</h5>
              <dl class="rows">
                <div class="row">
                  <dt>Total MRP</dt>
                  <dd>₹{{ number_format($totalMrp) }}</dd>
                </div>
                @if($mrpDiscount > 0)
                  <div class="row is-green">
                    <dt>Discount on MRP</dt>
                    <dd>−₹{{ number_format($mrpDiscount) }}</dd>
                  </div>
                @endif
                @if($couponOff > 0)
                  <div class="row is-green">
                    <dt>Coupon ({{ $cart->coupon_code }})</dt>
                    <dd>−₹{{ number_format($couponOff) }}</dd>
                  </div>
                @endif
                @if($hasAddons)
                  <div class="row">
                    <dt>Gift Packaging</dt>
                    <dd class="{{ $addonsTotal > 0 ? '' : 'is-green' }}">
                      {{ $addonsTotal > 0 ? '₹' . number_format($addonsTotal) : 'Free' }}</dd>
                  </div>
                @endif
              
               @if($gstOn && $cart->tax_amount > 0)
  <div class="row">
    <dt>GST{{ $taxInclusive ? ' (included)' : '' }}</dt>
    <dd>₹{{ number_format($cart->tax_amount, 2) }}</dd>
  </div>
@endif

                <div class="row">
                  <dt>Shipping Fee</dt>
                  @if($shipFee > 0)
                    <dd>₹{{ number_format($shipFee) }}</dd>
                  @elseif($freeShip && $freeShip['done'])
                    <dd class="is-green">Free</dd>
                  @else
                    <dd>Calculated at checkout</dd>
                  @endif
                </div>
                <div class="row row-total">
                  <dt>Total Amount@if($gstOn)<small>{{ $taxInclusive ? 'Inclusive of all taxes' : 'Including GST' }}</small>@endif</dt>
                  <dd>₹{{ number_format($grand) }}</dd>
                </div>
              </dl>
              @if($saved > 0)
                <p class="save-chip"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving
                  ₹{{ number_format($saved) }} on this order</p>
              @endif
              <a href="{{ url('checkout') }}" class="btn btn-primary place-btn">
                Proceed to Address <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
              </a>
              <ul class="pay-methods" aria-label="Accepted payment methods">
                @foreach($payMethods as [$title, $icon])
                  <li title="{{ $title }}"><i class="{{ $icon }}" aria-hidden="true"></i><span
                      class="sr-only">{{ $title }}</span></li>
                @endforeach
              </ul>
            </div>

            @if($waLink)
              <a href="{{ $waLink }}" class="cart-help" target="_blank" rel="noopener">
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                <span>Need help? <b>Chat with our styling team</b></span>
                <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
              </a>
            @endif
          </aside>
        </div>

        <div class="cart-bar">
          <div class="bar-total">
            <span>Total</span>
            <strong>₹{{ number_format($grand) }}</strong>
          </div>
          <a href="{{ url('checkout') }}" class="btn btn-primary">
            Proceed to Address <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
  @endunless

  <div class="cart-empty" @if(!$isEmpty) hidden @endif>
    <span class="empty-ico"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
    <h2>Your bag is empty</h2>
    <p>Looks like you have not added anything yet. Explore our latest jewellery, bedding and handcrafted home décor.</p>
    <div class="empty-btns">
      <a href="{{ url('products') }}" class="btn btn-primary">Shop Jewellery</a>
      <a href="javascript:void(0)" class="btn btn-outline-primary">Shop Home &amp; Living</a>
    </div>
    <ul class="empty-links">
      <li><a href="javascript:void(0)">Necklace Sets</a></li>
      <li><a href="javascript:void(0)">Earrings</a></li>
      <li><a href="javascript:void(0)">Bedding</a></li>
      <li><a href="javascript:void(0)">Home Decor</a></li>
    </ul>
  </div>
@endsection

@push('scripts')
  <script>
    $(function () {
      var $pg = $("#cartPage");
      if (!$pg.length) return;
      var CSRF = $('meta[name="csrf-token"]').attr("content");
      var H = { "X-CSRF-TOKEN": CSRF, Accept: "application/json" };

      function fail(xhr) {
        var j = xhr.responseJSON || {}, msg = j.message || "Something went wrong. Please try again.";
        if (j.errors) msg = Object.values(j.errors)[0][0];
        alert(msg);
      }
      function done() { window.location.reload(); } // totals, shipping and coupon rows all depend on each other

      // qty
      $pg.on("click", ".qty-plus, .qty-minus", function (e) {
        e.stopImmediatePropagation();
        var $b = $(this);
        if ($b.data("busy")) return;
        $b.data("busy", true);
        $.ajax({
          url: $pg.data("update-url"), method: "POST", headers: H,
          data: { item_id: $b.data("id"), action: $b.hasClass("qty-plus") ? "plus" : "minus" }
        })
          .done(done).fail(fail).always(function () { $b.data("busy", false); });
      });

      // remove (use "POST" if your route is POST)
      $pg.on("click", ".item-link.is-remove", function () {
        var $b = $(this);
        if ($b.data("busy")) return;
        $b.data("busy", true);
        $.ajax({ url: String($pg.data("remove-url")).replace("__ID__", $b.data("id")), method: "DELETE", headers: H })
          .done(done).fail(fail).always(function () { $b.data("busy", false); });
      });

      // coupon
      function applyCoupon(code) {
        $.ajax({ url: $pg.data("coupon-url"), method: "POST", headers: H, data: { coupon_code: code } })
          .done(function (res) { if (!res.status) return alert(res.message); done(); })
          .fail(fail);
      }
      $pg.on("submit", ".coupon-form", function (e) {
        e.preventDefault();
        var code = $.trim($("#couponInput").val());
        if (code) applyCoupon(code);
      });
      $pg.on("click", ".offer-apply", function () { applyCoupon($(this).data("code")); });
      $pg.on("click", ".applied-remove", function () {
        $.ajax({ url: $pg.data("coupon-remove-url"), method: "POST", headers: H }).done(done).fail(fail);
      });

      // pincode
      $pg.on("submit", ".pin-form", function (e) {
        e.preventDefault();
        var $f = $(this), pin = $.trim($f.find('[name="pincode"]').val()), $res = $(".pin-result");
        function show(ok, text) {
          $res.show().css("color", ok ? "#1f8a5b" : "#c0392b");
          $res.find("i").attr("class", "fa-solid " + (ok ? "fa-circle-check" : "fa-circle-xmark"));
          $res.find("span").text(text);
        }
        if (!/^\d{6}$/.test(pin)) return show(false, "Please enter a valid 6-digit pincode.");
        $.getJSON($f.attr("action"), { pincode: pin })
          .done(function (d) {
            if (!d.status) return show(false, d.message);
            var t = "Delivery available to " + [d.district, d.state].filter(Boolean).join(", ") + ".";
            if (d.eta_date) t += " Estimated by " + d.eta_date + ".";
            show(true, t);
          })
          .fail(function () { show(false, "Something went wrong. Please try again."); });
      });
    });
  </script>
@endpush