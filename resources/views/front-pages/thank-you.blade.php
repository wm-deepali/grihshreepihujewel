@extends('layouts.app')

@section('title', 'Thank You for Your Order | ' . config('app.name'))

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@php
  $items = $order->items;
  $count = (int) $items->sum('quantity');

  $firstName = explode(' ', trim((string) $order->customer_name))[0] ?? '';

  $isCod = $order->payment_method === 'cod';
  $isPaid = $order->payment_status === 'paid';
  $payLabel = $isCod ? 'Cash on Delivery' : ($isPaid ? 'Paid Online' : 'Payment Pending');

  $deliverBy = $order->created_at->copy()->addDays(7)->format('D, d M');

  $shipTo = collect([
    collect([$order->address_line_1, $order->address_line_2])->filter()->implode(', '),
    collect([$order->city?->name, $order->state?->name])->filter()->implode(', ')
      . ($order->pincode ? ' - ' . $order->pincode : ''),
  ])->filter()->implode(', ');

  // ---- price summary: rows add up to the total (MRP - discounts + packaging + GST if exclusive + shipping) ----
  $itemsGross = (float) $items->sum('total');                       // qty x (price + addons)
  $totalMrp = (float) $items->sum(function ($i) {
    $unit = (float) $i->price;
    $mrp = (float) (($i->priceVariant?->mrp ?: $i->product?->mrp) ?: $unit);
    return max($mrp, $unit) * $i->quantity;
  });
  $sellTotal = (float) $items->sum(fn($i) => (float) $i->price * $i->quantity);
  $addonsTotal = (float) $items->sum(fn($i) => (float) $i->addons->sum('price') * $i->quantity);
  $hasAddons = $items->contains(fn($i) => $i->addons->isNotEmpty());
  $mrpDiscount = max(0, $totalMrp - $sellTotal);

  $couponOff = (float) $order->discount;
  $shipFee = (float) $order->shipping_charge;
  $tax = (float) $order->tax_amount;
  $grand = (float) $order->grand_total;
  $saved = $mrpDiscount + $couponOff;

  $gstApplied = $tax > 0 && !empty($order->gst_type);
  // inclusive: stored subtotal is ex-GST, so itemsGross - tax == subtotal (used for orders placed before tax_inclusive existed)
  $inclusive = $gstApplied && ($order->tax_inclusive ?? (abs($itemsGross - $tax - (float) $order->subtotal) < 0.02));
@endphp

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
          <h1>Thank you, {{ $firstName }}</h1>
          <p class="tk-msg">
            Your order is placed and a confirmation is on its way to
            <b>{{ $order->customer_email }}</b>. We will pack your jewellery and home pieces with care.
          </p>
          <ul class="tk-meta">
            <li><span>Order ID</span><strong>#{{ $order->order_number }}</strong></li>
            <li><span>Date</span><strong>{{ $order->created_at->format('d M Y') }}</strong></li>
            <li><span>Payment</span><strong>{{ $payLabel }}</strong></li>
            <li><span>Delivery by</span><strong>{{ $deliverBy }}</strong></li>
          </ul>
          <p class="tk-ship">
            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
            <span><b>Delivering to {{ $order->customer_name }}</b> · {{ $shipTo }}</span>
          </p>
          <div class="tk-btns">
            <a href="{{ route('user.dashboard.index') }}" class="btn btn-primary">
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
            <b>{{ $count }} {{ $count === 1 ? 'item' : 'items' }}</b>
          </div>

          <ul class="stub-items">
            @foreach($items as $item)
              @php
                $attrs = collect($item->selected_attributes ?? [])
                  ->pluck('value')->filter()->implode(' · ');
                $sub = collect([$attrs, 'Qty ' . $item->quantity])->filter()->implode(' · ');

                $img = $item->display_image;
                if (!$img) {
                  $raw = $item->imageVariant?->images?->first()?->image ?? $item->product?->images?->first()?->image;
                  $img = $raw ? asset('storage/' . $raw) : null;
                }
              @endphp
              <li>
                @if($img)
                  <img src="{{ $img }}" alt="{{ $item->product_name }}" width="46" height="61" loading="lazy" />
                @endif
                <span class="si-text">
                  <strong>{{ $item->product_name }}</strong>
                  <small>{{ $sub }}</small>
                  @foreach($item->addons as $ad)
                    <small>+ {{ $ad->detail }}</small>
                  @endforeach
                </span>
                <b class="si-price">₹{{ number_format($item->total) }}</b>
              </li>
            @endforeach
          </ul>

          <ul class="stub-rows">
            <li><span>Total MRP</span><b>₹{{ number_format($totalMrp) }}</b></li>
            @if($mrpDiscount > 0)
              <li><span>Discount on MRP</span><b class="is-green">−₹{{ number_format($mrpDiscount) }}</b></li>
            @endif
            @if($couponOff > 0)
              <li><span>Coupon @if($order->coupon_code)({{ $order->coupon_code }})@endif</span><b class="is-green">−₹{{ number_format($couponOff) }}</b></li>
            @endif
            @if($hasAddons)
              <li>
                <span>Gift Packaging</span>
                <b class="{{ $addonsTotal > 0 ? '' : 'is-green' }}">{{ $addonsTotal > 0 ? '₹' . number_format($addonsTotal) : 'Free' }}</b>
              </li>
            @endif
            @if($gstApplied)
              <li>
                <span>GST{{ $inclusive ? ' (included)' : '' }}</span>
                <b>₹{{ number_format($tax, 2) }}</b>
              </li>
            @endif
            <li>
              <span>Shipping</span>
              @if($shipFee > 0)
                <b>₹{{ number_format($shipFee) }}</b>
              @else
                <b class="is-green">Free</b>
              @endif
            </li>
          </ul>

          <div class="stub-total">
            <span>{{ $isPaid ? 'Total Paid' : 'Total Payable' }}</span>
            <strong>₹{{ number_format($grand) }}</strong>
          </div>

          @if($saved > 0)
            <p class="stub-save">
              <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You saved ₹{{ number_format($saved) }}
            </p>
          @endif
        </aside>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
  @if(!empty($purchaseScript))
    {!! $purchaseScript !!}
  @endif
@endpush