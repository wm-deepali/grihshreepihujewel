@extends('layouts.app')

@section('title', 'Thank You for Your Order | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')
  <section class="thanks-secA">
    <div class="container">
      <div class="tk-ticket">
        <div class="tk-main">
          <div class="tk-top">
            <span class="tk-icon">
              <svg viewBox="0 0 52 52" aria-hidden="true">
                <circle class="ring" cx="26" cy="26" r="24" fill="none" />
                <path class="tick" fill="none" d="M15 27l7.5 7.5L37 19" />
              </svg>
            </span>
            <span class="tk-status">Order Confirmed</span>
          </div>
          <h1>Thank you, Ananya</h1>
          <p class="tk-msg">
            Your order is placed and a confirmation is on its way to your email. We will pack your jewellery and
            home pieces with care.
          </p>
          <ul class="tk-meta">
            <li><span>Order ID</span><strong>#PJG-20481</strong></li>
            <li><span>Date</span><strong>19 Nov 2026</strong></li>
            <li><span>Payment</span><strong>Paid Online</strong></li>
            <li><span>Delivery by</span><strong>Fri, 27 Nov</strong></li>
          </ul>
          <p class="tk-ship">
            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
            <span><b>Delivering to Ananya Kapoor</b> · B-204, Sunrise Apartments, Sector 56, Gurugram - 122011</span>
          </p>
          <div class="tk-btns">
            <a href="{{ url('dashboard') }}" class="btn btn-primary">
              <i class="fa-solid fa-box" aria-hidden="true"></i> Track My Order
            </a>
            <a href="{{ url('products') }}" class="btn btn-outline-primary">
              <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Continue Shopping
            </a>
          </div>
        </div>

        <aside class="tk-stub" aria-label="Order summary">
          <div class="stub-head">
            <span>Order Summary</span>
            <b>4 items</b>
          </div>
          <ul class="stub-items">
            <li>
              <img src="{{ asset('assets/images/home/pro2.png') }}"
                alt="Royal Radiance Premium Bridal Necklace Set" width="46" height="61" loading="lazy" />
              <span class="si-text">
                <strong>Royal Radiance Necklace Set</strong>
                <small>Antique Gold-tone · Qty 1</small>
              </span>
              <b class="si-price">₹7,500</b>
            </li>
            <li>
              <img src="{{ asset('assets/images/home/pro4.png') }}" alt="Pearl Drop Earrings" width="46"
                height="61" loading="lazy" />
              <span class="si-text">
                <strong>Pearl Drop Earrings</strong>
                <small>Gold-tone · Qty 2</small>
              </span>
              <b class="si-price">₹1,498</b>
            </li>
            <li>
              <img src="{{ asset('assets/images/home/pro1.png') }}" alt="Handloom Cotton Bedsheet Set" width="46"
                height="61" loading="lazy" />
              <span class="si-text">
                <strong>Handloom Cotton Bedsheet Set</strong>
                <small>Ivory · Double · Qty 1</small>
              </span>
              <b class="si-price">₹2,499</b>
            </li>
            <li>
              <img src="{{ asset('assets/images/home/pro3.png') }}" alt="Brass Diya Gift Set" width="46"
                height="61" loading="lazy" />
              <span class="si-text">
                <strong>Brass Diya Gift Set</strong>
                <small>Hand-finished Brass · Qty 1</small>
              </span>
              <b class="si-price">₹899</b>
            </li>
          </ul>
          <ul class="stub-rows">
            <li><span>Total MRP</span><b>₹16,495</b></li>
            <li><span>Discount on MRP</span><b class="is-green">−₹4,099</b></li>
            <li><span>Coupon (PIHUSPECIAL)</span><b class="is-green">−₹500</b></li>
            <li><span>Shipping &amp; Gift Packaging</span><b class="is-green">Free</b></li>
          </ul>
          <div class="stub-total">
            <span>Total Paid</span>
            <strong>₹11,896</strong>
          </div>
          <p class="stub-save">
            <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You saved ₹4,599
          </p>
        </aside>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
@endpush