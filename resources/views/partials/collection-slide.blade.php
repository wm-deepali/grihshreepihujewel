<div class="swiper-slide">
  <a href="{{ $c['url'] }}" class="coll_card">
    <figure>
      <picture>
        <img src="{{ $c['img'] }}" alt="{{ $c['name'] }}" loading="lazy" />
      </picture>
    </figure>
    <div class="info">
      <span class="brand">{{ $c['brand'] }}</span>
      <h4>{{ $c['name'] }}</h4>
      @if(!empty($c['text']))<p>{{ $c['text'] }}</p>@endif
      <span class="cta">Explore <i class="fa-solid fa-arrow-right"></i></span>
    </div>
  </a>
</div>