@php
  $items = $miniCart->items ?? collect();
  $count = (int) $items->sum('quantity');
  $subtotal = (float) $items->sum('total');
  $discount = (float) ($miniCart->discount ?? 0);

  $gstOn = \App\Services\Tax::enabled();
  $taxInclusive = $gstOn && \App\Services\Tax::inclusive();
  $taxAmt = $gstOn ? (float) ($miniCart->tax_amount ?? 0) : 0;

  // free-shipping progress (same basis as CartController: items total - coupon discount)
  $threshold = (float) (\App\Models\ShippingSetting::first()?->free_delivery_threshold ?? 0);
  $payable = max(0, $subtotal - $discount);
  $shipDone = $threshold > 0 && $payable >= $threshold;
  $shipLeft = $threshold > 0 ? (int) ceil(max(0, $threshold - $payable)) : 0;
  $shipPct = $threshold > 0 ? (int) min(100, floor($payable / $threshold * 100)) : 0;

  $productUrl = fn($p) => \Illuminate\Support\Facades\Route::has('product.show') && $p?->slug
    ? route('product.show', $p->slug) : '#';
@endphp

<div class="cp-head">
  <h3>My Bag @if($count)<span>{{ $count }} {{ $count === 1 ? 'item' : 'items' }}</span>@endif</h3>
  @if($count && $threshold > 0)
    <div class="cp-ship">
      <p>
        <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
        @if($shipDone)
          You have unlocked <strong>FREE shipping</strong> on this order.
        @else
          Add <strong>₹{{ number_format($shipLeft) }}</strong> more for <strong>FREE shipping</strong>.
        @endif
      </p>
      <span class="cp-bar"><i style="width: {{ $shipPct }}%"></i></span>
    </div>
  @endif
</div>

@if($count)
  <ul class="cp-list">
    @foreach($items as $item)
      @php
        $p = $item->product;
        $addonUnit = (float) $item->addons->sum('price');
        $unitNow = (float) $item->price + $addonUnit;
        $mrp = (float) ($item->priceVariant->mrp ?? $p->mrp ?? 0);
        $unitOld = $mrp + $addonUnit;
        $off = $mrp > (float) $item->price ? (int) round(($mrp - $item->price) / $mrp * 100) : 0;
        $variant = collect($item->selected_attributes ?? [])
          ->map(fn($a) => ! empty($a['attribute']) && ! empty($a['value']) ? $a['attribute'] . ': ' . $a['value'] : null)
          ->filter()->implode(' · ');
        $addons = $item->addons->pluck('detail')->filter()->implode(', ');
        $catName = $p?->subcategory?->name ?? $p?->category?->name;
      @endphp
      <li class="cp-item" data-item="{{ $item->id }}">
        <a class="cp-img" href="{{ $productUrl($p) }}">
          <img src="{{ $item->display_image }}" alt="{{ $p->name ?? '' }}" width="88" height="88" loading="lazy" />
        </a>
        <div class="cp-info">
          @if($catName)<span class="cp-cat">{{ $catName }}</span>@endif
          <h4 class="cp-name"><a href="{{ $productUrl($p) }}">{{ $p->name ?? 'Product' }}</a></h4>
          @if($variant)<span class="cp-variant">{{ $variant }}</span>@endif
          @if($addons)<span class="cp-variant">+ {{ $addons }}</span>@endif
          <div class="cp-price">
            <strong>₹{{ number_format($item->total) }}</strong>
            @if($off)
              <del>₹{{ number_format($unitOld * $item->quantity) }}</del>
              <span class="cp-off">{{ $off }}% off</span>
            @endif
          </div>
          <div class="cp-actions">
            <div class="qty" role="group" aria-label="Quantity for {{ $p->name ?? 'item' }}">
              <button type="button" class="cp-qty-btn" data-act="minus" data-id="{{ $item->id }}"
                aria-label="Decrease quantity"><i class="fa-solid fa-minus" aria-hidden="true"></i></button>
              <input type="text" inputmode="numeric" value="{{ $item->quantity }}" readonly aria-label="Quantity" />
              <button type="button" class="cp-qty-btn" data-act="plus" data-id="{{ $item->id }}"
                aria-label="Increase quantity"><i class="fa-solid fa-plus" aria-hidden="true"></i></button>
            </div>
            <button type="button" class="cp-remove" data-id="{{ $item->id }}">
              <i class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove
            </button>
          </div>
        </div>
      </li>
    @endforeach
  </ul>

  <div class="cp-foot">
    <div class="cp-total"><span>Subtotal</span><strong>₹{{ number_format($subtotal) }}</strong></div>
    @if($discount > 0)
      <p class="cp-note">
        <i class="fa-solid fa-ticket" aria-hidden="true"></i>
        {{ $miniCart->coupon_code ? 'Coupon ' . $miniCart->coupon_code . ': ' : 'Discount: ' }}-₹{{ number_format($discount) }}
      </p>
    @endif
    @if($gstOn && $taxAmt > 0)
      <p class="cp-note">
        <i class="fa-solid fa-percent" aria-hidden="true"></i>
        @if($taxInclusive)
          Inclusive of GST (₹{{ number_format($taxAmt, 2) }})
        @else
          + GST ₹{{ number_format($taxAmt, 2) }} added at checkout
        @endif
      </p>
    @endif
    <div class="cp-btns">
      <a href="{{ route('cart') }}" class="btn btn-outline-primary">View Bag</a>
      <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
    </div>
  </div>
@else
  <div class="cp-empty">
    <span class="cp-empty-icon"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
    <h4>Your bag is empty</h4>
    <p>Add something you like and it will show up here.</p>
    <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
  </div>
@endif