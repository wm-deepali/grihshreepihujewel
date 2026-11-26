@extends('layouts.app')

@section('title', 'Checkout | ' . config('app.name'))

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/checkout/checkout.css') }}" />
@endpush

@php
  $items = $cart->items;
  $count = (int) $items->sum('quantity');
  $grand = (float) $cart->grand_total;
  $shipKnown = (bool) $defaultAddress;

  $waDigits = preg_replace('/\D+/', '', (string) ($general->whatsapp ?? ''));
  if (strlen($waDigits) === 10) {
    $waDigits = '91' . $waDigits;
  }
  $waLink = $waDigits ? 'https://wa.me/' . $waDigits : null;

  $typeMap = ['home' => ['Home', 'fa-house'], 'office' => ['Work', 'fa-briefcase'], 'other' => ['Other', 'fa-location-dot']];

  $addrRows = $addresses->map(function ($a) use ($typeMap) {
    [$tag, $icon] = $typeMap[$a->address_type] ?? $typeMap['home'];
    return [
      'id' => $a->id,
      'icon' => $icon,
      'tag' => $tag,
      'default' => (bool) $a->is_default,
      'email' => $a->email,
      'state_id' => $a->state_id,
      'city_id' => $a->city_id,
      'lines' => array_values(array_filter([
        collect([$a->address_line_1, $a->address_line_2])->filter()->implode(', '),
        collect([$a->city?->name, $a->state?->name])->filter()->implode(', ') . ($a->pincode ? ' - ' . $a->pincode : ''),
      ])),
      'v' => [
        'name' => $a->name,
        'phone' => $a->phone,
        'pin' => $a->pincode,
        'state_id' => $a->state_id,
        'city_id' => $a->city_id,
        'house' => $a->address_line_1,
        'street' => $a->address_line_2,
        'landmark' => '',
        'type' => $a->address_type === 'office' ? 'work' : ($a->address_type ?: 'home'),
      ],
    ];
  });

  $checkedId = $defaultAddress->id ?? ($addrRows->first()['id'] ?? null);
  $prefEmail = $customer->email ?? $defaultAddress->email ?? '';
  $prefPhone = $customer->mobile ?? $defaultAddress->phone ?? '';

  $methods = [
    ['standard', true, 'Fri', '27', 'Nov', 'Standard Delivery', '3–7 working days · Tracked', 'Free', true],
  ];

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
        <a href="{{ url('cart') }}" class="back-link"><i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i> Back
          to bag</a>
      </div>

      <form class="co-layout form" action="#" method="post" novalidate onsubmit="return false">
        <div class="co-main">
          {{-- 1 : DETAILS --}}
          <section class="co-block">
            <div class="co-row">
              <h2 class="co-title"><span class="num">1</span> Your details</h2>
              @unless($customer)
                <p class="co-aside">Already a member? <a href="javascript:void(0)" data-model=".login-pop">Sign in</a></p>
              @endunless
            </div>
            <div class="fields">
              <div class="form-group s-6">
                <input type="email" id="cEmail" name="email" placeholder=" " autocomplete="email"
                  value="{{ $prefEmail }}" />
                <label for="cEmail">Email address</label>
              </div>
              <div class="form-group has-prefix s-6">
                <span class="prefix">+91</span>
                <input type="tel" id="cPhone" name="phone" placeholder=" " inputmode="numeric" maxlength="10"
                  autocomplete="tel-national" value="{{ $prefPhone }}" />
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
              @if($addrRows->count())
                <p class="co-aside">{{ $addrRows->count() }} saved {{ $addrRows->count() === 1 ? 'address' : 'addresses' }}
                </p>
              @endif
            </div>

            <div class="addr-list" role="radiogroup" aria-label="Choose a delivery address">
              @foreach($addrRows as $a)
                <div class="addr-card" data-id="{{ $a['id'] }}" data-email="{{ $a['email'] }}">
                  <input type="radio" name="address" id="addr{{ $a['id'] }}" class="addr-radio" value="{{ $a['id'] }}" {{ $a['id'] === $checkedId ? 'checked' : '' }} />
                  <label for="addr{{ $a['id'] }}" class="addr-body">
                    <span class="addr-ico" aria-hidden="true"><i class="fa-solid {{ $a['icon'] }}"></i></span>
                    <span class="addr-info">
                      <span class="addr-top">
                        <strong>{{ $a['v']['name'] }}</strong>
                        <span class="tag">{{ $a['tag'] }}</span>
                        @if($a['default'])<span class="tag tag-default">Default</span>@endif
                      </span>
                      @foreach($a['lines'] as $line)<span class="addr-line">{{ $line }}</span>@endforeach
                      @if($a['v']['phone'])
                        <span class="addr-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91
                          {{ substr($a['v']['phone'], 0, 5) }} {{ substr($a['v']['phone'], 5) }}</span>
                      @endif
                    </span>
                    <span class="radio-dot" aria-hidden="true"></span>
                  </label>

                  <input type="checkbox" id="edit{{ $a['id'] }}" class="edit-toggle" />
                  <label for="edit{{ $a['id'] }}" class="addr-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit
                    address</label>

                  <div class="addr-form">
                    <h3>Edit address</h3>
                    @include('partials.address-fields', ['idp' => 'a' . $a['id'], 'px' => 'a' . $a['id'] . '_', 'v' => $a['v']])
                    <label class="check">
                      <input type="checkbox" name="a{{ $a['id'] }}_default" {{ $a['default'] ? 'checked' : '' }} />
                      <span>Keep this as my default address</span>
                    </label>
                    <div class="form-actions">
                      <button type="button" class="btn btn-primary js-save-addr" data-id="{{ $a['id'] }}">Save
                        address</button>
                      <label for="edit{{ $a['id'] }}" class="btn btn-outline-primary">Cancel</label>
                    </div>
                  </div>
                </div>
              @endforeach

              <div class="addr-card addr-new">
                <input type="radio" name="address" id="addrNew" class="addr-radio" value="new" {{ $checkedId ? '' : 'checked' }} />
                <label for="addrNew" class="addr-body">
                  <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-plus"></i></span>
                  <span class="addr-info">
                    <span
                      class="addr-top"><strong>{{ $addrRows->count() ? 'Deliver to a new address' : 'Add your delivery address' }}</strong></span>
                    <span class="addr-line">Add a different name, phone number or location for this order.</span>
                  </span>
                  <span class="radio-dot" aria-hidden="true"></span>
                </label>

                <div class="addr-form">
                  @include('partials.address-fields', ['idp' => 'n', 'px' => 'new_'])
                  @if($customer)
                    <div class="form-actions">
                      <button type="button" class="btn btn-primary js-save-new">Save &amp; deliver here</button>
                      @if($checkedId)
                        <label for="addr{{ $checkedId }}" class="btn btn-outline-primary">Cancel</label>
                      @endif
                    </div>
                  @endif
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
                    <span class="method-date"
                      aria-hidden="true"><small>{{ $day }}</small><b>{{ $date }}</b><em>{{ $month }}</em></span>
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
            <div class="box-head">
              <h5>In your bag <span>({{ $count }} {{ $count === 1 ? 'item' : 'items' }})</span></h5>
            </div>

            @include('partials.co-lines', ['cart' => $cart, 'w' => 56, 'h' => 75, 'totalLabel' => 'Total Amount', 'shipKnown' => $shipKnown])

            <a href="{{ route('payment') }}" class="btn btn-primary place-btn js-continue">
              Continue to Payment <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
            <p class="terms-note">By continuing, you agree to our <a href="{{ url('terms-conditions') }}">Terms</a> and <a
                href="{{ url('privacy-policy') }}">Privacy Policy</a>.</p>
          </div>

          @if($waLink)
            <a href="{{ $waLink }}" class="co-help" target="_blank" rel="noopener">
              <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
              <span>Need help? <b>Chat with our styling team</b></span>
              <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
            </a>
          @endif
        </aside>
      </form>

      <div class="co-bar">
        <div class="bar-total"><span>Total</span><strong>₹{{ number_format($grand) }}</strong></div>
        <a href="{{ route('payment') }}" class="btn btn-primary js-continue">
          Continue to Payment <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  @include('partials.geo-js')
  <script>
    $(function () {
      var IS_CUSTOMER = @json((bool) $customer);
      var URLS = {
        store: "{{ route('address.store') }}",
        update: "{{ route('address.update', '__ID__') }}",
        def: "{{ route('checkout.change-default-address') }}",
        payment: "{{ route('payment') }}"
      };
      var token = function () { return $('meta[name="csrf-token"]').attr("content"); };
      var H = function () { return { "X-CSRF-TOKEN": token(), Accept: "application/json" }; };

      function errText(xhr) {
        var j = xhr.responseJSON || {};
        if (j.errors) return Object.values(j.errors)[0][0];
        return j.message || "Something went wrong. Please try again.";
      }

      // value of a named field (ignores unchecked radios / checkboxes)
      function field(px, key) {
        var $f = $(':input[name="' + px + key + '"]').filter(function () {
          return (this.type !== "radio" && this.type !== "checkbox") || this.checked;
        }).first();
        return $.trim($f.val() || "");
      }

      // read + validate one address form; resolves the payload the backend expects
      function collect(px, fallbackEmail) {
        var d = $.Deferred();
        var email = $.trim($("#cEmail").val()) || fallbackEmail || "";
        var phone = field(px, "phone") || $.trim($("#cPhone").val());
        var type = field(px, "type").toLowerCase();
        type = type === "work" ? "office" : (type === "other" ? "other" : "home");

        var v = {
          name: field(px, "name"), email: email, phone: phone,
          address_line_1: field(px, "house"),
          address_line_2: [field(px, "street"), field(px, "landmark")].filter(Boolean).join(", "),
          pincode: field(px, "pin"), address_type: type
        };

        if (!v.name) return d.reject("Please enter your full name.").promise();
        if (!/^\S+@\S+\.\S+$/.test(v.email)) return d.reject("Please enter a valid email address.").promise();
        if (!/^[6-9]\d{9}$/.test(v.phone)) return d.reject("Enter a valid 10 digit mobile number.").promise();
        if (!v.address_line_1) return d.reject("Please enter your house / flat number.").promise();
        if (!/^\d{6}$/.test(v.pincode)) return d.reject("Enter a valid 6 digit pincode.").promise();

        v.state_id = field(px, "state_id");
        v.city_id = field(px, "city_id");
        if (!v.state_id) return d.reject("Please select a state.").promise();
        if (!v.city_id) return d.reject("Please select a city.").promise();

        // names kept for the guest draft (sessionStorage)
        v.state_name = $.trim($(':input[name="' + px + 'state_id"] option:selected').text());
        v.city_name = $.trim($(':input[name="' + px + 'city_id"] option:selected').text());

        return d.resolve(v).promise();
      }

      // state -> city dropdowns for every form on the page
      $(".addr-card").each(function () {
        var px = $(this).hasClass("addr-new") ? "new_" : "a" + $(this).data("id") + "_";
        Geo.bind($(':input[name="' + px + 'state_id"]'), $(':input[name="' + px + 'city_id"]'));
      });

      // picking another saved address makes it the default (GST + shipping follow the default)
      $(document).on("change", 'input[name="address"]', function () {
        if (!IS_CUSTOMER || this.value === "new") return;
        $.ajax({ url: URLS.def, method: "POST", data: { address_id: this.value }, headers: H() })
          .done(function () { window.location.reload(); })
          .fail(function (xhr) { alert(errText(xhr)); });
      });

      // edit saved address
      $(document).on("click", ".js-save-addr", function () {
        var $b = $(this), id = $b.data("id"), px = "a" + id + "_";
        if ($b.data("busy")) return;
        collect(px, $b.closest(".addr-card").data("email")).done(function (v) {
          $b.data("busy", true);
          var isDef = $(':input[name="' + px + 'default"]').is(":checked") ? 1 : 0;
          $.ajax({
            url: URLS.update.replace("__ID__", id), method: "POST", headers: H(),
            data: $.extend({ _method: "PUT", is_default: isDef }, v)
          })
            .done(function () { window.location.reload(); })
            .fail(function (xhr) { alert(errText(xhr)); })
            .always(function () { $b.data("busy", false); });
        }).fail(function (m) { alert(m); });
      });

      function storeNew(v) {
        return $.ajax({ url: URLS.store, method: "POST", data: v, headers: H() });
      }

      // "Save & deliver here" (signed-in only)
      $(document).on("click", ".js-save-new", function () {
        var $b = $(this);
        if ($b.data("busy")) return;
        collect("new_").done(function (v) {
          $b.data("busy", true);
          storeNew(v).done(function () { window.location.reload(); })
            .fail(function (xhr) { alert(errText(xhr)); })
            .always(function () { $b.data("busy", false); });
        }).fail(function (m) { alert(m); });
      });

      // Continue to payment
      $(document).on("click", ".js-continue", function (e) {
        e.preventDefault();
        var $b = $(this);
        if ($b.data("busy")) return;
        var sel = $('input[name="address"]:checked').val();

        if (IS_CUSTOMER && sel && sel !== "new") { window.location.href = URLS.payment; return; }

        collect("new_").done(function (v) {
          $b.data("busy", true);
          if (IS_CUSTOMER) {
            storeNew(v).done(function () { window.location.href = URLS.payment; })
              .fail(function (xhr) { alert(errText(xhr)); $b.data("busy", false); });
          } else {
            // guest: keep the address in this browser tab; it is saved when the order is placed
            try { sessionStorage.setItem("coDraft", JSON.stringify(v)); } catch (err) { }
            window.location.href = URLS.payment;
          }
        }).fail(function (m) { alert(m); });
      });
    });
  </script>
@endpush