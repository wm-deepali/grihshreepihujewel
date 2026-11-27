@php
  $showBadge = $showBadge ?? true;
  $img = $p['img_url'] ?? asset('assets/images/home/' . $p['img']);
  $link = $p['url'] ?? url('product-detail');
  $pid = $p['id'];
  $isWished = in_array($pid, $wishedIds ?? []);
  $inStock = $p['in_stock'] ?? true;
@endphp
<div class="prod_cart">
  <div class="prod-img">
    <a href="{{ $link }}" class="prod-link">
      <img src="{{ $img }}" alt="{{ $p['name'] }}" loading="lazy" />
    </a>
    @if($showBadge && !empty($p['badge']))
      <span class="prod-badge {{ $p['badge'][0] }}"><i
          class="fa-solid {{ $p['badge'][1] }}"></i>{{ $p['badge'][2] }}</span>
    @endif

    <div class="prod-actions">
      @if($general->wishlist ?? true)
        <button type="button" class="act-btn wish-btn js-card-wish {{ $isWished ? 'is-active' : '' }}"
          data-product-id="{{ $pid }}" aria-pressed="{{ $isWished ? 'true' : 'false' }}" aria-label="Wishlist">
          <i class="{{ $isWished ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
        </button>
      @endif
      <button type="button" class="act-btn quick-btn js-quick" aria-label="Quick view" data-model=".product-view-pop"
        data-product-id="{{ $pid }}"><i class="fa-regular fa-eye"></i></button>
    </div>

    <div class="prod-btns">
      <button type="button" class="btn btn-outline-black prod-cta js-card-cart" data-product-id="{{ $pid }}"
        data-name="{{ $p['name'] }}" data-min-qty="{{ $p['min_qty'] ?? 1 }}" @if(!$inStock) disabled style="opacity:.5"
        @endif>
        {{ $inStock ? 'Add to Cart' : 'Out of Stock' }}
      </button>
      <a href="{{ $link }}" class="btn btn-primary prod-cta">Buy Now</a>
    </div>
  </div>

  <div class="prod-info">
    <div class="prod-meta">
      <span class="prod-brand">{{ $p['brand'] }}</span>
      @if(!empty($p['rate']))<span class="prod-rate"><i>★</i> {{ $p['rate'] }}</span>@endif
    </div>
    <h5 class="prod-name"><a href="{{ $link }}">{{ $p['name'] }}</a></h5>
    <p class="prod-sub">{{ $p['sub'] }}</p>
    <div class="prod-price">
      <span class="price-now">{{ $p['price'] }}</span>
      @if(!empty($p['old']))
        <span class="price-old">{{ $p['old'] }}</span><span class="prod-save">Save {{ $p['save'] }}</span>
      @endif
    </div>
  </div>
</div>