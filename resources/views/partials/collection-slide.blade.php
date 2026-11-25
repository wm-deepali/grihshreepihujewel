<div class="swiper-slide">
  <a href="{{ url('categories') }}" class="coll_card">
    <figure>
      <picture>
        <img src="{{ asset('assets/images/home/' . $c['img']) }}" alt="{{ $c['name'] }}" loading="lazy" />
      </picture>
    </figure>
    <div class="info">
      <span class="brand">{{ $c['brand'] }}</span>
      <h4>{{ $c['name'] }}</h4>
      <p>{{ $c['text'] }}</p>
      <span class="cta">Explore <i class="fa-solid fa-arrow-right"></i></span>
    </div>
  </a>
</div>