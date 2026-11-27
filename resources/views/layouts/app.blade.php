@php
  // ---------- reusable svg snippets ----------
  $arrow = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6" /></svg>';
  $chev = '<svg class="chev" viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6" /></svg>';
  $googleSvg = '<svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" /><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" /><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" /><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" /></svg>';

  // ---------- menu data (replace with DB categories later) ----------
  $homeCols = [
    ['Handloom & Bedding', ['Bedsheets', 'Reversible Bedsheets', 'Cotton Bedsheets', 'Dohars & Quilts', 'Comforters', 'Pillow Covers', 'Cushion Covers', 'Bedding Sets']],
    ['Home Decor', ['Torans & Door Hangings', 'Wall Decor', 'Table Decor', 'Showpieces', 'Decorative Lanterns', 'Festive Decor', 'Decorative Accessories']],
    ['Festive Collection', ['Diwali Collection', 'Christmas Collection', 'Karwachauth Collection', 'Holi Collection', 'Rakhi Collection', 'Navratri Collection', 'Wedding Festivities']],
    ['Gifts & Hampers', ['Wedding Gifts', 'Festive Hampers', 'Return Gifts', 'Towel Hampers', 'Home Decor Gifts', 'Customised Gift Hampers']],
    ['Home Essentials', ['Bath Towels', 'Face Towels', 'Towel Sets', 'Kitchen Linen', 'Table Linen']],
    ['Handcrafted Collection', ['Crochet Products', 'Handmade Decor', 'Resin Art', 'Handcrafted Accessories']],
  ];

  $jewelCols = [
    ['Earrings', ['Jhumkas', 'Studs', 'Chandbalis', 'Drops & Danglers', 'Festive Earrings', 'Daily Wear Earrings']],
    ['Necklaces', ['Matarmala', 'Temple Jewellery', 'Traditional Necklaces', 'Choker Sets', 'Necklace Sets', 'Pendant Sets']],
    ['Bangles & Bracelets', ['Bangles', 'Kada', 'Bracelets', 'Fashion Bracelets']],
    ['Rings', ['Statement Rings', 'Adjustable Rings', 'Traditional Rings', 'Fashion Rings']],
    ['Traditional Accessories', ['Maang Tikka', 'Matha Patti', 'Hair Accessories', 'Anklets']],
    ['Jewellery Sets', ['Bridal Sets', 'Festive Sets', 'Party Wear Sets', 'Necklace & Earring Sets']],
  ];

  $collCols = [
    ['featured', 'Featured', ['New Arrivals', 'Best Sellers', 'Festive Specials', 'Premium Collection', 'Handcrafted Collection']],
    ['occasion', 'Shop by Occasion', ['Wedding', 'Festive', 'Party Wear', 'Daily Wear', 'Housewarming']],
    ['gifts', 'Gift Ideas', ['Gifts for Her', 'Gifts for Home', 'Wedding Gifts', 'Return Gifts', 'Festive Hampers']],
    ['price', 'Price Range', ['Under ₹499', 'Under ₹999', '₹1,000 - ₹1,999', '₹2,000 - ₹4,999', '₹5,000 & Above']],
  ];

  $giftLinks = ['Wedding Gifts', 'Festive Hampers', 'Return Gifts', 'Towel Hampers', 'Customised Gift Hampers'];

  $halves = [
    ['half-home', 'Home & Living', $homeCols],
    ['half-jewel', 'Jewellery & Accessories', $jewelCols],
  ];

  $brandMenus = [
    ['label' => 'Home & Living', 'title' => 'Home & Living', 'cols' => $homeCols, 'img' => 'pro1.png', 'feature' => 'Beautiful Living'],
    ['label' => 'Jewellery', 'title' => 'Jewellery & Accessories', 'cols' => $jewelCols, 'img' => 'pro2.png', 'feature' => 'Timeless Adornment'],
  ];

  $suggestions = [
    ['handloom cotton bedsheet set bedsheets bedding grih shree', 'pro1.png', 'Handloom Cotton Bedsheet Set', 'Handloom & Bedding', '₹2,499'],
    ['kundan choker necklace necklaces choker jewellery pihu jewel', 'pro2.png', 'Kundan Choker Necklace', 'Necklaces', '₹1,899'],
    ['brass diya gift set diya decor festive gifts grih shree', 'pro3.png', 'Brass Diya Gift Set', 'Festive Decor', '₹899'],
    ['pearl drop earrings earrings drops danglers jewellery pihu jewel', 'pro4.png', 'Pearl Drop Earrings', 'Earrings', '₹749'],
    ['jaipuri cotton quilt quilts dohars bedding grih shree', 'pro1.png', 'Jaipuri Cotton Quilt', 'Dohars & Quilts', '₹3,199'],
    ['meenakari bangle set bangles bracelets jewellery pihu jewel', 'pro4.png', 'Meenakari Bangle Set', 'Bangles & Bracelets', '₹1,299'],
    ['hand-painted ceramic planter planter home decor handcrafted grih shree', 'pro3.png', 'Hand-Painted Ceramic Planter', 'Handcrafted Collection', '₹1,099'],
    ['temple jewellery ring set rings temple jewellery pihu jewel', 'pro2.png', 'Temple Jewellery Ring Set', 'Rings', '₹999'],
    ['polki choker necklace set necklace sets choker jewellery pihu jewel', 'pro2.png', 'Polki Choker Necklace Set', 'Necklace Sets', '₹2,299'],
    ['gold plated jhumka earrings jhumkas earrings jewellery pihu jewel', 'pro4.png', 'Gold Plated Jhumka Earrings', 'Jhumkas', '₹849'],
  ];

  $cartItems = [
    ['pro1.png', 'Grih Shree', 'Handloom Cotton Bedsheet Set', 'Pure cotton · Double bed · 2 pillow covers', '₹2,499', '₹3,299', '24% off'],
    ['pro2.png', 'Pihu Jewel', 'Kundan Choker Necklace', 'Handcrafted kundan · Pearl drops', '₹1,899', '₹2,599', '27% off'],
    ['pro3.png', 'Grih Shree', 'Brass Diya Gift Set', 'Set of 4 · Hand-finished · Gift ready', '₹899', '₹1,199', '25% off'],
  ];

  $isHome = request()->is('/');
  $authUser = auth('customer')->user(); // null for guests
  $authInitial = $authUser ? mb_strtoupper(mb_substr(trim((string) $authUser->name), 0, 1)) : '';
@endphp
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Grih Shree & Pihu Jewel')</title>
  @stack('meta')

  <!-- ================= Google Fonts ================= -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- ================= Vendor CSS ================= -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

  <!-- ================= Project CSS ================= -->
  <link rel="stylesheet" href="{{ asset('assets/font/font.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/sass/header/header.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/sass/footer/footer.css') }}" />

  {{-- page specific css (home.css etc.) loads here, same order as the static file --}}
  @stack('styles')

  <!-- ================= Animation / Popup CSS ================= -->
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/fancybox.css') }}" />
</head>

<body>
  <div class="toaster" id="toaster"></div>

  <header>
    <div class="top_header">
      <div class="container-fluid">
        <ul class="top-links left">
          <li><a href="{{ route('dashboard') }}#tab-2">Order Tracking</a></li>
          <li><a href="{{ route('dashboard') }}#tab-1">My Account</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
        </ul>
        <div class="swiper announcement-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <p>A Beautiful World of Home &amp; Jewellery | Explore Our Latest Collections</p>
            </div>
            <div class="swiper-slide">
              <p>Handcrafted Bedding, Decor &amp; Jewellery For Every Occasion</p>
            </div>
            <div class="swiper-slide">
              <p>Free Shipping Across India On Orders Above ₹999</p>
            </div>
          </div>
        </div>
        <div class="top-right">
          <ul class="top-links">
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ url('shipping-policy') }}">Shipping</a></li>
            <li><a href="{{ route('faqs') }}">FAQs</a></li>
          </ul>
          <ul class="top-social">
            <li><a href="javascript:void(0)" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="javascript:void(0)" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="javascript:void(0)" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
            <li><a href="javascript:void(0)" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
            <li><a href="javascript:void(0)" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="header-wrapper">
        <div class="colA">
          <button type="button" class="ham-btn" data-model=".ham-pop" aria-label="Menu">
            <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round">
              <path d="M3 6h18M3 12h18M3 18h18" />
            </svg>
          </button>
          <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Grih Shree + Pihu Jewel"
              title="Grih Shree + Pihu Jewel" />
          </a>
        </div>

        <div class="colB">
          <ul class="menu-list">
            <li class="{{ $isHome ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>

            {{-- ============ SHOP ALL ============ --}}
            <li class="hasMega">
              <a href="{{ route('products') }}">Shop All {!! $chev !!}</a>
              <div class="mega-menu mega-all">
                <div class="container-fluid">
                  <div class="mega-halves">
                    @foreach($halves as [$halfClass, $halfTitle, $cols])
                      <div class="mega-half {{ $halfClass }}">
                        <div class="half-head">
                          <h4>{{ $halfTitle }}</h4>
                          <a href="{{ route('products') }}" class="head-link">View All Collection {!! $arrow !!}</a>
                        </div>
                        <div class="half-grid">
                          @foreach($cols as [$colTitle, $colItems])
                            <div class="mega-col">
                              <a href="{{ route('products') }}" class="col-title">{{ $colTitle }}</a>
                              <ul>
                                @foreach($colItems as $item)
                                  <li><a href="{{ route('products') }}">{{ $item }}</a></li>
                                @endforeach
                              </ul>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </li>

            {{-- ============ HOME & LIVING / JEWELLERY ============ --}}
            @foreach($brandMenus as $menu)
              <li class="hasMega">
                <a href="{{ route('products') }}">{{ $menu['label'] }} {!! $chev !!}</a>
                <div class="mega-menu mega-brand">
                  <div class="container-fluid">
                    <div class="mega-inner">
                      <div class="mega-main">
                        <div class="half-head">
                          <h4>{{ $menu['title'] }}</h4>
                          <a href="{{ route('products') }}" class="head-link">View All Collection {!! $arrow !!}</a>
                        </div>
                        <div class="mega-grid">
                          @foreach($menu['cols'] as [$colTitle, $colItems])
                            <div class="mega-col">
                              <a href="{{ route('products') }}" class="col-title">{{ $colTitle }}</a>
                              <ul>
                                @foreach($colItems as $item)
                                  <li><a href="{{ route('products') }}">{{ $item }}</a></li>
                                @endforeach
                              </ul>
                            </div>
                          @endforeach
                        </div>
                      </div>
                      <div class="mega-feature">
                        <img src="{{ asset('assets/images/home/' . $menu['img']) }}" alt="{{ $menu['feature'] }}"
                          loading="lazy" />
                        <span class="feature-text">
                          <span class="feature-label">{{ $menu['feature'] }}</span>
                          <a href="{{ route('products') }}" class="feature-btn">View All Collection {!! $arrow !!}</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach

            {{-- ============ SHOP BY COLLECTIONS ============ --}}
            <li class="hasMega">
              <a href="{{ route('products') }}">Shop by Collections {!! $chev !!}</a>
              <div class="mega-menu mega-brand">
                <div class="container-fluid">
                  <div class="mega-inner">
                    <div class="mega-main">
                      <div class="half-head">
                        <h4>Shop by Collections</h4>
                        <a href="{{ route('products') }}" class="head-link">View All Collection {!! $arrow !!}</a>
                      </div>
                      <div class="mega-grid cols-4">
                        @foreach($collCols as [$slug, $colTitle, $colItems])
                          <div class="mega-col">
                            <span class="col-title">{{ $colTitle }}</span>
                            <ul>
                              @foreach($colItems as $item)
                                <li><a href="{{ route('products') }}">{{ $item }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="mega-feature">
                      <img src="{{ asset('assets/images/home/pro3.png') }}" alt="Festive Specials" loading="lazy" />
                      <span class="feature-text">
                        <span class="feature-label">Festive Specials</span>
                        <a href="{{ route('products') }}" class="feature-btn">View All Collection {!! $arrow !!}</a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            {{-- ============ GIFTS ============ --}}
            <li class="hasDrop">
              <a href="{{ route('products') }}">Gifts {!! $chev !!}</a>
              <ul class="drop-menu">
                @foreach($giftLinks as $gift)
                  <li><a href="{{ route('products') }}">{{ $gift }}</a></li>
                @endforeach
              </ul>
            </li>

            <li><a href="{{ route('about') }}">About Us</a></li>
          </ul>
        </div>

        <div class="colC">
          <div class="search-box-wrapper">
            <button type="button" class="action-link search-btn" aria-label="Search">
              <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round">
                <circle cx="11" cy="11" r="7.5" />
                <path d="M16.5 16.5L21 21" />
              </svg>
            </button>
            <div class="formField">
              <input type="text" class="searchInput"
                placeholder="Search for bedsheets, home decor, earrings, necklaces..." autocomplete="off" />
              <div class="search-results">
                <span class="res-label">Suggestions</span>
                <ul class="res-list">
                  @foreach($suggestions as [$keys, $img, $name, $cat, $price])
                    <li data-name="{{ $keys }}">
                      <a href="#">
                        <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $name }}" />
                        <span class="res-info"><strong>{{ $name }}</strong><small>{{ $cat }}</small></span>
                        <span class="res-price">{{ $price }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
                <p class="res-empty">No products found. Try another keyword.</p>
                <a href="{{ route('products') }}" class="res-all">View All Results <i
                    class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <a href="{{ $authUser ? route('user.dashboard.index') . '#tab-4' : 'javascript:void(0)' }}"
            class="action-link" @unless($authUser) data-model=".login-pop" @endunless aria-label="Wishlist">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 20.5s-8-4.9-8-11A4.6 4.6 0 0112 6.8a4.6 4.6 0 018 2.7c0 6.1-8 11-8 11z" />
            </svg>
            <span class="count wishlist-count">{{ $wishCount ?? 0 }}</span>
          </a>

          @if($authUser)
            <div class="account-wrapper">
              <button type="button" class="action-link account-btn" aria-label="Account" title="Account">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round">
                  <circle cx="12" cy="8" r="4.2" />
                  <path d="M4 21c0-4.4 3.6-7.5 8-7.5s8 3.1 8 7.5" />
                </svg>
              </button>
              <div class="account-drop">
                <div class="acc-user">
                  <span class="acc-avatar">{{ $authInitial }}</span>
                  <div class="acc-name">
                    <strong>{{ $authUser->name }}</strong>
                    <small>{{ $authUser->email }}</small>
                  </div>
                </div>
                <ul class="acc-list">
                  <li><a href="{{ route('user.dashboard.index') }}#tab-1"><i class="fa-solid fa-table-columns"></i> My
                      Account</a></li>
                  <li><a href="{{ route('user.dashboard.index') }}#tab-2"><i class="fa-solid fa-truck-fast"></i> Track
                      Order</a></li>
                  <li><a href="{{ route('user.dashboard.index') }}#tab-3"><i class="fa-solid fa-box-open"></i> My
                      Orders</a></li>
                  <li><a href="{{ route('user.dashboard.index') }}#tab-4"><i class="fa-regular fa-heart"></i> My
                      Wishlist</a></li>
                  <li><a href="{{ route('user.dashboard.index') }}#tab-5"><i class="fa-regular fa-user"></i> My
                      Profile</a></li>
                  <li class="acc-out">
                    <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()">
                      <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                    </a>
                  </li>
                </ul>
                <form id="logoutForm" action="{{ route('user.logout') }}" method="POST" style="display:none">@csrf</form>
              </div>
            </div>
          @else
            <div class="account-wrapper">
              <a href="javascript:void(0)" class="action-link" data-model=".login-pop" aria-label="Login / Register"
                title="Login / Register">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round">
                  <circle cx="12" cy="8" r="4.2" />
                  <path d="M4 21c0-4.4 3.6-7.5 8-7.5s8 3.1 8 7.5" />
                </svg>
              </a>
            </div>
          @endif

          <a href="javascript:void(0)" data-model=".cart-pop" class="action-link" aria-label="Cart">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 8h14l-1 12.5H6L5 8z" />
              <path d="M8.5 8V6.5a3.5 3.5 0 017 0V8" />
            </svg>
            <span class="count cart-count">{{ $cartCount }}</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    <div class="footer-wrapper">
      <ul class="footer-top">
        <li>
          <span class="ft-icon"><i class="fa-regular fa-gem"></i></span>
          <div class="content">
            <p>Thoughtfully Curated</p><span>Home &amp; jewellery, chosen with care</span>
          </div>
        </li>
        <li>
          <span class="ft-icon"><i class="fa-solid fa-hand-holding-heart"></i></span>
          <div class="content">
            <p>Handcrafted Details</p><span>Treasures with real character</span>
          </div>
        </li>
        <li>
          <span class="ft-icon"><i class="fa-solid fa-truck-fast"></i></span>
          <div class="content">
            <p>Convenient Delivery</p><span>Clear shipping information</span>
          </div>
        </li>
        <li>
          <span class="ft-icon"><i class="fa-solid fa-shield-halved"></i></span>
          <div class="content">
            <p>Secure Payments</p><span>Safe and trusted checkout</span>
          </div>
        </li>
      </ul>
    </div>

    <div class="footer-wrapper-bottom">
      <div class="footer-middle">
        <div class="container">
          <div class="foot-cols">
            <div class="colA">
              <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Grih Shree &amp; Pihu Jewel" />
              </a>
              <p class="brand-desc">
                Grih Shree &amp; Pihu Jewel brings together thoughtfully curated home essentials, handcrafted
                treasures and beautiful jewellery. Discover two distinctive collections, all in one place.
              </p>
              <ul class="social">
                <li><a href="javascript:void(0)" aria-label="Grih Shree Studio on Instagram"
                    title="Grih Shree Studio"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="javascript:void(0)" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="javascript:void(0)" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                </li>
                <li><a href="javascript:void(0)" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a></li>
                <li><a href="javascript:void(0)" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="javascript:void(0)" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                </li>
              </ul>
            </div>

            <div class="colB">
              <h5>Shop Grih Shree</h5>
              <ul>
                @foreach($homeCols as [$colTitle, $colItems])
                  <li><a href="{{ route('products') }}">{{ $colTitle }}</a></li>
                @endforeach
              </ul>
            </div>

            <div class="colC">
              <h5>Shop Pihu Jewel</h5>
              <ul>
                @foreach($jewelCols as [$colTitle, $colItems])
                  <li><a href="{{ route('products') }}">{{ $colTitle }}</a></li>
                @endforeach
              </ul>
            </div>

            <div class="colD">
              <h5>Customer Care</h5>
              <ul>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('blogs') }}">Blog</a></li>
                <li><a href="{{ route('faqs') }}">FAQs</a></li>
                <li><a href="{{ url('shipping-policy') }}">Shipping Information</a></li>
                <li><a href="{{ url('returns-exchange') }}">Returns &amp; Refunds</a></li>
                <li><a href="{{ url('refund-cancellation-policy') }}">Refund &amp; Cancellation</a></li>
                <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="{{ url('terms-conditions') }}">Terms &amp; Conditions</a></li>
              </ul>
            </div>

            <div class="colE">
              <h5>My Account</h5>
              <ul>
                <li><a href="{{ route('dashboard') }}#tab-1">My Account</a></li>
                <li><a href="{{ route('dashboard') }}#tab-2">Track Order</a></li>
                <li><a href="{{ route('dashboard') }}#tab-3">My Orders</a></li>
                <li><a href="{{ route('dashboard') }}#tab-4">My Wishlist</a></li>
                <li><a href="{{ route('dashboard') }}#tab-5">My Profile</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="container">
          <p class="copyright">Copyright &copy; {{ date('Y') }} Grih Shree &amp; Pihu Jewel. All Rights Reserved.</p>
          <p class="credit">
            Design &amp; Developed by
            <a href="javascript:void(0)" target="_blank" rel="noopener">Web Mingo</a>.
          </p>
          <ul class="payment">
            <li><i class="fa-brands fa-cc-visa" aria-label="Visa"></i></li>
            <li><i class="fa-brands fa-cc-mastercard" aria-label="Mastercard"></i></li>
            <li><i class="fa-brands fa-cc-amex" aria-label="American Express"></i></li>
            <li><i class="fa-brands fa-google-pay" aria-label="Google Pay"></i></li>
          </ul>
        </div>
      </div>
    </div>

    <nav class="float-menu" aria-label="Quick navigation">
      <a href="{{ route('home') }}" class="float-link {{ $isHome ? 'active' : '' }}"><i
          class="fa-solid fa-house"></i><span>Home</span></a>
      <button type="button" class="float-link" data-model=".ham-pop" aria-label="Menu">
        <i class="fa-solid fa-bars"></i><span>Menu</span>
      </button>
      <a href="{{ route('dashboard') }}#tab-4" class="float-link"><i
          class="fa-regular fa-heart"></i><span>Wishlist</span><b class="f-count wishlist-count">{{ $wishCount ?? 0 }}</b></a>
      <a href="{{ route('cart') }}" class="float-link"><i class="fa-solid fa-bag-shopping"></i><span>Bag</span><b
          class="f-count cart-count">{{ $cartCount }}</b></a>
      @if($authUser)
        <a href="{{ route('user.dashboard.index') }}#tab-1" class="float-link"><i
            class="fa-regular fa-user"></i><span>Account</span></a>
      @else
        <button type="button" class="float-link" data-model=".login-pop" aria-label="Login">
          <i class="fa-regular fa-user"></i><span>Login</span>
        </button>
      @endif
    </nav>
  </footer>

  <!-- ================= Models ================= -->

  {{-- CART POPUP (only #miniCartBody is replaced via AJAX) --}}
  <div class="model cart-pop" data-update-url="{{ route('cart.update-quantity') }}"
    data-remove-url="{{ route('cart.remove', '__ID__') }}">
    <button class="close" type="button">
      <p>Close</p>
      <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
        <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
    <div class="model-body" id="miniCartBody">
      @include('layouts.mini-cart', ['miniCart' => $miniCart])
    </div>
  </div>

  {{-- MOBILE MENU --}}
  <div class="ham-pop">
    <div class="ham-body">
      <div class="ham-top">
        <button type="button" class="ham-back" data-ham-back>
          <i class="fa-solid fa-arrow-left" aria-hidden="true"></i><span>Back</span>
        </button>
        <a href="{{ route('home') }}" class="ham-logo">
          <img src="{{ asset('assets/images/logo.png') }}" alt="Grih Shree + Pihu Jewel"
            title="Grih Shree + Pihu Jewel" />
        </a>
        <button class="close close-btn" type="button" aria-label="Close menu">
          <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
      </div>

      <div class="ham-views">
        {{-- MAIN --}}
        <div class="ham-view is-active" data-ham-view="main" data-ham-title="Menu">
          <ul class="ham-list">
            <li class="{{ $isHome ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products') }}">Shop All</a></li>
            @foreach([['home-living', 'Home & Living'], ['jewellery', 'Jewellery'], ['collection', 'Shop by Collections'], ['gifts', 'Gifts']] as [$target, $label])
              <li>
                <button type="button" class="ham-link" data-ham-open="{{ $target }}">
                  <span class="ham-link-text">{{ $label }}</span>
                  <span class="ham-arrow"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></span>
                </button>
              </li>
            @endforeach
          </ul>
          <ul class="ham-list ham-list--minor">
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('dashboard') }}#tab-2">Track Order</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
          </ul>
        </div>

        {{-- HOME & LIVING --}}
        <div class="ham-view" data-ham-view="home-living" data-ham-title="Home &amp; Living" aria-hidden="true">
          <div class="ham-head">
            <h3 class="ham-title">Home &amp; Living</h3>
            <p class="ham-sub">Grih Shree, thoughtful pieces for beautiful spaces.</p>
          </div>
          <ul class="ham-list ham-list--sub">
            @foreach($homeCols as [$colTitle, $colItems])
              <li><a href="{{ route('products') }}">{{ $colTitle }}</a></li>
            @endforeach
            <li class="ham-all">
              <a href="{{ route('products') }}">Explore All Home &amp; Living <i class="fa-solid fa-arrow-right"
                  aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>

        {{-- JEWELLERY --}}
        <div class="ham-view" data-ham-view="jewellery" data-ham-title="Jewellery" aria-hidden="true">
          <div class="ham-head">
            <h3 class="ham-title">Jewellery</h3>
            <p class="ham-sub">Pihu Jewel, timeless adornment for every occasion.</p>
          </div>
          <ul class="ham-list ham-list--sub">
            @foreach($jewelCols as [$colTitle, $colItems])
              <li><a href="{{ route('products') }}">{{ $colTitle }}</a></li>
            @endforeach
            <li class="ham-all">
              <a href="{{ route('products') }}">Explore All Jewellery <i class="fa-solid fa-arrow-right"
                  aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>

        {{-- SHOP BY COLLECTIONS --}}
        <div class="ham-view" data-ham-view="collection" data-ham-title="Shop by Collections" aria-hidden="true">
          <div class="ham-head">
            <h3 class="ham-title">Shop by Collections</h3>
          </div>
          <ul class="ham-list">
            @foreach($collCols as [$slug, $colTitle, $colItems])
              <li>
                <button type="button" class="ham-link" data-ham-open="collection-{{ $slug }}">
                  <span class="ham-link-text">{{ $slug === 'featured' ? 'Featured' : $colTitle }}</span>
                  <span class="ham-arrow"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></span>
                </button>
              </li>
            @endforeach
          </ul>
        </div>

        @foreach($collCols as [$slug, $colTitle, $colItems])
          <div class="ham-view" data-ham-view="collection-{{ $slug }}" data-ham-title="Shop by Collections"
            aria-hidden="true">
            <div class="ham-head">
              <h3 class="ham-title">{{ $colTitle }}</h3>
            </div>
            <ul class="ham-list ham-list--sub">
              @foreach($colItems as $item)
                <li><a href="{{ route('products') }}">{{ $item }}</a></li>
              @endforeach
            </ul>
          </div>
        @endforeach

        {{-- GIFTS --}}
        <div class="ham-view" data-ham-view="gifts" data-ham-title="Gifts" aria-hidden="true">
          <div class="ham-head">
            <h3 class="ham-title">Gifts</h3>
            <p class="ham-sub">Thoughtful gifts for meaningful moments.</p>
          </div>
          <ul class="ham-list ham-list--sub">
            @foreach($giftLinks as $gift)
              <li><a href="{{ route('products') }}">{{ $gift }}</a></li>
            @endforeach
            <li class="ham-all">
              <a href="{{ route('products') }}">Explore All Gifts <i class="fa-solid fa-arrow-right"
                  aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="ham-bottom">
        <div class="ham-social">
          <a href="javascript:void(0)" target="_blank" title="Facebook" aria-label="Facebook"><i
              class="fa-brands fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/grihshreestudio/" target="_blank" rel="noopener" title="Instagram"
            aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="javascript:void(0)" target="_blank" title="Pinterest" aria-label="Pinterest"><i
              class="fa-brands fa-pinterest-p"></i></a>
          <a href="javascript:void(0)" target="_blank" title="YouTube" aria-label="YouTube"><i
              class="fa-brands fa-youtube"></i></a>
          <a href="https://wa.me/919876543210" target="_blank" rel="noopener" title="WhatsApp" aria-label="WhatsApp"><i
              class="fa-brands fa-whatsapp"></i></a>
        </div>
        <a href="{{ route('products') }}" class="btn btn-primary header-cta">
          <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Shop New Arrivals
        </a>
      </div>
    </div>
  </div>

  {{-- LOGIN / REGISTER POPUP --}}
  <div class="model login-pop">
    <button class="close" type="button">
      <p>Close</p>
      <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
        <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
    <div class="model-body">
      <a href="{{ route('home') }}" class="pop-logo" aria-label="Grih Shree + Pihu Jewel Home">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Grih Shree + Pihu Jewel" />
      </a>
      <div class="pop-title">
        <h3>Welcome Back</h3>
        <p>Login or create an account to track your orders, save your wishlist and check out faster.</p>
      </div>
      <ul class="tab-nav">
        <li class="active" data-tab="pop-login">Login</li>
        <li data-tab="pop-register">Create Account</li>
      </ul>
      <div class="tab-nav-content">
        <div class="tabs active" data-tab="pop-login">
          <form class="form pop-form" novalidate>
            <div class="form-group">
              <input type="text" id="popLoginId" name="login_id" placeholder=" " autocomplete="username" />
              <label for="popLoginId">Email or Mobile Number</label>
            </div>
            <div class="form-group">
              <input type="password" id="popLoginPass" name="password" placeholder=" "
                autocomplete="current-password" />
              <label for="popLoginPass">Password</label>
            </div>
            <div class="pop-meta"><a href="javascript:void(0);">Forgot password?</a></div>
            <button type="submit" class="btn btn-primary pop-submit">Login</button>
          </form>
          <div class="pop-divider"><span>or</span></div>
          <button type="button" class="pop-google">{!! $googleSvg !!} Continue with Google</button>
        </div>

        <div class="tabs" data-tab="pop-register">
          <form class="form pop-form" novalidate>
            <div class="form-group">
              <input type="text" id="popRegName" name="full_name" placeholder=" " autocomplete="name" />
              <label for="popRegName">Full Name</label>
            </div>
            <div class="form-group">
              <input type="email" id="popRegEmail" name="email" placeholder=" " autocomplete="email" />
              <label for="popRegEmail">Email Address</label>
            </div>
            <div class="pop-row">
              <div class="form-group">
                <input type="tel" id="popRegMobile" name="mobile" placeholder=" " inputmode="numeric" maxlength="10"
                  autocomplete="tel" />
                <label for="popRegMobile">Mobile Number</label>
              </div>
              <div class="form-group">
                <input type="tel" id="popRegAlt" name="alternate_mobile" placeholder=" " inputmode="numeric"
                  maxlength="10" autocomplete="off" />
                <label for="popRegAlt">Alternate (optional)</label>
              </div>
            </div>
            <div class="form-group">
              <input type="password" id="popRegPass" name="password" placeholder=" " autocomplete="new-password" />
              <label for="popRegPass">Create Password</label>
            </div>
            <div class="form-group">
              <input type="password" id="popRegConfirm" name="password_confirmation" placeholder=" "
                autocomplete="new-password" />
              <label for="popRegConfirm">Confirm Password</label>
            </div>
            <button type="submit" class="btn btn-primary pop-submit">Create My Account</button>
            <p class="pop-note">
              By continuing, you agree to our
              <a href="{{ url('terms-conditions') }}">Terms &amp; Conditions</a> and
              <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </p>
          </form>
          <div class="pop-divider"><span>or</span></div>
          <button type="button" class="pop-google">{!! $googleSvg !!} Continue with Google</button>
        </div>
      </div>
    </div>
  </div>

  {{-- QUICK VIEW POPUP (filled by JS) --}}
  <div class="model product-view-pop">
    <div class="model-body">
      <button class="close close-btn" type="button" aria-label="Close quick view">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>

      <p class="pvp-state" style="text-align:center;padding:60px 20px">Loading...</p>

      <div class="pvp-grid" style="display:none">
        <div class="pvp-visual">
          <img class="pvp-img" src="" alt="" />
          <span class="pvp-badge" style="display:none">New</span>
          <div class="pvp-thumbs" style="display:none;gap:8px;margin-top:10px"></div>
        </div>
        <div class="pvp-content">
          <div class="pvp-meta">
            <span class="pvp-cat"></span>
            <span class="pvp-rate" style="display:none"><i class="fa-solid fa-star"></i> <b></b></span>
          </div>
          <h4 class="pvp-title"></h4>
          <div class="pvp-price">
            <span class="price-now"></span>
            <del class="price-old"></del>
            <span class="price-off"></span>
          </div>
          <p class="pvp-desc"></p>

          <div class="pvp-options"></div>

          <p class="pvp-stock" style="font-size:13px;margin:6px 0 12px"></p>

          <div class="pvp-actions">
            <div class="pvp-qty qty">
              <button type="button" class="pvp-qty-minus" aria-label="Decrease quantity"><i
                  class="fa-solid fa-minus"></i></button>
              <input type="text" class="pvp-qty-input" value="1" readonly />
              <button type="button" class="pvp-qty-plus" aria-label="Increase quantity"><i
                  class="fa-solid fa-plus"></i></button>
            </div>
            <button type="button" class="btn btn-outline-black pvp-cart">Add to Cart</button>
          </div>
          <button type="button" class="btn btn-primary pvp-buy">Buy Now <i
              class="fa-solid fa-arrow-right-long"></i></button>
          <a href="#" class="pvp-full"
            style="display:block;text-align:center;margin-top:12px;font-size:13px;text-decoration:underline">View Full
            Details</a>
        </div>
      </div>
    </div>
  </div>

  {{-- WELCOME OFFER POPUP --}}
  <div class="model offer-pop">
    <div class="model-body">
      <button class="close close-btn" type="button" aria-label="Close offer">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>
      <div class="op-grid">
        <div class="op-visual">
          <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Welcome to Grih Shree and Pihu Jewel"
            loading="lazy" />
          <span class="op-badge"><b>10%</b> Off First Order</span>
        </div>
        <div class="op-content">
          <span class="op-eyebrow">A Welcome Gift</span>
          <h4 class="op-title">A Beautiful Beginning</h4>
          <p class="op-desc">Enjoy a special welcome offer on your first order of home essentials and jewellery.</p>
          <div class="op-price">
            <span class="op-save">Extra 10% Off</span>
            <span class="op-min">on your first order</span>
          </div>
          <div class="op-coupon">
            <span class="op-label">Use Coupon Code</span>
            <div class="op-code-box">
              <span class="op-code">WELCOME10</span>
              <button type="button" class="op-copy coupon-copy" data-code="WELCOME10"><span>Copy Code</span></button>
            </div>
          </div>
          <ul class="op-points">
            <li><i class="fa-solid fa-check"></i> Home &amp; Living and Jewellery</li>
            <li><i class="fa-solid fa-check"></i> Free shipping above ₹999</li>
          </ul>
          <div class="op-btns">
            <a href="{{ route('products') }}" class="btn btn-primary">Shop Now <i
                class="fa-solid fa-arrow-right-long"></i></a>
            <a href="{{ route('products') }}" class="btn btn-outline-primary">View Offers</a>
          </div>
          <p class="op-note">*Terms &amp; conditions apply.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="overlay"></div>

  <!-- ================= jQuery ================= -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.min.js"
    integrity="sha512-771ZvVCYr4EfUGXr63AcX7thw7EKa6QE1fhxi8JG7mPacB/arC0cyvYPXKUkCrX2sYKnnFCZby3ZZik42jOuSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"
    integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

  <!-- ================= Swiper ================= -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>

  <!-- ================= Project JS ================= -->
  <script src="{{ asset('assets/js/animate.js') }}"></script>
  <script src="{{ asset('assets/js/fancybox.js') }}"></script>
  <script src="{{ asset('assets/js/function.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
    $(window).on("load scroll", function () {
      setTimeout(function () {
        $("header").addClass("header-fixed");
      }, 10);
    });
  </script>

  <script>
    (function () {
      var CSRF = $('meta[name="csrf-token"]').attr("content");
      var $pop = function () { return $(".cart-pop"); };

      // after any cart change: header count + popup content (popup stays open)
      $(document).on("cart:updated", function (e, res) {
        if (!res) return;
        if (res.cart_count !== undefined) $(".cart-count").text(res.cart_count);
        if (res.mini_cart_html) $("#miniCartBody").html(res.mini_cart_html);
        if (res.open !== false) {
          $('.action-link[data-model=".cart-pop"]').first().trigger("click");
        }
      });

      function fail(xhr) {
        var j = xhr.responseJSON || {};
        alert(j.message || "Something went wrong. Please try again.");
      }

      // qty +/-
      $(document).on("click", ".cp-qty-btn", function () {
        var $b = $(this);
        if ($b.data("busy")) return;
        $b.data("busy", true);
        $.ajax({
          url: $pop().data("update-url"),
          method: "POST",
          data: { item_id: $b.data("id"), action: $b.data("act") },
          headers: { "X-CSRF-TOKEN": CSRF, Accept: "application/json" }
        })
          .done(function (res) { $(document).trigger("cart:updated", [$.extend({ open: false }, res)]); })
          .fail(fail)
          .always(function () { $b.data("busy", false); });
      });

      // remove
      $(document).on("click", ".cp-remove", function () {
        var $b = $(this);
        if ($b.data("busy")) return;
        $b.data("busy", true);
        $.ajax({
          url: String($pop().data("remove-url")).replace("__ID__", $b.data("id")),
          method: "DELETE",   // route POST ho to "POST" kar do
          headers: { "X-CSRF-TOKEN": CSRF, Accept: "application/json" }
        })
          .done(function (res) { $(document).trigger("cart:updated", [$.extend({ open: false }, res)]); })
          .fail(fail)
          .always(function () { $b.data("busy", false); });
      });
    })();
  </script>
  <script>
    (function () {
      var URL = {
        login: "{{ route('checkout.ajax-login') }}",
        reg: "{{ route('checkout.ajax-register') }}",
        google: "{{ route('user.google.login') }}"
      };

      function firstError(xhr) {
        var j = xhr.responseJSON || {};
        if (j.errors) return Object.values(j.errors)[0][0];
        return j.message || "Something went wrong. Please try again.";
      }

      function msg($f, text) {
        var $m = $f.find(".pop-msg");
        if (!$m.length) {
          $m = $('<p class="pop-msg" style="color:#c0392b;font-size:13px;margin:8px 0"></p>').insertBefore($f.find(".pop-submit"));
        }
        $m.text(text);
      }

      $(document).on("submit", ".login-pop .pop-form", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var $f = $(this), $btn = $f.find(".pop-submit"), isReg = $f.find('[name="full_name"]').length > 0;
        if ($btn.prop("disabled")) return;

        var v = function (n) { return $.trim($f.find('[name="' + n + '"]').val()); };
        var pass = $f.find('[name="password"]').val();
        var data = isReg
          ? {
            name: v("full_name"), email: v("email"), mobile: v("mobile"), alternate_mobile: v("alternate_mobile"),
            password: pass, password_confirmation: $f.find('[name="password_confirmation"]').val()
          }
          : { login_id: v("login_id"), password: pass };

        $btn.prop("disabled", true);
        msg($f, "");

        $.ajax({
          url: isReg ? URL.reg : URL.login, method: "POST", data: data,
          headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), Accept: "application/json" }
        })
          .done(function (res) {
            if (res.csrf_token) {
              $('meta[name="csrf-token"]').attr("content", res.csrf_token);
              $.ajaxSetup({ headers: { "X-CSRF-TOKEN": res.csrf_token } });
            }
            $(".login-pop .close").first().trigger("click");

            // a page can handle this itself (payment page continues to the gateway); default is a reload
            var ev = $.Event("auth:success");
            $(document).trigger(ev, [res]);
            if (!ev.isDefaultPrevented()) window.location.reload();
          })
          .fail(function (xhr) { msg($f, firstError(xhr)); })
          .always(function () { $btn.prop("disabled", false); });
      });

      $(document).on("click", ".login-pop .pop-google", function () {
        window.location.href = URL.google + "?redirect=" + encodeURIComponent(window.location.href);
      });
    })();
  </script>
  <script>
    window.SHOP = {
      cartAdd: "{{ route('cart.add') }}",
      wishToggle: "{{ route('wishlist.toggle') }}",
      quickView: "{{ route('product.quick-view', '__ID__') }}",
      cartUrl: "{{ url('cart') }}",
      loggedIn: @json((bool) auth('customer')->check())
    };
  </script>
  <script>
    $(function () {
      var CSRF = $('meta[name="csrf-token"]').attr('content');
      var HEAD = { "X-CSRF-TOKEN": CSRF, Accept: "application/json" };

      function notify(type, title, text) {
        if (typeof window.showToast === "function") return window.showToast(title, text, type);
        var $t = $('<div></div>').text(title + (text ? " - " + text : "")).css({
          position: "fixed", right: "20px", bottom: "20px", zIndex: 99999, padding: "12px 18px",
          borderRadius: "8px", color: "#fff", background: type === "success" ? "#1f8a5b" : "#c0392b"
        }).appendTo("body");
        setTimeout(function () { $t.fadeOut(300, function () { $t.remove(); }); }, 2800);
      }

      function openLogin() { $('[data-model=".login-pop"]').first().trigger("click"); }

      // ---------- card: add to cart ----------
      $(document).on("click", ".js-card-cart", function (e) {
        e.preventDefault();
        var $b = $(this);

        // products with size/colour etc. need a choice, so send to the detail page
        if ($b.prop("disabled") || $b.data("busy")) return;
        $b.data("busy", true).addClass("is-loading");

        $.ajax({
          url: window.SHOP.cartAdd, method: "POST", headers: HEAD,
          data: { product_id: $b.data("product-id"), quantity: Number($b.data("min-qty")) || 1 }
        })
          .done(function (res) {
            if (!res.status) return notify("error", "Could not add", res.message);
            $(document).trigger("cart:updated", [res]);
            notify("success", "Added to Cart", $b.data("name") + " has been added to your cart.");
          })
          .fail(function (xhr) {
            var j = xhr.responseJSON || {}, msg = j.message || "Something went wrong. Please try again.";
            if (j.errors) msg = Object.values(j.errors)[0][0];
            notify("error", "Could not add", msg);
          })
          .always(function () { $b.data("busy", false).removeClass("is-loading"); });
      });

      // ---------- card: wishlist ----------
      function paintWish(pid, on) {
        // updates every card of this product on the page (and the detail-page heart)
        $('.js-card-wish[data-product-id="' + pid + '"], .js-wish[data-product-id="' + pid + '"]')
          .toggleClass("is-active", on).attr("aria-pressed", on)
          .find("i").attr("class", (on ? "fa-solid" : "fa-regular") + " fa-heart");
      }

      $(document).on("click", ".js-card-wish", function (e) {
        e.preventDefault();
        var $b = $(this), pid = $b.data("product-id");

        if (!window.SHOP.loggedIn) { openLogin(); return; }
        if ($b.data("busy")) return;
        $b.data("busy", true);

        $.ajax({ url: window.SHOP.wishToggle, method: "POST", headers: HEAD, data: { product_id: pid } })
          .done(function (res) {
            res = res || {};
            if (res.status === false || res.success === false)
              return notify("error", "Wishlist", res.message || "Could not update wishlist.");
            var on = res.added !== undefined ? !!res.added
              : res.wishlisted !== undefined ? !!res.wishlisted
                : res.in_wishlist !== undefined ? !!res.in_wishlist
                  : !$b.hasClass("is-active");
            paintWish(pid, on);
            if (res.count !== undefined) $(".wishlist-count").text(res.count);
            notify("success", on ? "Added to Wishlist" : "Removed from Wishlist", $b.closest(".prod_cart").find(".prod-name").text().trim());
          })
          .fail(function (xhr) {
            if (xhr.status === 401 || xhr.status === 419) return openLogin();
            notify("error", "Wishlist", (xhr.responseJSON || {}).message || "Something went wrong. Please try again.");
          })
          .always(function () { $b.data("busy", false); });
      });
    });
  </script>
  <style>
    .pvp-size-list label.pvp-swatch {
      width: 30px;
      height: 30px;
      min-width: 30px;
      padding: 0;
      border-radius: 50%;
      background: var(--c, #ccc);
      border: 1px solid #ddd
    }

    .pvp-size-list input:checked+label.pvp-swatch {
      box-shadow: 0 0 0 2px #fff, 0 0 0 4px #000
    }

    .pvp-thumbs button {
      width: 52px;
      height: 52px;
      padding: 0;
      border: 1px solid #ddd;
      background: none;
      cursor: pointer
    }

    .pvp-thumbs button.active {
      border-color: #000
    }

    .pvp-thumbs img {
      width: 100%;
      height: 100%;
      object-fit: cover
    }

    .pvp-stock.is-out {
      color: #c0392b
    }

    .pvp-stock.is-low {
      color: #d68910
    }
  </style>
  <script>
    $(function () {
      var $pop = $(".product-view-pop");
      var HEAD = function () { return { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), Accept: "application/json" }; };
      var QV = null, token = 0, maxQty = 10;

      var money = function (n) { return "₹" + Math.round(n).toLocaleString("en-US"); };
      var esc = function (s) { return $("<div>").text(s == null ? "" : s).html(); };
      var qty = function () { return parseInt($pop.find(".pvp-qty-input").val(), 10) || QV.minQty; };

      function toast(type, title, text) {
        if (typeof window.showToast === "function") return window.showToast(title, text, type);
        var $t = $("<div></div>").text(title + (text ? " - " + text : "")).css({
          position: "fixed", right: "20px", bottom: "20px", zIndex: 99999, padding: "12px 18px",
          borderRadius: "8px", color: "#fff", background: type === "success" ? "#1f8a5b" : "#c0392b"
        }).appendTo("body");
        setTimeout(function () { $t.fadeOut(300, function () { $t.remove(); }); }, 2800);
      }

      // ---------- open + load ----------
      $(document).on("click", ".js-quick", function () {
        var id = $(this).data("product-id"), my = ++token;
        QV = null;
        $pop.find(".pvp-grid").hide();
        $pop.find(".pvp-state").text("Loading...").show();

        $.getJSON(window.SHOP.quickView.replace("__ID__", id))
          .done(function (d) { if (my === token) render(d); })
          .fail(function () { if (my === token) $pop.find(".pvp-state").text("Could not load this product. Please try again."); });
      });

      function render(d) {
        var base = (d.pd && d.pd.base) || {};
        QV = { d: d, pd: d.pd || { base: {}, variants: {} }, minQty: base.minQty || 1, cur: { mrp: base.mrp || 0, price: base.price || 0 }, img: "orig" };

        $pop.find(".pvp-cat").text(d.brand || "");
        $pop.find(".pvp-title").text(d.name);
        $pop.find(".pvp-desc").text(d.desc || "").toggle(!!d.desc);
        $pop.find(".pvp-full").attr("href", d.url);
        if (d.badge) $pop.find(".pvp-badge").text(d.badge[2]).show();
        else if (d.is_new) $pop.find(".pvp-badge").text("New").show();
        else $pop.find(".pvp-badge").hide();
        if (d.rate) $pop.find(".pvp-rate").show().find("b").text(d.rate); else $pop.find(".pvp-rate").hide();

        setImages(d.gallery || []);

        // options
        var html = (d.options || []).map(function (o) {
          var vals = o.values.map(function (v, i) {
            var id = "qv" + o.id + "_" + v.id, chk = i === 0 ? " checked" : "";
            var input = '<input type="radio" name="qv' + o.id + '" id="' + id + '" value="' + v.id + '" data-name="' + esc(v.name) + '"' + chk + ' />';
            return o.swatch
              ? input + '<label for="' + id + '" class="pvp-swatch" title="' + esc(v.name) + '" style="--c:' + esc(v.color || "#cccccc") + '"></label>'
              : input + '<label for="' + id + '">' + esc(v.name) + '</label>';
          }).join("");
          return '<div class="pvp-size"><span class="pvp-label">' + esc(o.name) + ': <b class="pvp-opt-val">' + esc(o.values[0].name) + '</b></span><div class="pvp-size-list">' + vals + '</div></div>';
        }).join("");
        $pop.find(".pvp-options").html(html);

        $pop.find(".pvp-qty-input").val(QV.minQty);
        $pop.find(".pvp-state").hide();
        $pop.find(".pvp-grid").show();
        refresh();
      }

      // ---------- images ----------
      function setImages(list) {
        if (!list.length) return;
        $pop.find(".pvp-img").attr({ src: list[0].url, alt: QV.d.name });
        var $t = $pop.find(".pvp-thumbs");
        if (list.length > 1) {
          $t.html(list.map(function (g, n) {
            return '<button type="button" class="' + (n ? "" : "active") + '" data-src="' + esc(g.url) + '"><img src="' + esc(g.thumb || g.url) + '" alt="" /></button>';
          }).join("")).css("display", "flex");
        } else { $t.hide().empty(); }
      }
      $(document).on("click", ".pvp-thumbs button", function () {
        $(this).addClass("active").siblings().removeClass("active");
        $pop.find(".pvp-img").attr("src", $(this).data("src"));
      });

      // ---------- variants (same logic as the detail page) ----------
      function selectedIds() {
        return $pop.find(".pvp-options input:checked").map(function () { return parseInt(this.value, 10); }).get();
      }
      function pick(type, sel) {
        var list = (QV.pd.variants && QV.pd.variants[type]) || [], best = null;
        list.forEach(function (v) {
          if (!v.values.length) return;
          var ok = v.values.every(function (id) { return sel.indexOf(id) !== -1; });
          if (ok && (!best || v.values.length > best.values.length)) best = v;
        });
        return best;
      }

      function renderPrice() {
        var q = qty(), c = QV.cur;
        var pct = c.mrp > c.price ? Math.round((c.mrp - c.price) / c.mrp * 100) : 0;
        $pop.find(".price-now").text(money(c.price * q));
        $pop.find(".price-old").text(money(c.mrp * q)).toggle(pct > 0);
        $pop.find(".price-off").text(pct + "% OFF").toggle(pct > 0);
      }

      function refresh() {
        if (!QV) return;
        var sel = selectedIds(), base = QV.pd.base || {};
        var pv = pick("price", sel), sv = pick("stock", sel), iv = pick("image", sel);

        QV.cur.mrp = pv ? pv.mrp : base.mrp;
        QV.cur.price = pv ? pv.price : base.price;

        var stock = sv ? sv.stock : base.stock, avail = sv ? sv.available : true;
        var state = !avail ? "na" : stock <= 0 ? "out" : stock <= 5 ? "low" : "in";
        var text = { in: "In Stock", low: "Only " + stock + " left", out: "Out of Stock", na: "This combination is not offered" }[state];
        var blocked = state === "out" || state === "na";

        $pop.find(".pvp-stock").text(text).removeClass("is-out is-low").addClass(blocked ? "is-out" : state === "low" ? "is-low" : "");
        $pop.find(".pvp-cart, .pvp-buy").prop("disabled", blocked).css("opacity", blocked ? ".5" : "");

        maxQty = Math.max(QV.minQty, Math.min(10, stock > 0 ? stock : QV.minQty));
        if (qty() > maxQty) $pop.find(".pvp-qty-input").val(maxQty);

        // variant images (fall back to the product gallery)
        var key = iv && iv.images && iv.images.length ? iv.id : "orig";
        if (key !== QV.img) {
          QV.img = key;
          setImages(key === "orig" ? QV.d.gallery : iv.images.map(function (i) { return { url: i.url, thumb: i.thumb }; }));
        }
        renderPrice();
      }

      $pop.on("change", ".pvp-options input", function () {
        $(this).closest(".pvp-size").find(".pvp-opt-val").text($(this).data("name"));
        refresh();
      });

      // ---------- qty ----------
      $pop.on("click", ".pvp-qty-plus, .pvp-qty-minus", function () {
        if (!QV) return;
        var v = qty();
        v = $(this).hasClass("pvp-qty-plus") ? Math.min(maxQty, v + 1) : Math.max(QV.minQty, v - 1);
        $pop.find(".pvp-qty-input").val(v);
        renderPrice();
      });

      // ---------- add to cart / buy now ----------
      function addToCart($btn, goToCart) {
        if (!QV || $btn.prop("disabled") || $btn.data("busy")) return;
        var sel = selectedIds();
        var data = { product_id: QV.d.id, quantity: qty(), selected_values: sel, addon_ids: [] };
        ["price", "image", "stock", "sku"].forEach(function (t) {
          var v = pick(t, sel);
          if (v) data[t + "_variant_id"] = v.id;
        });

        $btn.data("busy", true).addClass("is-loading");
        $.ajax({ url: window.SHOP.cartAdd, method: "POST", headers: HEAD(), data: data })
          .done(function (res) {
            if (!res.status) return toast("error", "Could not add", res.message);
            if (goToCart) { window.location.href = window.SHOP.cartUrl; return; }
            $pop.find(".close").first().trigger("click");          // close quick view, then the mini cart opens
            $(document).trigger("cart:updated", [res]);
            toast("success", "Added to Cart", QV.d.name + " has been added to your cart.");
          })
          .fail(function (xhr) {
            var j = xhr.responseJSON || {}, msg = j.message || "Something went wrong. Please try again.";
            if (j.errors) msg = Object.values(j.errors)[0][0];
            toast("error", "Could not add", msg);
          })
          .always(function () { $btn.data("busy", false).removeClass("is-loading"); });
      }
      $pop.on("click", ".pvp-cart", function () { addToCart($(this), false); });
      $pop.on("click", ".pvp-buy", function () { addToCart($(this), true); });
    });
  </script>
  @stack('scripts')
</body>

</html>