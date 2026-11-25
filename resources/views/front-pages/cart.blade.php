@extends('layouts.app')

@section('title', 'Cart | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/cart/cart.css') }}" />
@endpush

@php
  // [img, name, category, meta[[label, value, dotColor|null]], price, old, off, stockNote|null, extraNote|null, delivery, qty, itemTotal]
  $cartRows = [
    ['pro2.png', 'Royal Radiance – Premium Bridal Necklace Set', 'Pihu Jewel · Necklace Sets',
      [['Finish', 'Antique Gold-tone', '#b08d3c'], ['Stones', 'Crystal White', '#f4f8ff'], ['Size', 'Free Size', null], ['Includes', 'Earrings, Maang Tikka', null]],
      '₹7,500', '₹9,999', '25% OFF', 'Only 3 pieces left in Antique Gold-tone', null, 'Wed, 25 Nov', 1, '₹7,500'],
    ['pro4.png', 'Pearl Drop Earrings', 'Pihu Jewel · Earrings',
      [['Finish', 'Gold-tone', '#d9b24c'], ['Size', 'Free Size', null], ['Wear', 'Daily & Festive', null]],
      '₹749', '₹999', '25% OFF', null, null, 'Wed, 25 Nov', 2, '₹1,498'],
    ['pro1.png', 'Handloom Cotton Bedsheet Set', 'Grih Shree · Handloom & Bedding',
      [['Colour', 'Ivory', '#f3ecd9'], ['Size', 'Double', null], ['Fabric', 'Pure Cotton', null], ['Includes', '2 Pillow Covers', null]],
      '₹2,499', '₹3,299', '24% OFF', null, null, 'Fri, 27 Nov', 1, '₹2,499'],
    ['pro3.png', 'Brass Diya Gift Set', 'Grih Shree · Home Decor',
      [['Finish', 'Hand-finished Brass', '#b08d3c'], ['Set', '4 Diyas', null], ['Gift', 'Gift Ready', null]],
      '₹899', '₹1,199', '25% OFF', null, '+ Gift box and message card · Free', 'Fri, 27 Nov', 1, '₹899'],
  ];

  $payMethods = [
    ['Visa', 'fa-brands fa-cc-visa'],
    ['Mastercard', 'fa-brands fa-cc-mastercard'],
    ['UPI and Wallets', 'fa-solid fa-mobile-screen-button'],
    ['Net Banking', 'fa-solid fa-building-columns'],
    ['Cash on Delivery', 'fa-solid fa-indian-rupee-sign'],
  ];
@endphp

@section('content')
  <section class="cart-secA">
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
        <p>4 items · <b>₹11,896</b></p>
      </div>

      <div class="cart-layout">
        <div class="cart-main">
          <div class="ship-progress is-done" style="--p: 100%">
            <span class="ship-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
            <p><b>Free shipping unlocked</b><span>Your order is above ₹2,999</span></p>
            <em>₹99 saved</em>
            <div class="ship-bar"><span></span></div>
          </div>

          <ul class="cart-list">
            @foreach($cartRows as [$img, $name, $cat, $meta, $price, $old, $off, $stock, $extra, $delivery, $qty, $total])
              <li class="cart-item">
                <a class="item-img" href="{{ url('product-detail') }}">
                  <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $name }}" width="150" height="188" loading="lazy" />
                </a>
                <div class="item-info">
                  <span class="item-cat">{{ $cat }}</span>
                  <h2 class="item-name"><a href="{{ url('product-detail') }}">{{ $name }}</a></h2>
                  <ul class="item-meta">
                    @foreach($meta as [$label, $value, $dot])
                      <li>
                        <span>{{ $label }}</span>
                        <b>@if($dot)<i class="dot" style="--c: {{ $dot }}"></i> @endif{{ $value }}</b>
                      </li>
                    @endforeach
                  </ul>
                  <div class="item-price">
                    <strong>{{ $price }}</strong><del>{{ $old }}</del><span class="item-off">{{ $off }}</span>
                  </div>
                  @if($stock)
                    <p class="item-stock"><i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i> {{ $stock }}</p>
                  @endif
                  @if($extra)
                    <p class="item-extra">{{ $extra }}</p>
                  @endif
                  <p class="item-delivery">
                    <i class="fa-solid fa-truck" aria-hidden="true"></i> Delivery by <b>{{ $delivery }}</b>
                  </p>
                  <div class="item-actions">
                    <div class="cart-qty" role="group" aria-label="Quantity for {{ $name }}">
                      <button type="button" class="qty-minus" aria-label="Decrease quantity"><i class="fa-solid fa-minus" aria-hidden="true"></i></button>
                      <input type="text" class="qty-input" value="{{ $qty }}" readonly aria-label="Quantity" />
                      <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus" aria-hidden="true"></i></button>
                    </div>
                    <button type="button" class="item-link"><i class="fa-regular fa-heart" aria-hidden="true"></i> Move to Wishlist</button>
                    <button type="button" class="item-link is-remove"><i class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</button>
                  </div>
                </div>
                <div class="item-total">
                  <span>Item total</span>
                  <strong>{{ $total }}</strong>
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
            <span>4 items</span>
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

            <div class="coupon-applied">
              <span class="applied-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
              <div class="applied-text">
                <strong>PIHUSPECIAL applied</strong>
                <span>You saved ₹500 with this coupon</span>
              </div>
              <button type="button" class="applied-remove" aria-label="Remove coupon PIHUSPECIAL">Remove</button>
            </div>

            <p class="offers-title">Available Offers</p>
            <ul class="offer-list">
              <li class="is-applied">
                <span class="offer-icon"><i class="fa-solid fa-gift" aria-hidden="true"></i></span>
                <div class="offer-text">
                  <span class="offer-code">PIHUSPECIAL</span>
                  <p>Flat ₹500 off on orders above ₹9,999</p>
                </div>
                <span class="offer-state">Applied</span>
              </li>
              <li>
                <span class="offer-icon"><i class="fa-solid fa-ticket" aria-hidden="true"></i></span>
                <div class="offer-text">
                  <span class="offer-code">GRIHHOME</span>
                  <p>Extra savings on selected home &amp; living pieces</p>
                </div>
                <button type="button" class="offer-apply" data-code="GRIHHOME">Apply</button>
              </li>
            </ul>
          </div>

          <div class="box delivery-box">
            <h5><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Delivery Details</h5>
            <form class="form pin-form" action="#" method="post" novalidate>
              @csrf
              <div class="form-group">
                <input type="text" id="cartPin" name="pincode" inputmode="numeric" maxlength="6" placeholder=" " value="110001" />
                <label for="cartPin">Pincode</label>
              </div>
              <button type="submit" class="btn btn-outline-primary">Check</button>
            </form>
            <p class="pin-result">
              <i class="fa-solid fa-circle-check" aria-hidden="true"></i> Delivery available. Estimated by <b>Fri, 27 Nov</b>.
            </p>
            <ul class="del-points">
              <li><i class="fa-solid fa-box" aria-hidden="true"></i> Ready to ship, dispatched within 48 hours</li>
              <li><i class="fa-solid fa-hand-holding-dollar" aria-hidden="true"></i> Cash on Delivery on selected pincodes</li>
              <li><i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i> Easy 7-day return and exchange</li>
            </ul>
          </div>

          <div class="box price-box">
            <h5>Price Details</h5>
            <dl class="rows">
              <div class="row"><dt>Total MRP</dt><dd>₹16,495</dd></div>
              <div class="row is-green"><dt>Discount on MRP</dt><dd>−₹4,099</dd></div>
              <div class="row is-green"><dt>Coupon (PIHUSPECIAL)</dt><dd>−₹500</dd></div>
              <div class="row"><dt>Gift Packaging</dt><dd class="is-green">Free</dd></div>
              <div class="row"><dt>Shipping Fee</dt><dd class="is-green"><del>₹99</del> Free</dd></div>
              <div class="row row-total">
                <dt>Total Amount<small>Inclusive of all taxes</small></dt>
                <dd>₹11,896</dd>
              </div>
            </dl>
            <p class="save-chip"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving ₹4,599 on this order</p>
            <a href="{{ url('checkout') }}" class="btn btn-primary place-btn">
              Proceed to Address <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
            <ul class="pay-methods" aria-label="Accepted payment methods">
              @foreach($payMethods as [$title, $icon])
                <li title="{{ $title }}"><i class="{{ $icon }}" aria-hidden="true"></i><span class="sr-only">{{ $title }}</span></li>
              @endforeach
            </ul>
          </div>

          <a href="javascript:void(0)" class="cart-help">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            <span>Need help? <b>Chat with our styling team</b></span>
            <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
          </a>
        </aside>
      </div>

      <div class="cart-bar">
        <div class="bar-total">
          <span>Total</span>
          <strong>₹11,896</strong>
        </div>
        <a href="{{ url('checkout') }}" class="btn btn-primary">
          Proceed to Address <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>

  <div class="cart-empty" hidden>
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