@extends('layouts.app')

@section('title', 'Payment | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/sass/payment/payment.css') }}" />
@endpush

@section('content')
  <section class="payment-secA">
    <div class="container">
      <div class="pay-top">
        <ol class="pay-steps" aria-label="Checkout progress">
          <li class="step is-done">
            <a href="{{ url('cart') }}" class="step-link">
              <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
              <span class="step-label">Bag</span>
            </a>
          </li>
          <li class="step is-done">
            <a href="{{ url('checkout') }}" class="step-link">
              <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
              <span class="step-label">Address</span>
            </a>
          </li>
          <li class="step is-active" aria-current="step">
            <span class="step-icon"><i class="fa-solid fa-credit-card" aria-hidden="true"></i></span>
            <span class="step-label">Payment</span>
          </li>
        </ol>
        <span class="secure-tag">
          <i class="fa-solid fa-shield-halved" aria-hidden="true"></i> 100% Secure Checkout
        </span>
      </div>

      <div class="pay-head">
        <span class="eyebrow">Final Step</span>
        <h1>Payment</h1>
        <a href="{{ url('checkout') }}" class="back-link">
          <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i> Back to address
        </a>
      </div>

      <div class="pay-alert" role="alert" hidden>
        <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
        <p>
          <strong>Payment failed.</strong> Your payment of ₹11,896 could not be completed. Please try again.
        </p>
        <a href="#pmTabs" class="alert-link">Try again</a>
      </div>

      <form class="pay-layout form" id="payForm" action="{{ url('checkout/payment/confirm') }}" method="post"
        novalidate>
        @csrf

        <div class="pay-card">
          <div class="pay-sec ship-to">
            <span class="ship-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
            <p class="ship-text">
              <strong>Deliver to Ananya Kapoor, 122011</strong>
              <small>B-204, Sunrise Apartments, Sector 56, Golf Course Road, Gurugram · Arrives by Fri, 27 Nov</small>
            </p>
            <a href="{{ url('checkout') }}" class="ship-change">Change</a>
          </div>

          <div class="pay-sec pm">
            <h2 class="sec-label">Choose how to pay</h2>
            <p class="sec-note">Select one option. Your order is confirmed right after.</p>
            <input type="radio" name="payment" id="pmOnline" class="pm-radio" value="online" checked />
            <input type="radio" name="payment" id="pmCod" class="pm-radio" value="cod" />
            <div class="pm-tabs" id="pmTabs" role="radiogroup" aria-label="Choose a payment method">
              <label for="pmOnline" class="pm-tab">
                <span class="pm-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span>
                <span class="pm-text">
                  <strong>Pay Online</strong>
                  <small>UPI, Cards, Net Banking</small>
                </span>
                <span class="radio-dot" aria-hidden="true"></span>
                <span class="pm-badge">Instant confirmation</span>
              </label>
              <label for="pmCod" class="pm-tab">
                <span class="pm-icon"><i class="fa-solid fa-indian-rupee-sign" aria-hidden="true"></i></span>
                <span class="pm-text">
                  <strong>Cash on Delivery</strong>
                  <small>Pay when your order arrives</small>
                </span>
                <span class="radio-dot" aria-hidden="true"></span>
                <span class="pm-badge">Pay at the door</span>
              </label>
            </div>
            <p class="pm-info pm-online">
              <i class="fa-solid fa-lock" aria-hidden="true"></i>
              <span>
                You will pay on our secure page. We never store your card or bank details.
                <span class="pm-chips"><em>UPI</em><em>Visa</em><em>Mastercard</em><em>Net Banking</em></span>
              </span>
            </p>
            <p class="pm-info pm-cod">
              <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
              <span>
                Cash on Delivery is available for PIN 122011. Please keep the exact amount ready for our delivery
                partner.
              </span>
            </p>
          </div>

          <div class="pay-sec bill">
            <h2 class="sec-label">Billing address</h2>
            <label class="check">
              <input type="checkbox" id="billSame" name="billing_same" checked />
              <span>My billing address is the same as my delivery address</span>
            </label>
            <div class="bill-form">
              <div class="fields">
                <div class="form-group s-12">
                  <input type="text" id="bName" name="bill_name" placeholder=" " autocomplete="billing name" />
                  <label for="bName">Full name</label>
                </div>
                <div class="form-group s-5">
                  <input type="text" id="bHouse" name="bill_house" placeholder=" "
                    autocomplete="billing address-line1" />
                  <label for="bHouse">House / Flat no.</label>
                </div>
                <div class="form-group s-7">
                  <input type="text" id="bStreet" name="bill_street" placeholder=" "
                    autocomplete="billing address-line2" />
                  <label for="bStreet">Street / Area / Locality</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bPin" name="bill_pin" placeholder=" " inputmode="numeric" maxlength="6"
                    autocomplete="billing postal-code" />
                  <label for="bPin">PIN code</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bCity" name="bill_city" placeholder=" "
                    autocomplete="billing address-level2" />
                  <label for="bCity">City</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bState" name="bill_state" placeholder=" " list="stateList"
                    autocomplete="billing address-level1" />
                  <label for="bState">State</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <aside class="pay-summary" aria-label="Order summary">
          <div class="box">
            <div class="mini-row">
              <p class="mini-text">
                <strong>Order Summary</strong>
                <small>4 items in your bag</small>
              </p>
              <a href="{{ url('cart') }}" class="mini-edit">Edit bag</a>
            </div>

            <ul class="mini-list">
              <li>
                <span class="mini-img">
                  <img src="{{ asset('assets/images/home/pro2.png') }}"
                    alt="Royal Radiance Premium Bridal Necklace Set" width="58" height="77" loading="lazy" />
                  <b>1</b>
                </span>
                <span class="mini-text">
                  <strong>Royal Radiance – Premium Bridal Necklace Set</strong>
                  <small>Antique Gold-tone · Crystal White</small>
                </span>
                <span class="mini-price">₹7,500</span>
              </li>
              <li>
                <span class="mini-img">
                  <img src="{{ asset('assets/images/home/pro4.png') }}" alt="Pearl Drop Earrings" width="58"
                    height="77" loading="lazy" />
                  <b>2</b>
                </span>
                <span class="mini-text">
                  <strong>Pearl Drop Earrings</strong>
                  <small>Gold-tone · Free Size</small>
                </span>
                <span class="mini-price">₹1,498</span>
              </li>
              <li>
                <span class="mini-img">
                  <img src="{{ asset('assets/images/home/pro1.png') }}" alt="Handloom Cotton Bedsheet Set"
                    width="58" height="77" loading="lazy" />
                  <b>1</b>
                </span>
                <span class="mini-text">
                  <strong>Handloom Cotton Bedsheet Set</strong>
                  <small>Ivory · Double</small>
                </span>
                <span class="mini-price">₹2,499</span>
              </li>
              <li>
                <span class="mini-img">
                  <img src="{{ asset('assets/images/home/pro3.png') }}" alt="Brass Diya Gift Set" width="58"
                    height="77" loading="lazy" />
                  <b>1</b>
                </span>
                <span class="mini-text">
                  <strong>Brass Diya Gift Set</strong>
                  <small>Hand-finished Brass · Gift Ready</small>
                </span>
                <span class="mini-price">₹899</span>
              </li>
            </ul>

            <dl class="rows">
              <div class="row">
                <dt>Total MRP</dt>
                <dd>₹16,495</dd>
              </div>
              <div class="row is-green">
                <dt>Discount on MRP</dt>
                <dd>−₹4,099</dd>
              </div>
              <div class="row is-green">
                <dt>Coupon (PIHUSPECIAL)</dt>
                <dd>−₹500</dd>
              </div>
              <div class="row">
                <dt>Gift Packaging</dt>
                <dd class="is-green">Free</dd>
              </div>
              <div class="row">
                <dt>Shipping Fee</dt>
                <dd class="is-green"><del>₹99</del> Free</dd>
              </div>
              <div class="row row-total">
                <dt>Amount Payable<small>Inclusive of all taxes</small></dt>
                <dd>₹11,896</dd>
              </div>
            </dl>

            <p class="save-chip">
              <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving ₹4,599 on this order
            </p>

            <a href="{{ url('order-confirmed') }}" class="btn btn-primary place-btn pay-btn">
              <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay ₹11,896 Securely
            </a>
            <button type="submit" class="btn btn-primary place-btn cod-btn">
              Place Order <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </button>
            <p class="terms-note">
              By continuing, you agree to our
              <a href="{{ url('terms-conditions') }}">Terms</a> and
              <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </p>
          </div>

          <ul class="trust-list">
            <li><i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i> 7-day returns</li>
            <li><i class="fa-solid fa-gift" aria-hidden="true"></i> Gift ready</li>
            <li><i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Tracked delivery</li>
          </ul>
        </aside>

        <datalist id="stateList">
          @foreach (['Andhra Pradesh', 'Delhi', 'Gujarat', 'Haryana', 'Karnataka', 'Kerala', 'Maharashtra', 'Punjab', 'Rajasthan', 'Tamil Nadu', 'Telangana', 'Uttar Pradesh', 'West Bengal'] as $state)
            <option value="{{ $state }}"></option>
          @endforeach
        </datalist>
      </form>

      <div class="pay-bar">
        <div class="bar-total">
          <span>Amount Payable</span>
          <strong>₹11,896</strong>
        </div>
        <a href="{{ url('order-confirmed') }}" class="btn btn-primary bar-pay">
          <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay Securely
        </a>
        <button type="submit" form="payForm" class="btn btn-primary bar-cod">
          Place Order <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
@endpush