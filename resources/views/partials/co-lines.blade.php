@php
  $s = $summary ?? \App\Services\CartSummary::for($cart);
  $items = $cart->items;
  $itemsTotal = (float) $items->sum('total');
  $addonsTotal = (float) array_sum($s['addons']);
  $hasAddons = $items->contains(fn($i) => $i->addons->isNotEmpty());
  $shipFee = (float) $s['shipping'];
  $threshold = (float) (\App\Models\ShippingSetting::first()?->free_delivery_threshold ?? 0);
  $shipFree = $threshold > 0 && max(0, $itemsTotal - $s['coupon']) >= $threshold;
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
  <div class="row"><dt>Total MRP</dt><dd>₹{{ number_format($s['total_mrp']) }}</dd></div>
  @if($s['mrp_discount'] > 0)
    <div class="row is-green"><dt>Discount on MRP</dt><dd>−₹{{ number_format($s['mrp_discount']) }}</dd></div>
  @endif
  @if($s['coupon'] > 0)
    <div class="row is-green"><dt>Coupon ({{ $s['coupon_code'] }})</dt><dd>−₹{{ number_format($s['coupon']) }}</dd></div>
  @endif
  @if($hasAddons)
    <div class="row"><dt>Gift Packaging</dt><dd class="{{ $addonsTotal > 0 ? '' : 'is-green' }}">{{ $addonsTotal > 0 ? '₹' . number_format($addonsTotal) : 'Free' }}</dd></div>
  @endif
  @if($s['tax'] > 0)
    <div class="row"><dt>GST</dt><dd>₹{{ number_format($s['tax'], 2) }}</dd></div>
  @elseif($s['tax_included'] > 0)
    <div class="row"><dt>GST (included)</dt><dd>₹{{ number_format($s['tax_included'], 2) }}</dd></div>
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
    <dt>{{ $totalLabel }}@if($s['gst_on'])<small>{{ $s['tax_inclusive'] ? 'Inclusive of all taxes' : 'Including GST' }}</small>@endif</dt>
    <dd>₹{{ number_format($s['total']) }}</dd>
  </div>
</dl>

@if($s['saved'] > 0)
  <p class="save-chip"><i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving ₹{{ number_format($s['saved']) }} on this order</p>
@endif