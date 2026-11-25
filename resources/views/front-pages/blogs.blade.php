@extends('layouts.app')

@section('title', 'Blog listing | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/blogs/blogs.css') }}" />
@endpush

@php
  // replace with DB posts later
  $stories = [
    's1'  => ['img' => 'cat1.png', 'alt' => 'Bedroom styled with soft handloom bedding', 'brand' => 'Grih Shree', 'cat' => 'Home & Living', 'title' => 'Simple Ways to Refresh Your Bedroom with Beautiful Bedding', 'text' => 'Soft textures, calm colours and a few thoughtful layers can make your bedroom feel fresh again.'],
    's2'  => ['img' => 'cat2.png', 'alt' => 'Traditional earrings styled for different occasions', 'brand' => 'Pihu Jewel', 'cat' => 'Jewellery & Styling', 'title' => 'How to Style Traditional Earrings for Different Occasions', 'text' => 'Simple ideas to wear jhumkas and chandbalis from daytime gatherings to festive evenings.'],
    's3'  => ['img' => 'cat3.png', 'alt' => 'Home decor accents styled in a living space', 'brand' => 'Grih Shree', 'cat' => 'Home Decor', 'title' => 'Home Decor Details That Make Every Space Feel Special', 'text' => 'From cushions to table accents, small touches that give every room its own character.'],
    's4'  => ['img' => 'pro1.png', 'alt' => 'Everyday home essentials in soft cotton', 'brand' => 'Grih Shree', 'cat' => 'Lifestyle', 'title' => 'Thoughtful Home Essentials for Everyday Living', 'text' => 'Practical pieces chosen with care to make everyday routines feel easier and more beautiful.'],
    's5'  => ['img' => 'cat4.png', 'alt' => 'Necklaces for special celebrations', 'brand' => 'Pihu Jewel', 'cat' => 'Jewellery & Styling', 'title' => 'A Guide to Choosing Jewellery for Special Celebrations', 'text' => 'A friendly guide to picking jewellery for weddings, festivals and family occasions.'],
    's6'  => ['img' => 'cat5.png', 'alt' => 'Handcrafted decor pieces with handmade details', 'brand' => 'Grih Shree', 'cat' => 'Home Decor', 'title' => 'Handcrafted Decor: The Beauty of Handmade Details', 'text' => 'Why handmade details bring warmth, personality and a story to your living space.'],
    's7'  => ['img' => 'pro4.png', 'alt' => 'Lightweight pearl earrings for everyday wear', 'brand' => 'Pihu Jewel', 'cat' => 'Lifestyle', 'title' => 'Everyday Jewellery Styling Tips', 'text' => 'Light, easy ways to style jewellery for work, errands and relaxed weekends.'],
    's8'  => ['img' => 'pro3.png', 'alt' => 'Brass diya gift set', 'brand' => 'Grih Shree & Pihu Jewel', 'cat' => 'Gifting Ideas', 'title' => 'Thoughtful Gift Ideas for the People You Love', 'text' => 'Gift ideas for home and jewellery lovers that feel personal, useful and memorable.'],
    's9'  => ['img' => 'banner.jpg', 'alt' => 'Festive celebration details', 'brand' => 'Grih Shree & Pihu Jewel', 'cat' => 'Festive & Celebrations', 'title' => 'Little Details That Make Celebrations More Beautiful', 'text' => 'Small details in decor, gifting and styling that make every celebration feel special.'],
    's10' => ['img' => 'pro2.png', 'alt' => 'Kundan jewellery for a festive look', 'brand' => 'Pihu Jewel', 'cat' => 'Festive & Celebrations', 'title' => 'Jewellery Pieces That Complete Your Festive Look', 'text' => 'Choose pieces that bring your festive outfit together without overpowering it.'],
  ];

  $tabs = [
    1 => ['All Stories',             ['s1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9']],
    2 => ['Home & Living',           ['s1', 's3', 's4', 's6']],
    3 => ['Home Decor',              ['s3', 's6']],
    4 => ['Jewellery & Styling',     ['s2', 's10', 's5', 's7']],
    5 => ['Festive & Celebrations',  ['s10', 's9']],
    6 => ['Gifting Ideas',           ['s8', 's9']],
    7 => ['Lifestyle',               ['s4', 's7']],
  ];
@endphp

@section('content')
  {{-- ================= BANNER ================= --}}
  <section class="comman-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">Blog</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Stories &amp; Inspiration</span>
          <h1 class="banner-title">Ideas, Inspiration &amp; Everything Beautiful</h1>
          <p class="banner-desc">
            Explore thoughtful ideas for beautiful living, jewellery styling, meaningful gifting and the little
            details that make every occasion special.
          </p>
        </div>

        <div class="banner-visual">
          <figure class="vis-main">
            <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree home and living" />
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

  {{-- ================= A : FEATURED STORY ================= --}}
  <section class="blog-secA">
    <div class="container">
      <div class="heading">
        <span>Editor's Pick</span>
        <h3>Stories Worth <span>Discovering</span></h3>
      </div>

      <article class="feat_story">
        <a href="{{ url('blog-detail') }}" class="fs-media">
          <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Thoughtful gifting and celebration moments" />
          <span class="fs-badge">Featured</span>
        </a>

        <div class="fs-card">
          <span class="fs-cat">Gifting Ideas</span>
          <h2><a href="{{ url('blog-detail') }}">Thoughtful Gift Ideas for the People You Love</a></h2>
          <p>
            From cosy home touches to jewellery that says it all, discover thoughtful ways to choose gifts that
            feel personal, useful and truly memorable.
          </p>

          <ul class="fs-meta">
            <li>
              <i class="fa-regular fa-calendar" aria-hidden="true"></i>
              <time datetime="YYYY-MM-DD">DD Mon YYYY</time>
            </li>
            <li>
              <i class="fa-solid fa-gem" aria-hidden="true"></i> Grih Shree &amp; Pihu Jewel
            </li>
          </ul>

          <a href="{{ url('blog-detail') }}" class="btn btn-primary">
            Read Article <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
          </a>
        </div>
      </article>
    </div>
  </section>

  {{-- ================= B : CATEGORIES + LATEST ARTICLES ================= --}}
  <section class="blog-secB" id="latestStories">
    <div class="container">
      <div class="heading">
        <span>Explore Our Stories</span>
        <h3>Find Inspiration for <span>Every Interest</span></h3>
      </div>

      <ul class="tab-nav">
        @foreach($tabs as $n => [$label, $ids])
          <li data-tab="{{ $n }}" class="{{ $loop->first ? 'active' : '' }}">{{ $label }}</li>
        @endforeach
      </ul>

      <div class="tab-nav-content">
        @foreach($tabs as $n => [$label, $ids])
          <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $n }}">
            <div class="story-grid">
              @foreach($ids as $id)
                @include('partials.story-card', ['s' => $stories[$id]])
              @endforeach
            </div>
          </div>
        @endforeach
      </div>

      {{-- PAGINATION (backend ready: ?page=N) --}}
      <nav class="story-pager" aria-label="Blog pagination">
        <ul>
          <li>
            <span class="pg pg-nav is-disabled" aria-disabled="true">
              <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
              <span class="pg-txt">Previous</span>
            </span>
          </li>
          @foreach([1, 2, 3] as $page)
            <li>
              <a href="{{ url('blog') }}?page={{ $page }}" class="pg {{ $page === 1 ? 'is-current' : '' }}" @if($page === 1) aria-current="page" @endif>{{ $page }}</a>
            </li>
          @endforeach
          <li>
            <a href="{{ url('blog') }}?page=2" class="pg pg-nav" rel="next">
              <span class="pg-txt">Next</span>
              <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </section>

  {{-- ================= NEWSLETTER ================= --}}
  <section class="home-secO">
    <div class="container">
      <div class="news-card">
        <div class="news-content">
          <div class="heading">
            <span>Join Our Journal</span>
            <h3>Stay Inspired</h3>
            <p>Get fresh ideas, styling inspiration and thoughtful discoveries delivered to your inbox.</p>
          </div>

          <form class="form news-form" action="#" method="post" novalidate>
            @csrf
            <div class="news-row">
              <div class="form-group news-field">
                <input type="email" id="newsEmail" name="email" placeholder=" " autocomplete="email" required />
                <label for="newsEmail">Enter your email address</label>
              </div>
              <button type="submit" class="btn btn-white news-btn">Subscribe <i class="fa-solid fa-chevron-right"></i></button>
            </div>
          </form>
        </div>

        <div class="news-img">
          <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Grih Shree and Pihu Jewel" loading="lazy" />
        </div>
      </div>
    </div>
  </section>
@endsection