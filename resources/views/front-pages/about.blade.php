@extends('layouts.app')

@section('title', 'About Us | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/about/about.css') }}" />
@endpush

@section('content')
  {{-- ================= BANNER ================= --}}
  <section class="comman-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">About Us</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">The Story of Grih Shree &amp; Pihu Jewel</span>
          <h1 class="banner-title">Two Beautiful Worlds.</h1>
          <p class="banner-desc">Discover a world where beautiful living meets personal expression.</p>
          <div class="banner-btns">
            <a href="{{ url('categories') }}" class="btn btn-primary">
              Explore Our Collections
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 12h16M14 6l6 6-6 6" />
              </svg>
            </a>
          </div>
        </div>

        <div class="banner-visual">
          <figure class="vis-main">
            <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree" />
            <span class="vis-tag"><i></i>Grih Shree</span>
          </figure>
          <figure class="vis-sub">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel" />
            <span class="vis-tag"><i></i>Pihu Jewel</span>
          </figure>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= OUR STORY ================= --}}
  <section class="about-secA">
    <div class="container">
      <div class="story-wrap">
        <div class="story-media">
          <figure class="media-a">
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Grih Shree and Pihu Jewel" loading="lazy" />
          </figure>
          <figure class="media-b">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel" loading="lazy" />
          </figure>
        </div>

        <div class="story-right">
          <div class="heading">
            <span>Our Story</span>
            <h3>A Shared Love for <br /><span>Beautiful Things</span></h3>
          </div>

          <div class="story-text">
            <p>
              Grih Shree &amp; Pihu Jewel brings together two distinctive worlds, united by a shared appreciation for
              beauty, thoughtful choices and meaningful details.
            </p>
            <p>
              From the warmth of a thoughtfully styled home to the finishing touch of a beautiful piece of jewellery,
              we believe the little things often make life's moments more special.
            </p>
            <p>
              That's why we bring together home essentials, décor, handcrafted creations and jewellery in one place,
              making it easier to discover pieces that reflect your space, your style and your celebrations.
            </p>
          </div>

          <ul class="story-stats">
            @foreach([
              [25, 'Years of Experience'],
              [120, 'Curated Collections'],
              [10000, 'Happy Customers'],
              [5000, 'Special Moments Celebrated'],
            ] as [$num, $label])
              <li class="stat_item">
                <strong><span class="countNum" data-num="{{ $num }}" data-num-icon="+">0</span></strong>
                <small>{{ $label }}</small>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= GET TO KNOW US ================= --}}
  <section class="about-secB">
    <div class="container">
      <div class="heading">
        <span>Get to Know Us</span>
        <h3>Two Distinctive Worlds, <span>One Beautiful Experience</span></h3>
        <p>Every collection has its own character. Together, they bring more ways to express what you love.</p>
      </div>

      <div class="who-grid">
        {{-- GRIH SHREE --}}
        <article class="who_card">
          <a href="{{ url('categories') }}" class="who-img">
            <figure>
              <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree bedding, home décor and handcrafted creations" loading="lazy" />
            </figure>
          </a>
          <div class="who-info">
            <span class="who-brand">Grih Shree</span>
            <h4>The Art of Beautiful Living</h4>
            <p>
              We bring together thoughtfully selected bedding, home décor, everyday essentials, festive accents and
              handcrafted creations that add warmth and character to your spaces.
            </p>
            <a href="{{ url('categories') }}" class="who-cta">Discover Grih Shree <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>

        {{-- PIHU JEWEL --}}
        <article class="who_card">
          <a href="{{ url('categories') }}" class="who-img">
            <figure>
              <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel earrings, necklaces, bangles and rings" loading="lazy" />
            </figure>
          </a>
          <div class="who-info">
            <span class="who-brand">Pihu Jewel</span>
            <h4>Elegance in Every Detail</h4>
            <p>
              We bring together beautiful earrings, necklaces, bangles, rings and traditional accessories to
              complement your personal style and special occasions.
            </p>
            <a href="{{ url('categories') }}" class="who-cta">Discover Pihu Jewel <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
      </div>
    </div>
  </section>

  {{-- ================= WHAT WE BELIEVE ================= --}}
  <section class="about-secC">
    <div class="container">
      <div class="heading">
        <span>What We Believe</span>
        <h3>Beauty Lives in the <span>Little Details</span></h3>
        <p>
          Whether it's a detail that makes a room feel welcoming or an accessory that completes your look, we believe
          thoughtful choices can make everyday moments more meaningful.
        </p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="3" data-xl="3">
          <div class="swiper-wrapper">
            @foreach([
              ['fa-hand-holding-heart', 'Thoughtful Selection', 'Collections chosen to bring together beauty, usefulness and personal expression.'],
              ['fa-gem', 'A Love for Details', 'From home accents to jewellery finishes, we appreciate the little details that make each piece special.'],
              ['fa-gift', 'Something for Every Moment', 'Everyday living, celebrations, gifting and personal style: discover pieces for moments that matter.'],
            ] as [$icon, $title, $text])
              <div class="swiper-slide">
                <div class="philo_item">
                  <i class="fa-solid {{ $icon }} philo-icon"></i>
                  <h4>{{ $title }}</h4>
                  <p>{{ $text }}</p>
                </div>
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

  {{-- ================= YOUR JOURNEY ================= --}}
  <section class="about-secD">
    <div class="container">
      <div class="journey-wrap">
        <div class="journey-media">
          <figure>
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Your journey with Grih Shree and Pihu Jewel" loading="lazy" />
          </figure>
          <div class="journey-note">
            <small>Two worlds</small>
            <strong>Grih Shree &amp; Pihu Jewel</strong>
          </div>
        </div>

        <div class="journey-right">
          <div class="heading">
            <span>Your Experience</span>
            <h3>Your Journey to <br /><span>Something Beautiful</span></h3>
            <p>Finding something you love should feel effortless. Here's how you can make every discovery your own.</p>
          </div>

          <ul class="journey-list">
            @foreach([
              ['fa-compass', 'Collections', 'Explore Your World', 'Browse two distinctive collections: Grih Shree for your home and Pihu Jewel for your personal style.'],
              ['fa-magnifying-glass', 'Categories', 'Discover Your Favourites', 'Explore thoughtfully organised categories and find pieces that catch your eye.'],
              ['fa-bag-shopping', 'Checkout', 'Choose What You Love', 'Select your favourites, review the product details and complete your order through our website.'],
              ['fa-box-open', 'Delivery', 'Enjoy the Little Details', 'Follow your order and look forward to welcoming something special into your home or your collection.'],
            ] as [$icon, $small, $title, $text])
              <li class="journey_step">
                <span class="step-icon"><i class="fa-solid {{ $icon }}"></i></span>
                <div class="step-txt">
                  <small>{{ $small }}</small>
                  <h4>{{ $title }}</h4>
                  <p>{{ $text }}</p>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= SHOPPING EXPERIENCE ================= --}}
  <section class="about-secE">
    <div class="container">
      <div class="heading">
        <span>The Difference Is in the Details</span>
        <h3>A Shopping Experience <span>Made with Care</span></h3>
        <p>
          From discovering the right collection to placing your order, we want every step to feel clear, convenient
          and considered.
        </p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            @foreach([
              ['fa-store', 'Two Collections, One Destination', 'Explore home and lifestyle essentials alongside jewellery, all in one place.'],
              ['fa-layer-group', 'Easy Collection Discovery', "Browse clearly organised categories to find what you're looking for."],
              ['fa-bag-shopping', 'Convenient Online Shopping', 'Explore product details and place your order through a straightforward shopping experience.'],
              ['fa-headset', 'Customer Assistance', 'Get in touch with our team whenever you need help with your shopping or order.'],
            ] as [$icon, $title, $text])
              <div class="swiper-slide">
                <div class="why_card">
                  <span class="why-icon"><i class="fa-solid {{ $icon }}"></i></span>
                  <h4>{{ $title }}</h4>
                  <p>{{ $text }}</p>
                </div>
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

  {{-- ================= LIFESTYLE TILES ================= --}}
  <section class="about-secF">
    <div class="container">
      <div class="heading">
        <span>For Every Space &amp; Every Occasion</span>
        <h3>From Everyday Moments to <span>Special Celebrations</span></h3>
        <p>
          A welcoming home, a thoughtful gift or a finishing touch for a celebration: discover collections that make
          room for the things you love.
        </p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="3" data-xl="3">
          <div class="swiper-wrapper">
            @foreach([
              ['banner2.jpg', 'Beautiful living with Grih Shree', 'Grih Shree', 'For Your Space', 'Beautiful Living', 'Thoughtful details for the spaces you call home.'],
              ['jewellery.jpg', 'Personal expression with Pihu Jewel', 'Pihu Jewel', 'For Your Style', 'Personal Expression', 'Jewellery that adds character to your style.'],
              ['pro3.png', 'Meaningful gifting', 'Grih Shree & Pihu Jewel', 'For Your Moments', 'Meaningful Gifting', 'Thoughtful finds for people and moments that matter.'],
            ] as [$img, $alt, $brand, $label, $title, $text])
              <div class="swiper-slide">
                <a href="{{ url('categories') }}" class="life_tile">
                  <figure class="life-img">
                    <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $alt }}" loading="lazy" />
                  </figure>
                  <span class="life-brand">{{ $brand }}</span>
                  <div class="life-panel">
                    <span class="life-label">{{ $label }}</span>
                    <h4>{{ $title }}</h4>
                    <p>{{ $text }}</p>
                    <span class="life-cta">Explore <i class="fa-solid fa-arrow-right"></i></span>
                  </div>
                </a>
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

  {{-- ================= CTA ================= --}}
  <section class="about-secG">
    <div class="container">
      <div class="cta-box">
        <div class="cta-bg">
          <img src="{{ asset('assets/images/home/banner.jpg') }}" alt="Find your kind of beautiful with Grih Shree and Pihu Jewel" loading="lazy" />
        </div>

        <div class="cta-content">
          <span class="cta-eyebrow">Your Next Discovery Starts Here</span>
          <h2 class="cta-title">There's Something Beautiful <br />Waiting for You</h2>
          <p class="cta-desc">
            Explore the warmth of Grih Shree and the elegance of Pihu Jewel. Find the pieces that feel just right for
            your home, your style and your special moments.
          </p>
          <div class="cta-btns">
            <a href="{{ url('categories') }}" class="btn btn-white">Explore Home &amp; Living <i class="fa-solid fa-arrow-right"></i></a>
            <a href="{{ url('categories') }}" class="btn btn-white">Discover Jewellery <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection