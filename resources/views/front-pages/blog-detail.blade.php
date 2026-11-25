@extends('layouts.app')

@section('title', 'Blog Detail | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/blog-detail/blog-detail.css') }}" />
@endpush

@php
  // replace with DB posts later
  $related = [
    ['img' => 'cat1.png', 'alt' => 'Bedroom styled with soft handloom bedding', 'brand' => 'Grih Shree', 'cat' => 'Home & Living', 'title' => 'Simple Ways to Refresh Your Bedroom with Beautiful Bedding', 'text' => 'Soft textures, calm colours and a few thoughtful layers can make your bedroom feel fresh again.'],
    ['img' => 'cat2.png', 'alt' => 'Traditional earrings styled for different occasions', 'brand' => 'Pihu Jewel', 'cat' => 'Jewellery & Styling', 'title' => 'How to Style Traditional Earrings for Different Occasions', 'text' => 'Simple ideas to wear jhumkas and chandbalis from daytime gatherings to festive evenings.'],
    ['img' => 'cat3.png', 'alt' => 'Home decor accents styled in a living space', 'brand' => 'Grih Shree', 'cat' => 'Home Decor', 'title' => 'Home Decor Details That Make Every Space Feel Special', 'text' => 'From cushions to table accents, small touches that give every room its own character.'],
    ['img' => 'cat4.png', 'alt' => 'Necklaces for special celebrations', 'brand' => 'Pihu Jewel', 'cat' => 'Jewellery & Styling', 'title' => 'A Guide to Choosing Jewellery for Special Celebrations', 'text' => 'A friendly guide to picking jewellery for weddings, festivals and family occasions.'],
    ['img' => 'cat5.png', 'alt' => 'Handcrafted decor pieces with handmade details', 'brand' => 'Grih Shree', 'cat' => 'Home Decor', 'title' => 'Handcrafted Decor: The Beauty of Handmade Details', 'text' => 'Why handmade details bring warmth, personality and a story to your living space.'],
  ];

  $recent = [
    ['cat1.png', 'Bedroom refresh', 'Refresh Your Bedroom with Beautiful Bedding'],
    ['cat2.png', 'Traditional earrings', 'Style Traditional Earrings for Every Occasion'],
    ['cat3.png', 'Home decor details', 'Decor Details That Make Every Space Special'],
    ['cat4.png', 'Celebration jewellery', 'A Guide to Choosing Jewellery for Celebrations'],
    ['cat5.png', 'Handcrafted decor', 'Handcrafted Decor: The Beauty of Handmade Details'],
  ];
@endphp

@section('content')
  {{-- ================= BANNER ================= --}}
  <section class="comman-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li><a href="{{ url('blog') }}">Blog</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">Thoughtful Gift Ideas</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Gifting Ideas</span>
          <h1 class="banner-title">Thoughtful Gift Ideas for the People You Love</h1>
          <p class="banner-desc">
            From cosy home touches to jewellery that says it all, discover thoughtful ways to choose gifts that
            feel personal and memorable.
          </p>
        </div>

        <div class="banner-visual">
          <figure class="vis-main">
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Thoughtful gifting and celebration moments" />
            <span class="vis-tag"><i></i>Grih Shree</span>
          </figure>
          <figure class="vis-sub">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" />
            <span class="vis-tag"><i></i>Pihu Jewel</span>
          </figure>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= ARTICLE ================= --}}
  <section class="detail-secA">
    <div class="container">
      <div class="detail-layout">
        <div class="detail-rail">
          <span>Share</span>
          <a href="javascript:void(0);" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="javascript:void(0);" aria-label="Share on X"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="javascript:void(0);" aria-label="Share on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          <button type="button" class="copyLink" aria-label="Copy link"><i class="fa-solid fa-link"></i></button>
        </div>

        <article class="detail-article">
          <ul class="detail-meta">
            <li class="dm-cat">Gifting Ideas</li>
            <li>
              <i class="fa-regular fa-calendar" aria-hidden="true"></i>
              <time datetime="YYYY-MM-DD">DD Mon YYYY</time>
            </li>
            <li><i class="fa-regular fa-clock" aria-hidden="true"></i> 5 min read</li>
            <li><i class="fa-solid fa-gem" aria-hidden="true"></i> Grih Shree &amp; Pihu Jewel</li>
          </ul>

          <figure class="detail-cover">
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Thoughtful gifting and celebration moments" />
            <span class="dc-tag">Gift Guide</span>
          </figure>

          <div class="blog-content">
            <p>
              A good gift is not about the price. It is about the thought behind it, and the way it fits into the
              life of the person receiving it. Here is a <strong>simple, friendly guide</strong> to choosing gifts
              that feel personal.
            </p>

            <h2>1. Start with the person</h2>
            <p>
              Think about how they spend their days. A warm bedding set suits someone who loves a calm home, while
              a pair of pearl earrings suits someone who loves simple style. Explore our
              <a href="{{ url('categories') }}">curated collections</a> for ideas.
            </p>

            <h2>2. Gifts that never go wrong</h2>
            <ul>
              <li><strong>Brass diya sets:</strong> festive, useful and lasting.</li>
              <li><strong>Cushion covers:</strong> a quick way to refresh a room.</li>
              <li><strong>Pearl earrings:</strong> light, elegant and easy to wear.</li>
            </ul>

            <h3>What to look for</h3>
            <ol>
              <li>Quality that feels good in the hand.</li>
              <li>A design that suits their taste, not just yours.</li>
              <li>Neat packaging that is ready to gift.</li>
            </ol>

            <blockquote>The best gifts are the ones that make someone feel seen.</blockquote>

            <figure>
              <img src="{{ asset('assets/images/home/pro3.png') }}" alt="Brass diya gift set" />
              <figcaption>A hand-finished brass diya set, ready to gift</figcaption>
            </figure>

            <p>
              Not sure what to pick? Reach us on the <a href="{{ url('contact') }}">contact page</a> and our team
              will help you choose.
            </p>
          </div>

          <div class="detail-foot">
            <span class="df-label">Tags:</span>
            <ul class="detail-tags" aria-label="Tags">
              <li><a href="{{ url('blog') }}?tag=gifting">Gifting</a></li>
              <li><a href="{{ url('blog') }}?tag=home-decor">Home Decor</a></li>
              <li><a href="{{ url('blog') }}?tag=jewellery">Jewellery</a></li>
            </ul>
          </div>
        </article>
      </div>

      <div class="more-grid">
        <div class="more-card more-author">
          <span class="ma-avatar"><i class="fa-regular fa-user" aria-hidden="true"></i></span>
          <small>Written by</small>
          <h4>Grih Shree &amp; Pihu Jewel</h4>
          <p>Simple ideas for beautiful living, jewellery styling and meaningful gifting.</p>
        </div>

        <div class="more-card more-recent">
          <h4>Recent Stories</h4>
          <ul>
            @foreach($recent as [$img, $alt, $title])
              <li>
                <a href="{{ url('blog-detail') }}" class="mr-img">
                  <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $alt }}" loading="lazy" />
                </a>
                <div>
                  <a href="{{ url('blog-detail') }}">{{ $title }}</a>
                  <small>DD Mon YYYY</small>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="more-card more-shop">
          <small>Ready to Shop?</small>
          <h4>Bring It Home</h4>
          <p>Explore home essentials and jewellery chosen with care.</p>
          <div class="shop-btns">
            <a href="{{ url('categories') }}" class="btn btn-white">Shop Home &amp; Living</a>
            <a href="{{ url('categories') }}" class="btn btn-outline-white">Explore Jewellery</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= RELATED STORIES ================= --}}
  <section class="detail-secB">
    <div class="container">
      <div class="heading">
        <span>Keep Reading</span>
        <h3>Related <span>Stories</span></h3>
        <p>More from the journal, picked for you.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.1" data-sm="2.2" data-lg="3" data-xl="3">
          <div class="swiper-wrapper">
            @foreach($related as $s)
              <div class="swiper-slide">
                @include('partials.story-card', ['s' => $s])
              </div>
            @endforeach
          </div>
        </div>

        <div class="swiper-group">
          <button type="button" class="TestimonialSlider-prev btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
          <button type="button" class="TestimonialSlider-next btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </section>
@endsection