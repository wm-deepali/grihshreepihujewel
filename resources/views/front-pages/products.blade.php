@extends('layouts.app')

@section('title', 'All Products Listing | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/product-listing/product-listing.css') }}" />
@endpush

@php
  // ---------- products (replace with DB later) ----------
  // badge = [css class, fa icon, label]
  $products = [
    'SKU-P9'  => ['id' => 'SKU-P9',  'name' => 'Royal Radiance – Premium Bridal Necklace Set', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'sub' => 'Antique gold-tone with cascading stone detailing', 'price' => '₹7,500', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P10' => ['id' => 'SKU-P10', 'name' => 'Maharani Elegance – Royal Kundan Chandbali Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'sub' => 'Ruby pink, emerald green and crystal white stones', 'price' => '₹1,400', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P11' => ['id' => 'SKU-P11', 'name' => 'Crystal Glam – Elegant Diamond Look Statement Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'sub' => 'Silver-tone geometric crystal drops', 'price' => '₹1,600', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-G1'  => ['id' => 'SKU-G1',  'name' => 'Handloom Cotton Bedsheet Set', 'img' => 'pro1.png', 'brand' => 'Grih Shree', 'rate' => '4.8', 'sub' => 'Pure cotton, double bed with 2 pillow covers', 'price' => '₹2,499', 'old' => '₹3,299', 'save' => '24%', 'badge' => ['best', 'fa-crown', 'Best Seller']],
    'SKU-P1'  => ['id' => 'SKU-P1',  'name' => 'Kundan Choker Necklace', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.9', 'sub' => 'Handcrafted kundan with pearl drops', 'price' => '₹1,899', 'old' => '₹2,599', 'save' => '27%', 'badge' => ['top', 'fa-star', 'Top Rated']],
    'SKU-G2'  => ['id' => 'SKU-G2',  'name' => 'Brass Diya Gift Set', 'img' => 'pro3.png', 'brand' => 'Grih Shree', 'rate' => '4.7', 'sub' => 'Set of 4 hand-finished brass diyas', 'price' => '₹899', 'old' => '₹1,199', 'save' => '25%', 'badge' => ['trend', 'fa-fire', 'Trending']],
    'SKU-P3'  => ['id' => 'SKU-P3',  'name' => 'Meenakari Bangle Set', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Set of 6 with colourful meenakari work', 'price' => '₹1,299', 'old' => '₹1,799', 'save' => '28%', 'badge' => ['trend', 'fa-fire', 'Trending']],
    'SKU-G3'  => ['id' => 'SKU-G3',  'name' => 'Jaipuri Cotton Quilt', 'img' => 'pro1.png', 'brand' => 'Grih Shree', 'rate' => '4.9', 'sub' => 'Soft Jaipuri print, light and warm', 'price' => '₹3,199', 'old' => '₹3,999', 'save' => '20%', 'badge' => ['top', 'fa-star', 'Top Rated']],
    'SKU-P2'  => ['id' => 'SKU-P2',  'name' => 'Pearl Drop Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Lightweight, for daily and festive wear', 'price' => '₹749', 'old' => '₹999', 'save' => '25%', 'badge' => ['best', 'fa-crown', 'Best Seller']],
    'SKU-G4'  => ['id' => 'SKU-G4',  'name' => 'Hand-Painted Ceramic Planter', 'img' => 'pro3.png', 'brand' => 'Grih Shree', 'rate' => '4.7', 'sub' => 'Hand-painted, ideal for indoor plants', 'price' => '₹1,099', 'old' => '₹1,499', 'save' => '27%', 'badge' => ['hand', 'fa-hand-sparkles', 'Handcrafted']],
    'SKU-G7'  => ['id' => 'SKU-G7',  'name' => 'Embroidered Cushion Cover Set', 'img' => 'pro1.png', 'brand' => 'Grih Shree', 'rate' => '4.8', 'sub' => 'Set of 5 with fine thread work', 'price' => '₹1,199', 'old' => '₹1,599', 'save' => '25%', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-G5'  => ['id' => 'SKU-G5',  'name' => 'Block Print Cotton Dohar', 'img' => 'pro1.png', 'brand' => 'Grih Shree', 'rate' => '4.7', 'sub' => 'Hand block printed, soft and breathable', 'price' => '₹1,799', 'old' => '₹2,399', 'save' => '25%', 'badge' => ['new', 'fa-sparkles', 'New']],
    'SKU-P4'  => ['id' => 'SKU-P4',  'name' => 'Temple Jewellery Ring Set', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.6', 'sub' => 'Set of 5 adjustable temple rings', 'price' => '₹999', 'old' => '₹1,399', 'save' => '29%', 'badge' => ['best', 'fa-crown', 'Best Seller']],
    'SKU-P5'  => ['id' => 'SKU-P5',  'name' => 'Polki Choker Necklace Set', 'img' => 'pro2.png', 'brand' => 'Pihu Jewel', 'rate' => '4.8', 'sub' => 'Choker with matching earrings', 'price' => '₹2,299', 'old' => '₹3,199', 'save' => '28%'],
    'SKU-P6'  => ['id' => 'SKU-P6',  'name' => 'Gold Plated Jhumka Earrings', 'img' => 'pro4.png', 'brand' => 'Pihu Jewel', 'rate' => '4.7', 'sub' => 'Classic jhumka with pearl finish', 'price' => '₹849', 'old' => '₹1,199', 'save' => '29%'],
  ];

  $gridIds   = ['SKU-P9', 'SKU-P10', 'SKU-P11', 'SKU-G1', 'SKU-P1', 'SKU-G2', 'SKU-P3', 'SKU-G3', 'SKU-P2', 'SKU-G4', 'SKU-G7', 'SKU-G5'];
  $bestIds   = ['SKU-P2', 'SKU-G1', 'SKU-P4', 'SKU-G3', 'SKU-P1'];
  $recentIds = ['SKU-G2', 'SKU-P3', 'SKU-P5', 'SKU-G7', 'SKU-P6'];

  // ---------- category pills [img, name, count] ----------
  $catPills = [
    ['cat1.png', 'Bedsheets', 24], ['cat3.png', 'Cushion Covers', 18], ['cat5.png', 'Torans & Door Hangings', 12],
    ['cat3.png', 'Home Decor', 32], ['cat5.png', 'Festive Collection', 26], ['cat1.png', 'Gifts & Hampers', 16],
    ['cat2.png', 'Earrings', 40], ['cat4.png', 'Necklaces', 28], ['cat2.png', 'Bangles & Bracelets', 22],
    ['cat4.png', 'Rings', 14], ['cat2.png', 'Traditional Accessories', 10], ['cat4.png', 'Jewellery Sets', 18],
  ];

  // ---------- filter: quick switches [name, value, label, small] ----------
  $switches = [
    ['availability', 'in-stock', 'In Stock Only', null],
    ['availability', 'ready-to-ship', 'Ready to Ship', 'Dispatched within 48 hours'],
    ['gift', 'gift-ready', 'Gift Ready', 'Perfect for gifting'],
    ['making', 'handcrafted', 'Handcrafted', null],
  ];

  // ---------- filter: category tree [title, count, [[value, label]]] ----------
  $homeTree = [
    ['Handloom & Bedding', 40, [['bedsheets', 'Bedsheets'], ['reversible-bedsheets', 'Reversible Bedsheets'], ['cotton-bedsheets', 'Cotton Bedsheets'], ['dohars-quilts', 'Dohars & Quilts'], ['comforters', 'Comforters'], ['pillow-covers', 'Pillow Covers'], ['cushion-covers', 'Cushion Covers'], ['bedding-sets', 'Bedding Sets']]],
    ['Home Decor', 32, [['torans', 'Torans & Door Hangings'], ['wall-decor', 'Wall Decor'], ['table-decor', 'Table Decor'], ['showpieces', 'Showpieces'], ['lanterns', 'Decorative Lanterns'], ['festive-decor', 'Festive Decor'], ['decor-accessories', 'Decorative Accessories']]],
    ['Festive Collection', 26, [['diwali', 'Diwali Collection'], ['christmas', 'Christmas Collection'], ['karwachauth', 'Karwachauth Collection'], ['holi', 'Holi Collection'], ['rakhi', 'Rakhi Collection'], ['navratri', 'Navratri Collection'], ['wedding-festivities', 'Wedding Festivities']]],
    ['Gifts & Hampers', 16, [['wedding-gifts', 'Wedding Gifts'], ['festive-hampers', 'Festive Hampers'], ['return-gifts', 'Return Gifts'], ['towel-hampers', 'Towel Hampers'], ['decor-gifts', 'Home Decor Gifts'], ['custom-hampers', 'Customised Gift Hampers']]],
    ['Home Essentials', 14, [['bath-towels', 'Bath Towels'], ['face-towels', 'Face Towels'], ['towel-sets', 'Towel Sets'], ['kitchen-linen', 'Kitchen Linen'], ['table-linen', 'Table Linen']]],
    ['Handcrafted Collection', 12, [['crochet', 'Crochet Products'], ['handmade-decor', 'Handmade Decor'], ['resin-art', 'Resin Art'], ['handcrafted-accessories', 'Handcrafted Accessories']]],
  ];

  $jewelTree = [
    ['Earrings', 40, [['jhumkas', 'Jhumkas'], ['studs', 'Studs'], ['chandbalis', 'Chandbalis'], ['drops-danglers', 'Drops & Danglers'], ['festive-earrings', 'Festive Earrings'], ['daily-earrings', 'Daily Wear Earrings']]],
    ['Necklaces', 28, [['matarmala', 'Matarmala'], ['temple', 'Temple Jewellery'], ['traditional-necklaces', 'Traditional Necklaces'], ['choker-sets', 'Choker Sets'], ['necklace-sets', 'Necklace Sets'], ['pendant-sets', 'Pendant Sets']]],
    ['Bangles & Bracelets', 22, [['bangles', 'Bangles'], ['kada', 'Kada'], ['bracelets', 'Bracelets'], ['fashion-bracelets', 'Fashion Bracelets']]],
    ['Rings', 14, [['statement-rings', 'Statement Rings'], ['adjustable-rings', 'Adjustable Rings'], ['traditional-rings', 'Traditional Rings'], ['fashion-rings', 'Fashion Rings']]],
    ['Traditional Accessories', 10, [['maang-tikka', 'Maang Tikka'], ['matha-patti', 'Matha Patti'], ['hair-accessories', 'Hair Accessories'], ['anklets', 'Anklets']]],
    ['Jewellery Sets', 18, [['bridal-sets', 'Bridal Sets'], ['festive-sets', 'Festive Sets'], ['party-sets', 'Party Wear Sets'], ['necklace-earring-sets', 'Necklace & Earring Sets']]],
  ];

  $trees = [
    ['t-home', 'Grih Shree · Home & Living', $homeTree],
    ['t-jewel', 'Pihu Jewel · Jewellery', $jewelTree],
  ];

  $priceQuick = [['499', 'Under ₹499'], ['999', 'Under ₹999'], ['1999', 'Under ₹1,999'], ['2999', 'Under ₹2,999'], ['premium', 'Premium ₹5,000+']];

  // ---------- filter: generic groups ----------
  // type: chip | dot | check   (dot items = [value, label, colour])
  $groups = [
    ['title' => 'Occasion', 'name' => 'occasion', 'cls' => '', 'open' => true, 'type' => 'chip', 'items' => [['wedding', 'Wedding'], ['bridal', 'Bridal'], ['festive', 'Festive'], ['party', 'Party'], ['gifting', 'Gifting'], ['everyday', 'Everyday']]],
    ['title' => 'Colour', 'name' => 'color', 'cls' => '', 'open' => true, 'type' => 'dot', 'items' => [['ivory', 'Ivory', '#f3ecd9'], ['white', 'White', '#ffffff'], ['red', 'Red', '#b3202f'], ['maroon', 'Maroon', '#5e1a33'], ['pink', 'Pink', '#f1c4cc'], ['yellow', 'Yellow', '#f3d36b'], ['green', 'Green', '#1f6b4f'], ['blue', 'Blue', '#2a4a86'], ['black', 'Black', '#222'], ['multi', 'Multicolour', 'conic-gradient(#b3202f, #f3d36b, #1f6b4f, #2a4a86, #b3202f)']]],
    ['title' => 'Fabric / Material', 'name' => 'fabric', 'cls' => 'g-home', 'open' => true, 'type' => 'chip', 'items' => [['cotton', 'Cotton'], ['handloom-cotton', 'Handloom Cotton'], ['mulmul', 'Mulmul'], ['velvet', 'Velvet'], ['brass', 'Brass'], ['wood', 'Wood'], ['ceramic', 'Ceramic'], ['resin', 'Resin'], ['crochet', 'Crochet']]],
    ['title' => 'Size', 'name' => 'size', 'cls' => 'g-home', 'open' => false, 'type' => 'chip', 'items' => [['single', 'Single Bed'], ['double', 'Double Bed'], ['king', 'King Size'], ['16x16', '16 × 16 in'], ['18x18', '18 × 18 in'], ['free', 'Free Size']]],
    ['title' => 'Pattern', 'name' => 'pattern', 'cls' => 'g-home', 'open' => false, 'type' => 'chip', 'items' => [['block-print', 'Block Print'], ['floral', 'Floral'], ['geometric', 'Geometric'], ['ethnic', 'Ethnic Motif'], ['embroidered', 'Embroidered'], ['solid', 'Solid']]],
    ['title' => 'Inclusions', 'name' => 'inclusions', 'cls' => 'g-home', 'open' => false, 'type' => 'check', 'items' => [['sheet-only', 'Bedsheet Only'], ['with-pillow-covers', 'With Pillow Covers'], ['set-of-2', 'Set of 2'], ['set-of-5', 'Set of 5'], ['gift-box', 'Comes in Gift Box']]],
    ['title' => 'Festival', 'name' => 'festival', 'cls' => 'g-home', 'open' => false, 'type' => 'chip', 'items' => [['diwali', 'Diwali'], ['christmas', 'Christmas'], ['karwachauth', 'Karwachauth'], ['holi', 'Holi'], ['rakhi', 'Rakhi'], ['navratri', 'Navratri']]],
    ['title' => 'Product Type', 'name' => 'ptype', 'cls' => 'g-jewel', 'open' => true, 'type' => 'chip', 'items' => [['traditional', 'Traditional'], ['statement', 'Statement'], ['designer', 'Designer'], ['daily-wear', 'Daily Wear'], ['bridal', 'Bridal']]],
    ['title' => 'Metal Finish', 'name' => 'finish', 'cls' => 'g-jewel', 'open' => true, 'type' => 'dot', 'items' => [['antique-gold', 'Antique Gold', '#b08d3c'], ['gold', 'Gold-tone', '#d9b24c'], ['silver', 'Silver-tone', '#c8ccd2'], ['rose-gold', 'Rose Gold', '#d9a38f'], ['oxidised', 'Oxidised', '#6b6b6b']]],
    ['title' => 'Stone Work', 'name' => 'stone_work', 'cls' => 'g-jewel', 'open' => true, 'type' => 'chip', 'items' => [['kundan', 'Kundan'], ['polki', 'Polki'], ['crystal', 'Crystal / AD'], ['pearl', 'Pearl'], ['meenakari', 'Meenakari'], ['multi-stone', 'Multicolour Stones']]],
    ['title' => 'Stone Colour', 'name' => 'stone_colour', 'cls' => 'g-jewel', 'open' => false, 'type' => 'dot', 'items' => [['ruby-pink', 'Ruby Pink', '#c2185b'], ['emerald-green', 'Emerald Green', '#1f8a5b'], ['crystal-white', 'Crystal White', '#f4f8ff'], ['sapphire-blue', 'Sapphire Blue', '#2a4a86'], ['pearl-white', 'Pearl White', '#f3ecd9']]],
    ['title' => 'Style', 'name' => 'style', 'cls' => 'g-jewel', 'open' => false, 'type' => 'chip', 'items' => [['ethnic', 'Ethnic'], ['festive', 'Festive'], ['royal', 'Royal'], ['modern', 'Modern'], ['glamorous', 'Glamorous'], ['minimal', 'Minimal']]],
    ['title' => 'Look', 'name' => 'look', 'cls' => 'g-jewel', 'open' => false, 'type' => 'check', 'items' => [['diamond-inspired', 'Diamond-inspired'], ['antique', 'Antique'], ['temple', 'Temple'], ['layered', 'Layered'], ['statement', 'Statement']]],
    ['title' => 'Pattern & Design', 'name' => 'jpattern', 'cls' => 'g-jewel', 'open' => false, 'type' => 'chip', 'items' => [['geometric', 'Geometric'], ['floral', 'Floral'], ['cascading', 'Cascading'], ['chandbali', 'Chandbali'], ['jhumka', 'Jhumka Drop']]],
    ['title' => 'Set Includes', 'name' => 'includes', 'cls' => 'g-jewel', 'open' => false, 'type' => 'check', 'items' => [['necklace', 'Necklace'], ['earrings', 'Earrings'], ['maang-tikka', 'Maang Tikka'], ['bangles', 'Bangles'], ['ring', 'Ring']]],
    ['title' => 'Collection', 'name' => 'collection', 'cls' => '', 'open' => false, 'type' => 'check', 'items' => [['new', 'New Arrivals'], ['best', 'Best Sellers'], ['festive-specials', 'Festive Specials'], ['premium', 'Premium Collection'], ['gift-ideas', 'Gift Ideas']]],
  ];

  $ratings = [['4.5', 5, '4.5 & Above'], ['4', 4, '4.0 & Above'], ['3', 3, '3.0 & Above']];
  $discounts = [['10', '10% & Above'], ['20', '20% & Above'], ['30', '30% & Above']];
@endphp

@section('content')
  {{-- ===================== BANNER ===================== --}}
  <section class="ap-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">All Products</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Grih Shree &amp; Pihu Jewel</span>
          <h1 class="banner-title">All Products</h1>
          <p class="banner-desc">Thoughtfully curated home essentials and beautiful jewellery, all in one place.</p>
          <div class="banner-btns">
            <a href="#listing" class="btn btn-primary">Shop All Products</a>
            <a href="#best-sellers" class="btn btn-outline-black">Best Sellers</a>
          </div>
        </div>

        <div class="banner-collage">
          <figure class="col-item col-big">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" />
            <figcaption class="img-tag">
              <span class="tag-gem"></span>
              <span class="tag-text"><b>Home &amp; Jewellery</b><small>Beautiful Living, Timeless Adornment</small></span>
            </figcaption>
          </figure>
          <figure class="col-item">
            <img src="{{ asset('assets/images/home/pro1.png') }}" alt="Handloom Cotton Bedsheet Set" />
          </figure>
          <figure class="col-item">
            <img src="{{ asset('assets/images/home/pro4.png') }}" alt="Pearl Drop Earrings" />
          </figure>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== EXPLORE BY CATEGORY ===================== --}}
  <section class="ap-cats">
    <div class="container">
      <div class="heading">
        <span>Shop by Category</span>
        <h3>Explore by <span>Category</span></h3>
        <p>Find the perfect handcrafted pieces for your home, rituals and everyday moments.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.3" data-sm="2" data-lg="4" data-xl="5">
          <div class="swiper-wrapper">
            @foreach($catPills as [$img, $name, $count])
              <div class="swiper-slide">
                <a href="{{ url('categories') }}" class="cat_pill">
                  <figure><img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $name }}" loading="lazy" /></figure>
                  <div class="txt">
                    <h4>{{ $name }}</h4>
                    <span>{{ $count }} items</span>
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

  {{-- ===================== LISTING ===================== --}}
  <section class="ap-main" id="listing">
    <div class="container">
      {{-- hidden state holders (CSS only, no JS) --}}
      <input type="checkbox" id="filterToggle" class="filter-toggle" hidden />
      <input type="radio" name="brand" id="bAll" value="all" form="filterPanel" hidden checked />
      <input type="radio" name="brand" id="bHome" value="grih-shree" form="filterPanel" hidden />
      <input type="radio" name="brand" id="bJewel" value="pihu-jewel" form="filterPanel" hidden />

      {{-- brand pill bar --}}
      <div class="brand-tabs">
        <label for="bAll">All Products <small>128</small></label>
        <label for="bHome">Home &amp; Living <small>72</small></label>
        <label for="bJewel">Jewellery <small>56</small></label>
      </div>

      {{-- toolbar --}}
      <div class="ap-toolbar">
        <p class="ap-count">Showing <b>1–12</b> of <b>128</b> products</p>
        <div class="ap-tools">
          <label for="filterToggle" class="tool-btn"><i class="fa-solid fa-sliders"></i> Filter</label>
          <div class="ap-sort">
            <label for="apSort">Sort By</label>
            <div class="sort-box">
              <select id="apSort" name="sort">
                <option value="recommended">Recommended</option>
                <option value="newest">New Arrivals</option>
                <option value="sold">Best Selling</option>
                <option value="rating">Customer Rating</option>
                <option value="discount">Biggest Discount</option>
                <option value="low">Price: Low to High</option>
                <option value="high">Price: High to Low</option>
              </select>
              <i class="fa-solid fa-chevron-down"></i>
            </div>
          </div>

          {{-- grid view switch --}}
          <div class="view-switch" role="group" aria-label="Product grid view">
            <button type="button" class="view-btn v-1" data-cols="1" aria-label="1 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="4" y="4" width="16" height="7" rx="2" />
                <rect x="4" y="13" width="16" height="7" rx="2" />
              </svg>
            </button>
            <button type="button" class="view-btn v-2" data-cols="2" aria-label="2 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="4" y="4" width="7" height="16" rx="2" />
                <rect x="13" y="4" width="7" height="16" rx="2" />
              </svg>
            </button>
            <button type="button" class="view-btn v-3" data-cols="3" aria-label="3 column view" aria-pressed="false">
              <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <rect x="3" y="4" width="5" height="16" rx="1.6" />
                <rect x="9.5" y="4" width="5" height="16" rx="1.6" />
                <rect x="16" y="4" width="5" height="16" rx="1.6" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      {{-- applied filters (backend renders these) --}}
      <div class="ap-applied">
        <span class="lbl">Applied</span>
        <a href="javascript:void(0)" class="a-chip">Earrings <i class="fa-solid fa-xmark"></i></a>
        <a href="javascript:void(0)" class="a-chip">Under ₹1,999 <i class="fa-solid fa-xmark"></i></a>
        <a href="javascript:void(0)" class="a-clear">Clear All</a>
      </div>

      <div class="ap-layout">
        <label for="filterToggle" class="filter-overlay" aria-hidden="true"></label>

        {{-- ================= FILTER ================= --}}
        <form class="ap-filter" id="filterPanel" action="#" method="get" aria-label="Product filters">
          <div class="f-head">
            <div class="f-ttl">
              <span class="f-icon"><i class="fa-solid fa-sliders"></i></span>
              <h4>Filters</h4>
            </div>
            <button type="reset" class="f-clear">Clear All</button>
            <label for="filterToggle" class="f-close" aria-label="Close filters"><i class="fa-solid fa-xmark"></i></label>
          </div>

          <div class="f-scroll">
            {{-- QUICK --}}
            <details class="f-group" open>
              <summary>Quick Filters</summary>
              <div class="f-body f-switches">
                @foreach($switches as [$name, $value, $label, $small])
                  <label class="f-switch">
                    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" />
                    <span class="f-text">{{ $label }}@if($small)<small>{{ $small }}</small>@endif</span>
                    <span class="f-track"></span>
                  </label>
                @endforeach
              </div>
            </details>

            {{-- CATEGORY TREE --}}
            <details class="f-group" open>
              <summary>Category</summary>
              <div class="f-body">
                @foreach($trees as [$treeClass, $brandLabel, $tree])
                  <div class="f-tree {{ $treeClass }}">
                    <p class="f-brand">{{ $brandLabel }}</p>
                    @foreach($tree as [$subTitle, $subCount, $subItems])
                      <details class="f-sub">
                        <summary>{{ $subTitle }} <em>{{ $subCount }}</em></summary>
                        <div class="f-sub-body">
                          @foreach($subItems as [$value, $label])
                            <label class="f-check">
                              <input type="checkbox" name="category" value="{{ $value }}" /><span class="f-box"></span><span class="f-text">{{ $label }}</span>
                            </label>
                          @endforeach
                        </div>
                      </details>
                    @endforeach
                  </div>
                @endforeach
              </div>
            </details>

            {{-- PRICE --}}
            <details class="f-group" open>
              <summary>Price</summary>
              <div class="f-body">
                <div class="f-chips f-quick">
                  @foreach($priceQuick as [$value, $label])
                    <label class="f-chip"><input type="radio" name="price_quick" value="{{ $value }}" /><span>{{ $label }}</span></label>
                  @endforeach
                </div>

                <div class="price-range" data-min="0" data-max="15000">
                  <div class="range-track"><span class="range-fill"></span></div>
                  <input type="range" class="range-min" min="0" max="15000" step="500" value="0" aria-label="Minimum price" />
                  <input type="range" class="range-max" min="0" max="15000" step="500" value="15000" aria-label="Maximum price" />
                </div>
                <div class="price-inputs">
                  <label><span>Min</span><b>₹</b><input type="number" name="price_min" class="in-min" value="0" min="0" max="15000" step="500" /></label>
                  <i class="price-dash"></i>
                  <label><span>Max</span><b>₹</b><input type="number" name="price_max" class="in-max" value="15000" min="0" max="15000" step="500" /></label>
                </div>
              </div>
            </details>

            {{-- OCCASION / COLOUR / HOME-ONLY / JEWELLERY-ONLY / COLLECTION --}}
            @foreach($groups as $g)
              <details class="f-group {{ $g['cls'] }}" {{ $g['open'] ? 'open' : '' }}>
                <summary>{{ $g['title'] }}</summary>
                <div class="f-body {{ $g['type'] === 'check' ? 'f-list' : 'f-chips' }}">
                  @foreach($g['items'] as $item)
                    @if($g['type'] === 'chip')
                      <label class="f-chip"><input type="checkbox" name="{{ $g['name'] }}" value="{{ $item[0] }}" /><span>{{ $item[1] }}</span></label>
                    @elseif($g['type'] === 'dot')
                      <label class="f-chip f-dot"><input type="checkbox" name="{{ $g['name'] }}" value="{{ $item[0] }}" /><span><i style="--c: {{ $item[2] }}"></i>{{ $item[1] }}</span></label>
                    @else
                      <label class="f-check"><input type="checkbox" name="{{ $g['name'] }}" value="{{ $item[0] }}" /><span class="f-box"></span><span class="f-text">{{ $item[1] }}</span></label>
                    @endif
                  @endforeach
                </div>
              </details>
            @endforeach

            {{-- RATING --}}
            <details class="f-group">
              <summary>Customer Rating</summary>
              <div class="f-body f-list">
                @foreach($ratings as [$value, $stars, $label])
                  <label class="f-check">
                    <input type="radio" name="rating" value="{{ $value }}" /><span class="f-box is-radio"></span>
                    <span class="f-text f-stars">
                      @for($i = 1; $i <= 5; $i++)<i class="fa-{{ $i <= $stars ? 'solid' : 'regular' }} fa-star"></i>@endfor
                      <em>{{ $label }}</em>
                    </span>
                  </label>
                @endforeach
              </div>
            </details>

            {{-- DISCOUNT --}}
            <details class="f-group">
              <summary>Discount</summary>
              <div class="f-body f-list">
                @foreach($discounts as [$value, $label])
                  <label class="f-check">
                    <input type="radio" name="discount" value="{{ $value }}" /><span class="f-box is-radio"></span><span class="f-text">{{ $label }}</span>
                  </label>
                @endforeach
              </div>
            </details>
          </div>

          <div class="f-foot">
            <button type="reset" class="btn btn-outline-black">Clear All</button>
            <button type="submit" class="btn btn-primary">Show Results</button>
          </div>
        </form>

        {{-- ================= PRODUCTS ================= --}}
        <div class="ap-content">
          <div class="ap-grid" id="apGrid">
            @foreach($gridIds as $id)
              @include('partials.product-card', ['p' => $products[$id]])
            @endforeach
          </div>

          <nav class="ap-pagination" aria-label="Product pages">
            <a href="javascript:void(0)" class="pg-nav is-disabled" aria-disabled="true"><i class="fa-solid fa-arrow-left-long"></i> Previous</a>
            <ul>
              <li><a href="javascript:void(0)" class="active" aria-current="page">01</a></li>
              <li><a href="javascript:void(0)">02</a></li>
              <li><a href="javascript:void(0)">03</a></li>
              <li><a href="javascript:void(0)">04</a></li>
              <li class="dots">…</li>
              <li><a href="javascript:void(0)">11</a></li>
            </ul>
            <a href="javascript:void(0)" class="pg-nav">Next <i class="fa-solid fa-arrow-right-long"></i></a>
          </nav>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== BEST SELLERS ===================== --}}
  <section class="ap-best" id="best-sellers">
    <div class="container">
      <div class="heading">
        <span>Our Best Sellers</span>
        <h3>Most Loved. <span>Best Selling.</span></h3>
        <p>Discover the customer favourites everyone loves, from timeless designs to must-have picks.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            @foreach($bestIds as $id)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $products[$id]])
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

  {{-- ===================== WHY / CARE ===================== --}}
  <section class="ap-why">
    <div class="container">
      <div class="info-wrap">
        <div class="info-media">
          <figure class="info-main">
            <img src="{{ asset('assets/images/home/banner2.jpg') }}" alt="Grih Shree home and living" loading="lazy" />
          </figure>
          <figure class="info-sub">
            <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Pihu Jewel jewellery" loading="lazy" />
          </figure>
          <span class="info-tag">Grih Shree &middot; Pihu Jewel</span>
        </div>

        <div class="info-right">
          <div class="heading">
            <span>The Difference Is in the Details</span>
            <h3>A Shopping Experience <span>Made with Care</span></h3>
            <p>
              Thoughtful collections, easy discovery and dedicated support come together to make every shopping
              experience feel special.
            </p>
          </div>

          <ul class="info-grid">
            @foreach([
              ['fa-wand-magic-sparkles', 'Thoughtfully Curated', 'Collections selected with care for your home and personal style.'],
              ['fa-shield-halved', 'Secure Shopping', 'A secure checkout experience for added peace of mind.'],
              ['fa-truck-fast', 'Convenient Delivery', 'Order delivery with clear shipping information and tracking.'],
              ['fa-headset', 'Dedicated Support', "We're here to help with your shopping queries and orders."],
            ] as [$icon, $title, $text])
              <li class="info_item">
                <span class="item-icon"><i class="fa-solid {{ $icon }}"></i></span>
                <div class="item-txt">
                  <h4>{{ $title }}</h4>
                  <p>{{ $text }}</p>
                </div>
              </li>
            @endforeach
          </ul>

          <div class="info-btn">
            <a href="#listing" class="btn btn-primary">Shop All Products</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ===================== RECENTLY VIEWED ===================== --}}
  <section class="ap-recent">
    <div class="container">
      <div class="heading">
        <span>Recently Viewed</span>
        <h3>A Second Look at <span>Your Favourites.</span></h3>
        <p>Take another look at the styles you loved and find the perfect addition to your collection.</p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            @foreach($recentIds as $id)
              <div class="swiper-slide">
                @include('partials.product-card', ['p' => $products[$id], 'showBadge' => false])
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

  {{-- ===================== NEWSLETTER ===================== --}}
  <section class="home-secO">
    <div class="container">
      <div class="news-card">
        <div class="news-content">
          <div class="heading">
            <span>A Note from Our World</span>
            <h3>Beautiful Things Are Worth Sharing</h3>
            <p>
              Sign up to discover new arrivals, special collections, festive inspiration and exclusive updates from
              Grih Shree &amp; Pihu Jewel.
            </p>
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

@push('scripts')
<script>
  // ---------- price range ----------
  (function () {
    var range = document.querySelector(".price-range");
    if (!range) return;
    var form = range.closest("form");
    var minR = range.querySelector(".range-min"),
      maxR = range.querySelector(".range-max");
    var fill = range.querySelector(".range-fill");
    var minI = form.querySelector(".in-min"),
      maxI = form.querySelector(".in-max");
    var MIN = +range.dataset.min,
      MAX = +range.dataset.max,
      GAP = 500;

    function paint() {
      var a = +minR.value,
        b = +maxR.value;
      fill.style.left = ((a - MIN) / (MAX - MIN)) * 100 + "%";
      fill.style.right = 100 - ((b - MIN) / (MAX - MIN)) * 100 + "%";
      minR.style.zIndex = a > MAX - (MAX - MIN) * 0.1 ? 3 : 2;
      maxR.style.zIndex = 2;
    }
    function fromRange(e) {
      var a = +minR.value,
        b = +maxR.value;
      if (b - a < GAP) {
        if (e.target === minR) { a = b - GAP; minR.value = a; }
        else { b = a + GAP; maxR.value = b; }
      }
      minI.value = a;
      maxI.value = b;
      paint();
    }
    function fromInput() {
      var a = +minI.value || MIN,
        b = +maxI.value || MAX;
      a = Math.max(MIN, Math.min(a, MAX - GAP));
      b = Math.min(MAX, Math.max(b, a + GAP));
      minI.value = minR.value = a;
      maxI.value = maxR.value = b;
      paint();
    }
    minR.addEventListener("input", fromRange);
    maxR.addEventListener("input", fromRange);
    minI.addEventListener("change", fromInput);
    maxI.addEventListener("change", fromInput);
    form.addEventListener("reset", function () {
      setTimeout(function () {
        minR.value = minI.value = MIN;
        maxR.value = maxI.value = MAX;
        paint();
      }, 0);
    });
    paint();
  })();

  // ---------- grid view switch ----------
  (function () {
    var grid = document.getElementById("apGrid");
    var btns = document.querySelectorAll(".view-switch .view-btn");
    if (!grid || !btns.length) return;

    var mq = window.matchMedia("(max-width: 768px)");
    var choice = null; // user's selected column count

    function currentCols() {
      var n = getComputedStyle(grid).gridTemplateColumns.split(" ").length;
      return n > 3 ? 3 : n;
    }

    function sync() {
      grid.classList.remove("is-1", "is-2", "is-3");

      // phone: 1/2 valid, tablet/desktop: 2/3 valid
      var valid = choice && (mq.matches ? choice <= 2 : choice >= 2);
      if (valid) grid.classList.add("is-" + choice);
      else choice = null;

      var active = currentCols();
      btns.forEach(function (b) {
        var on = parseInt(b.dataset.cols, 10) === active;
        b.classList.toggle("active", on);
        b.setAttribute("aria-pressed", on ? "true" : "false");
      });
    }

    btns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        choice = parseInt(btn.dataset.cols, 10);
        sync();
      });
    });

    window.addEventListener("resize", sync);
    sync();
  })();
</script>
@endpush