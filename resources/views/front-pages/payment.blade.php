@extends('layouts.app')

@section('title', 'Payment | ' . config('app.name'))

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/sass/payment/payment.css') }}" />
@endpush

@php
  $items = $cart->items;
  $count = (int) $items->sum('quantity');
  $grand = (float) $cart->grand_total;
  $shipKnown = (bool) $defaultAddress;
  $payAmt = $shipKnown ? ' ₹' . number_format($grand) : '';
  $hasGift = $items->contains(fn($i) => $i->addons->isNotEmpty());
  $hasReturns = $items->contains(fn($i) => trim(strip_tags((string) ($i->product->returns_exchange ?? ''))) !== '');
@endphp

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
          <strong>Payment failed.</strong> Your payment of <span class="pay-amt">₹{{ number_format($grand) }}</span> could not be completed. Please try again.
        </p>
        <a href="#pmTabs" class="alert-link">Try again</a>
      </div>

      <form class="pay-layout form" id="payForm" action="#" method="post" novalidate>
        <div class="pay-card">
          <div class="pay-sec ship-to">
            <span class="ship-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
            <p class="ship-text">
              @if($defaultAddress)
                <strong>Deliver to {{ $defaultAddress->name }}, {{ $defaultAddress->pincode }}</strong>
                <small>{{ collect([$defaultAddress->address_line_1, $defaultAddress->address_line_2, $defaultAddress->city?->name])->filter()->implode(', ') }}</small>
              @else
                <strong id="shipTitle">Deliver to</strong>
                <small id="shipLines"></small>
              @endif
            </p>
            <a href="{{ url('checkout') }}" class="ship-change">Change</a>
          </div>

          <div class="pay-sec pm">
            <h2 class="sec-label">Choose how to pay</h2>
            <p class="sec-note">Select one option. Your order is confirmed right after.</p>
            <input type="radio" name="payment" id="pmOnline" class="pm-radio" value="online" checked />
            @if($codEnabled)
              <input type="radio" name="payment" id="pmCod" class="pm-radio" value="cod" />
            @endif
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
              @if($codEnabled)
                <label for="pmCod" class="pm-tab">
                  <span class="pm-icon"><i class="fa-solid fa-indian-rupee-sign" aria-hidden="true"></i></span>
                  <span class="pm-text">
                    <strong>Cash on Delivery</strong>
                    <small>Pay when your order arrives</small>
                  </span>
                  <span class="radio-dot" aria-hidden="true"></span>
                  <span class="pm-badge">Pay at the door</span>
                </label>
              @endif
            </div>
            <p class="pm-info pm-online">
              <i class="fa-solid fa-lock" aria-hidden="true"></i>
              <span>
                You will pay on our secure page. We never store your card or bank details.
                <span class="pm-chips"><em>UPI</em><em>Visa</em><em>Mastercard</em><em>Net Banking</em></span>
              </span>
            </p>
            @if($codEnabled)
              <p class="pm-info pm-cod">
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                <span>Cash on Delivery is available. Please keep the exact amount ready for our delivery partner.</span>
              </p>
            @endif
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
                  <input type="text" id="bHouse" name="bill_house" placeholder=" " autocomplete="billing address-line1" />
                  <label for="bHouse">House / Flat no.</label>
                </div>
                <div class="form-group s-7">
                  <input type="text" id="bStreet" name="bill_street" placeholder=" " autocomplete="billing address-line2" />
                  <label for="bStreet">Street / Area / Locality</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bPin" name="bill_pin" placeholder=" " inputmode="numeric" maxlength="6" autocomplete="billing postal-code" />
                  <label for="bPin">PIN code</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bCity" name="bill_city" placeholder=" " autocomplete="billing address-level2" />
                  <label for="bCity">City</label>
                </div>
                <div class="form-group s-4">
                  <input type="text" id="bState" name="bill_state" placeholder=" " list="stateList" autocomplete="billing address-level1" />
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
                <small>{{ $count }} {{ $count === 1 ? 'item' : 'items' }} in your bag</small>
              </p>
              <a href="{{ route('cart') }}" class="mini-edit">Edit bag</a>
            </div>

            @include('partials.co-lines', ['cart' => $cart, 'w' => 58, 'h' => 77, 'totalLabel' => 'Amount Payable', 'shipKnown' => $shipKnown])

            <a href="javascript:void(0)" class="btn btn-primary place-btn pay-btn">
              <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay{{ $payAmt }} Securely
            </a>
            @if($codEnabled)
              <button type="submit" class="btn btn-primary place-btn cod-btn">
                Place Order <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
              </button>
            @endif
            <p class="terms-note">
              By continuing, you agree to our
              <a href="{{ url('terms-conditions') }}">Terms</a> and
              <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </p>
          </div>

          <ul class="trust-list">
            @if($hasReturns)
              <li><i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i> Returns &amp; exchange</li>
            @endif
            @if($hasGift)
              <li><i class="fa-solid fa-gift" aria-hidden="true"></i> Gift ready</li>
            @endif
            <li><i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Tracked delivery</li>
          </ul>
        </aside>

        <datalist id="stateList">
          @foreach($states as $s)<option value="{{ $s->name }}" data-id="{{ $s->id }}"></option>@endforeach
        </datalist>
      </form>

      <div class="pay-bar">
        <div class="bar-total">
          <span>Amount Payable</span>
          <strong>₹{{ number_format($grand) }}</strong>
        </div>
        <a href="javascript:void(0)" class="btn btn-primary bar-pay">
          <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay Securely
        </a>
        @if($codEnabled)
          <button type="submit" form="payForm" class="btn btn-primary bar-cod">
            Place Order <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
          </button>
        @endif
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  @include('partials.geo-js')
  <script>
    $(function () {
      var CFG = {
        customer: @json((bool) $customer),
        addressId: @json($defaultAddress?->id),
        subtotal: {{ (float) $cart->items->sum('total') }},
        site: @json($general->site_name ?: config('app.name')),
        place: "{{ route('checkout.place-order') }}",
        rzp: "{{ route('checkout.razorpay.success') }}",
        checkout: "{{ route('checkout') }}"
      };
      var busy = false, pendingMethod = null;
      var token = function () { return $('meta[name="csrf-token"]').attr("content"); };
      var H = function () { return { "X-CSRF-TOKEN": token(), Accept: "application/json" }; };

      function errText(xhr) {
        var j = xhr.responseJSON || {};
        if (j.errors) return Object.values(j.errors)[0][0];
        return j.message || "Something went wrong. Please try again.";
      }

      function draft() {
        try { return JSON.parse(sessionStorage.getItem("coDraft") || "null"); } catch (e) { return null; }
      }
      function clearDraft() { try { sessionStorage.removeItem("coDraft"); } catch (e) { } }

      // guest: the address comes from the checkout step
      if (!CFG.customer) {
        var dr = draft();
        if (!dr) { window.location.replace(CFG.checkout); return; }
        $("#shipTitle").text("Deliver to " + dr.name + ", " + dr.pincode);
        $("#shipLines").text([dr.address_line_1, dr.address_line_2, dr.city_name].filter(Boolean).join(", "));
      }

      Geo.bind($("#bState"), $("#bCity"), "bill");

      // billing: same as delivery, or the typed billing address
      function billing() {
        var d = $.Deferred();
        if ($("#billSame").is(":checked")) return d.resolve({ billing_same: 1 }).promise();

        var b = {
          bill_name: $.trim($("#bName").val()),
          bill_address_line_1: $.trim($("#bHouse").val()),
          bill_address_line_2: $.trim($("#bStreet").val()),
          bill_pincode: $.trim($("#bPin").val())
        };
        if (!b.bill_name) return d.reject("Please enter the billing name.").promise();
        if (!b.bill_address_line_1) return d.reject("Please enter the billing house / flat number.").promise();
        if (!/^\d{6}$/.test(b.bill_pincode)) return d.reject("Enter a valid 6 digit billing pincode.").promise();

        Geo.resolve($("#bState").val(), $("#bCity").val()).done(function (g) {
          if (!g.state_id) return d.reject("Please select the billing state from the list.");
          if (!g.city_id) return d.reject("Please select the billing city from the list.");
          b.bill_state_id = g.state_id; b.bill_city_id = g.city_id; b.billing_same = 0;
          d.resolve(b);
        });
        return d.promise();
      }

      function showFail(amountPaise) {
        if (amountPaise) $(".pay-amt").text("₹" + Math.round(amountPaise / 100).toLocaleString("en-IN"));
        $(".pay-alert").removeAttr("hidden");
        $("html, body").animate({ scrollTop: $(".pay-alert").offset().top - 120 }, 300);
      }

      function openRazorpay(r) {
        var rzp = new Razorpay({
          key: r.key, amount: r.amount, currency: "INR", name: CFG.site, order_id: r.razorpay_order_id,
          prefill: { name: r.customer_name, email: r.customer_email, contact: r.customer_phone },
          handler: function (resp) {
            $.ajax({ url: CFG.rzp, method: "POST", headers: H(), data: {
              order_id: r.order_id,
              razorpay_payment_id: resp.razorpay_payment_id,
              razorpay_order_id: resp.razorpay_order_id,
              razorpay_signature: resp.razorpay_signature
            } })
              .done(function (res) {
                if (res.success) { clearDraft(); window.location.href = res.redirect_url; }
                else { busy = false; alert(res.message || "Unable to confirm payment."); }
              })
              .fail(function (xhr) { busy = false; alert(errText(xhr)); });
          },
          modal: { ondismiss: function () { busy = false; showFail(r.amount); } }
        });
        rzp.on("payment.failed", function () { busy = false; showFail(r.amount); });
        rzp.open();
      }

      function placeOrder(method) {
        if (busy) return;
        busy = true;
        billing().done(function (b) {
          var data = $.extend({ payment_method: method }, b);

          if (CFG.addressId) {
            data.address_id = CFG.addressId;
          } else {
            var dr = draft();
            if (!dr) { window.location.href = CFG.checkout; return; }
            $.each(["name", "email", "phone", "address_line_1", "address_line_2", "state_id", "city_id", "pincode", "address_type"], function (_, k) {
              data[k] = dr[k];
            });
          }

          $.ajax({ url: CFG.place, method: "POST", data: data, headers: H() })
            .done(function (res) {
              if (!res.success) { busy = false; return alert(res.message || "Unable to place order right now."); }
              if (res.type === "cod") { clearDraft(); window.location.href = res.redirect_url; return; }
              openRazorpay(res);
            })
            .fail(function (xhr) { busy = false; alert(errText(xhr)); });
        }).fail(function (m) { busy = false; alert(m); });
      }

      function startOrder() {
        if (busy) return;
        var method = $('input[name="payment"]:checked').val() === "cod" ? "cod" : "razorpay";

        if (!CFG.customer) {
          // guest: ask for login / signup first, then carry on automatically
          pendingMethod = method;
          $('.action-link[data-model=".login-pop"]').first().trigger("click");
          return;
        }
        placeOrder(method);
      }

      // layout fires this after a successful login / signup from the popup
      $(document).on("auth:success", function (e, res) {
        if (!pendingMethod) return;
        e.preventDefault();
        CFG.customer = true;
        var method = pendingMethod;
        pendingMethod = null;

        // guest bag got merged with an older saved bag: show the customer what changed first
        if (res && res.cart_subtotal !== undefined && Math.abs(parseFloat(res.cart_subtotal) - CFG.subtotal) > 0.5) {
          alert("Your bag was updated after signing in. Please review it before paying.");
          window.location.reload();
          return;
        }
        placeOrder(method);
      });

      $(document).on("click", ".pay-btn, .bar-pay", function (e) { e.preventDefault(); startOrder(); });
      $("#payForm").on("submit", function (e) { e.preventDefault(); startOrder(); });
    });
  </script>
@endpush