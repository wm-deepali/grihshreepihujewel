@php
  $items = $cart->items;
  $itemsTotal = (float) $items->sum('total');
  $unitMrp = fn($i) => (float) ($i->priceVariant->mrp ?? $i->product->mrp ?? 0) + (float) $i->addons->sum('price');
  $totalMrp = (float) $items->sum(fn($i) => $unitMrp($i) * $i->quantity);
  $mrpDiscount = max(0, $totalMrp - $itemsTotal);
  $couponOff = (float) ($cart->discount ?? 0);
  $addonsTotal = (float) $items->sum(fn($i) => $i->addons->sum('price') * $i->quantity);
  $hasAddons = $items->contains(fn($i) => $i->addons->isNotEmpty());
  $saved = $mrpDiscount + $couponOff;
  $shipFee = (float) ($cart->shipping_charge ?? 0);
  $threshold = (float) (\App\Models\ShippingSetting::first()?->free_delivery_threshold ?? 0);
  $shipFree = $threshold > 0 && max(0, $itemsTotal - $couponOff) >= $threshold;
@endphp

<ul class="mini-list">
  @foreach($items as $item)
    @php
      $variant = collect($item->selected_attributes ?? [])->pluck('value')->filter()->implode(' · ');
    @endphp
    <li>
      <span class="mini-img">
        <img src="{{ $item->display_image }}" alt="" width="{{ $w }}" height="{{ $h }}" loading="lazy" />
        <b>{{ $item->quantity }}</b>
      </span>
      <span class="mini-text">
        <strong>{{ $item->product->name ?? 'Product' }}</strong>
        @if($variant)<small>{{ $variant }}</small>@endif
      </span>
      <span class="mini-price">₹{{ number_format($item->total) }}</span>
    </li>
  @endforeach
</ul>

<dl class="rows">
  <div class="row"><dt>Total MRP</dt><dd>₹{{ number_format($totalMrp) }}</dd></div>
  @if($mrpDiscount > 0)
    <div class="row is-green"><dt>Discount on MRP</dt><dd>−₹{{ number_format($mrpDiscount) }}</dd></div>
  @endif
  @if($couponOff > 0)
    <div class="row is-green"><dt>Coupon ({{ $cart->coupon_code }})</dt><dd>−₹{{ number_format($couponOff) }}</dd></div>
  @endif
  @if($hasAddons)
    <div class="row"><dt>Gift Packaging</dt><dd class="{{ $addonsTotal > 0 ? '' : 'is-green' }}">{{ $addonsTotal > 0 ? '₹' . number_format($addonsTotal) : 'Free' }}</dd></div>
  @endif
  @if($cart->tax_amount > 0 && $cart->gst_type)
    <div class="row"><dt>GST</dt><dd>₹{{ number_format($cart->tax_amount, 2) }}</dd></div>
  @endif
  <div class="row">
    <dt>Shipping Fee</dt>
    @if($shipFee > 0)
      <dd>₹{{ number_format($shipFee) }}</dd>
    @elseif($shipFree || $shipKnown)
      <dd class="is-green">Free</dd>
    @else
      <dd>Calculated at order</dd>
    @endif
  </div>
  <div class="row row-total">
    <dt>{{ $totalLabel }}<small>Inclusive of all taxes</small></dt>
    <dd>₹{{ number_format($cart->grand_total) }}</dd>
  </div>
</dl>

@if($saved > 0)
  <p class="save-chip"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving ₹{{ number_format($saved) }} on this order</p>
@endif