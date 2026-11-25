@extends('layouts.app')

@section('title', 'Checkout | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/checkout/checkout.css') }}" />
@endpush

@php
  // replace with the logged-in user's addresses / cart later
  $addresses = [
    ['n' => 1, 'icon' => 'fa-house', 'tag' => 'Home', 'default' => true, 'checked' => true,
      'lines' => ['B-204, Sunrise Apartments, Sector 56, Golf Course Road', 'Gurugram, Haryana - 122011'],
      'v' => ['name' => 'Ananya Kapoor', 'phone' => '9811122334', 'pin' => '122011', 'city' => 'Gurugram', 'state' => 'Haryana', 'house' => 'B-204', 'street' => 'Sunrise Apartments, Sector 56', 'landmark' => 'Golf Course Road', 'type' => 'home']],
    ['n' => 2, 'icon' => 'fa-briefcase', 'tag' => 'Work', 'default' => false, 'checked' => false,
      'lines' => ['Tower C, 7th Floor, Sector 62, Near Metro Station', 'Noida, Uttar Pradesh - 201301'],
      'v' => ['name' => 'Ananya Kapoor', 'phone' => '9811122334', 'pin' => '201301', 'city' => 'Noida', 'state' => 'Uttar Pradesh', 'house' => 'Tower C, 7th Floor', 'street' => 'Sector 62', 'landmark' => 'Near Metro Station', 'type' => 'work']],
  ];

  $methods = [
    ['standard', true, 'Fri', '27', 'Nov', 'Standard Delivery', '3–7 working days · Tracked', 'Free', true],
    ['express', false, 'Mon', '23', 'Nov', 'Priority Delivery', 'Faster dispatch · Tracked', '₹99', false],
  ];

  $miniItems = [
    ['pro2.png', 1, 'Royal Radiance – Premium Bridal Necklace Set', 'Antique Gold-tone · Crystal White', '₹7,500'],
    ['pro4.png', 2, 'Pearl Drop Earrings', 'Gold-tone · Free Size', '₹1,498'],
    ['pro1.png', 1, 'Handloom Cotton Bedsheet Set', 'Ivory · Double', '₹2,499'],
    ['pro3.png', 1, 'Brass Diya Gift Set', 'Hand-finished Brass · Gift Ready', '₹899'],
  ];

  $states = ['Andhra Pradesh', 'Delhi', 'Gujarat', 'Haryana', 'Karnataka', 'Kerala', 'Maharashtra', 'Punjab', 'Rajasthan', 'Tamil Nadu', 'Telangana', 'Uttar Pradesh', 'West Bengal'];
@endphp

@section('content')
  <section class="checkout-secA">
    <div class="container">
      <div class="co-top">
        <ol class="co-steps" aria-label="Checkout progress">
          <li class="step is-done">
            <a href="{{ url('cart') }}" class="step-link">
              <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
              <span class="step-label">Bag</span>
            </a>
          </li>
          <li class="step is-active" aria-current="step">
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

      <div class="co-head">
        <span class="eyebrow">Almost There</span>
        <h1>Delivery Details</h1>
        <a href="{{ url('cart') }}" class="back-link"><i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i> Back to bag</a>
      </div>

      <form class="co-layout form" action="{{ url('checkout/payment') }}" method="post" novalidate>
        @csrf
        <div class="co-main">
          {{-- 1 : DETAILS --}}
          <section class="co-block">
            <div class="co-row">
              <h2 class="co-title"><span class="num">1</span> Your details</h2>
              <p class="co-aside">Already a member? <a href="{{ url('login') }}?next=/checkout">Sign in</a></p>
            </div>
            <div class="fields">
              <div class="form-group s-6">
                <input type="email" id="cEmail" name="email" placeholder=" " autocomplete="email" />
                <label for="cEmail">Email address</label>
              </div>
              <div class="form-group has-prefix s-6">
                <span class="prefix">+91</span>
                <input type="tel" id="cPhone" name="phone" placeholder=" " inputmode="numeric" maxlength="10" autocomplete="tel-national" />
                <label for="cPhone">Mobile number</label>
              </div>
            </div>
            <label class="check">
              <input type="checkbox" name="updates" checked />
              <span>Send my order updates on WhatsApp and email</span>
            </label>
          </section>

          {{-- 2 : ADDRESS --}}
          <section class="co-block">
            <div class="co-row">
              <h2 class="co-title"><span class="num">2</span> Where should we send it?</h2>
              <p class="co-aside">{{ count($addresses) }} saved addresses</p>
            </div>

            <div class="addr-list" role="radiogroup" aria-label="Choose a delivery address">
              @foreach($addresses as $a)
                <div class="addr-card">
                  <input type="radio" name="address" id="addr{{ $a['n'] }}" class="addr-radio" value="{{ $a['n'] }}" {{ $a['checked'] ? 'checked' : '' }} />
                  <label for="addr{{ $a['n'] }}" class="addr-body">
                    <span class="addr-ico" aria-hidden="true"><i class="fa-solid {{ $a['icon'] }}"></i></span>
                    <span class="addr-info">
                      <span class="addr-top">
                        <strong>{{ $a['v']['name'] }}</strong>
                        <span class="tag">{{ $a['tag'] }}</span>
                        @if($a['default'])<span class="tag tag-default">Default</span>@endif
                      </span>
                      @foreach($a['lines'] as $line)<span class="addr-line">{{ $line }}</span>@endforeach
                      <span class="addr-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91 {{ substr($a['v']['phone'], 0, 5) }} {{ substr($a['v']['phone'], 5) }}</span>
                    </span>
                    <span class="radio-dot" aria-hidden="true"></span>
                  </label>

                  <input type="checkbox" id="edit{{ $a['n'] }}" class="edit-toggle" />
                  <label for="edit{{ $a['n'] }}" class="addr-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit address</label>

                  <div class="addr-form">
                    <h3>Edit address</h3>
                    @include('partials.address-fields', ['idp' => 'a' . $a['n'], 'px' => 'a' . $a['n'] . '_', 'v' => $a['v']])
                    <label class="check">
                      <input type="checkbox" name="a{{ $a['n'] }}_default" {{ $a['default'] ? 'checked' : '' }} />
                      <span>Keep this as my default address</span>
                    </label>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary" formaction="{{ url('checkout/address/save') }}">Save address</button>
                      <label for="edit{{ $a['n'] }}" class="btn btn-outline-primary">Cancel</label>
                    </div>
                  </div>
                </div>
              @endforeach

              <div class="addr-card addr-new">
                <input type="radio" name="address" id="addrNew" class="addr-radio" value="new" />
                <label for="addrNew" class="addr-body">
                  <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-plus"></i></span>
                  <span class="addr-info">
                    <span class="addr-top"><strong>Deliver to a new address</strong></span>
                    <span class="addr-line">Add a different name, phone number or location for this order.</span>
                  </span>
                  <span class="radio-dot" aria-hidden="true"></span>
                </label>

                <div class="addr-form">
                  @include('partials.address-fields', ['idp' => 'n', 'px' => 'new_'])
                  <label class="check">
                    <input type="checkbox" name="new_default" />
                    <span>Save this address for next time</span>
                  </label>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary" formaction="{{ url('checkout/address/save') }}">Save &amp; deliver here</button>
                    <label for="addr1" class="btn btn-outline-primary">Cancel</label>
                  </div>
                </div>
              </div>
            </div>
          </section>

          {{-- 3 : DELIVERY METHOD --}}
          <section class="co-block">
            <div class="co-row">
              <h2 class="co-title"><span class="num">3</span> How soon do you need it?</h2>
              <p class="co-aside">Ready to ship, dispatched within 48 hours</p>
            </div>

            <div class="method-list" role="radiogroup" aria-label="Choose a delivery method">
              @foreach($methods as [$value, $checked, $day, $date, $month, $title, $sub, $price, $free])
                <label class="method">
                  <input type="radio" name="delivery" value="{{ $value }}" {{ $checked ? 'checked' : '' }} />
                  <span class="method-body">
                    <span class="method-date" aria-hidden="true"><small>{{ $day }}</small><b>{{ $date }}</b><em>{{ $month }}</em></span>
                    <span class="method-text">
                      <strong>{{ $title }}</strong>
                      <small>{{ $sub }}</small>
                      <span class="method-price {{ $free ? 'is-free' : '' }}">{{ $price }}</span>
                    </span>
                    <span class="radio-dot" aria-hidden="true"></span>
                  </span>
                </label>
              @endforeach
            </div>
          </section>
        </div>

        {{-- SUMMARY --}}
        <aside class="co-summary" aria-label="Order summary">
          <div class="sum-head">
            <h4>Order Summary</h4>
            <a href="{{ url('cart') }}">Edit bag</a>
          </div>

          <div class="box price-box">
            <div class="box-head"><h5>In your bag <span>(4 items)</span></h5></div>

            <ul class="mini-list">
              @foreach($miniItems as [$img, $qty, $name, $variant, $price])
                <li>
                  <span class="mini-img">
                    <img src="{{ asset('assets/images/home/' . $img) }}" alt="" width="56" height="75" loading="lazy" />
                    <b>{{ $qty }}</b>
                  </span>
                  <span class="mini-text"><strong>{{ $name }}</strong><small>{{ $variant }}</small></span>
                  <span class="mini-price">{{ $price }}</span>
                </li>
              @endforeach
            </ul>

            <dl class="rows">
              <div class="row"><dt>Total MRP</dt><dd>₹16,495</dd></div>
              <div class="row is-green"><dt>Discount on MRP</dt><dd>−₹4,099</dd></div>
              <div class="row is-green"><dt>Coupon (PIHUSPECIAL)</dt><dd>−₹500</dd></div>
              <div class="row"><dt>Gift Packaging</dt><dd class="is-green">Free</dd></div>
              <div class="row"><dt>Shipping Fee</dt><dd class="is-green"><del>₹99</del> Free</dd></div>
              <div class="row row-total"><dt>Total Amount<small>Inclusive of all taxes</small></dt><dd>₹11,896</dd></div>
            </dl>

            <p class="save-chip"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving ₹4,599 on this order</p>

            <a href="{{ url('payment') }}" class="btn btn-primary place-btn">
              Continue to Payment <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
            <p class="terms-note">By continuing, you agree to our <a href="{{ url('terms-conditions') }}">Terms</a> and <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.</p>
          </div>

          <a href="javascript:void(0)" class="co-help">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            <span>Need help? <b>Chat with our styling team</b></span>
            <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
          </a>
        </aside>

        <datalist id="stateList">
          @foreach($states as $state)<option value="{{ $state }}"></option>@endforeach
        </datalist>
      </form>

      <div class="co-bar">
        <div class="bar-total"><span>Total</span><strong>₹11,896</strong></div>
        <a href="{{ url('payment') }}" class="btn btn-primary">
          Continue to Payment <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>
@endsection