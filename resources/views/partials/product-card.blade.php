@php $showBadge = $showBadge ?? true; @endphp
<div class="prod_cart">
  <div class="prod-img">
    <a href="{{ url('product-detail') }}" class="prod-link">
      <img src="{{ asset('assets/images/home/' . $p['img']) }}" alt="{{ $p['name'] }}" loading="lazy" />
    </a>
    @if($showBadge && !empty($p['badge']))
      <span class="prod-badge {{ $p['badge'][0] }}"><i class="fa-solid {{ $p['badge'][1] }}"></i>{{ $p['badge'][2] }}</span>
    @endif
    <div class="prod-actions">
      <button type="button" class="act-btn wish-btn" aria-label="Wishlist"><i class="fa-regular fa-heart"></i></button>
      <button type="button" class="act-btn quick-btn" aria-label="Quick view" data-model=".product-view-pop"><i class="fa-regular fa-eye"></i></button>
    </div>
    <div class="prod-btns">
      <button
        type="button"
        data-id="{{ $p['id'] }}"
        data-name="{{ $p['name'] }}"
        data-toast-title="Added to Cart"
        data-toast-text="{{ $p['name'] }} has been added to your cart."
        data-toast-type="success"
        class="btn btn-outline-black prod-cta"
      >Add to Cart</button>
      <a href="{{ url('product-detail') }}" class="btn btn-primary prod-cta">Buy Now</a>
    </div>
  </div>
  <div class="prod-info">
    <div class="prod-meta">
      <span class="prod-brand">{{ $p['brand'] }}</span>
      @if(!empty($p['rate']))<span class="prod-rate"><i>★</i> {{ $p['rate'] }}</span>@endif
    </div>
    <h5 class="prod-name"><a href="{{ url('product-detail') }}">{{ $p['name'] }}</a></h5>
    <p class="prod-sub">{{ $p['sub'] }}</p>
    <div class="prod-price">
      <span class="price-now">{{ $p['price'] }}</span>
      @if(!empty($p['old']))
        <span class="price-old">{{ $p['old'] }}</span><span class="prod-save">Save {{ $p['save'] }}</span>
      @endif
    </div>
  </div>
</div>