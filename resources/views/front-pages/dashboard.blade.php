@extends('layouts.app')

@section('title', 'Dashboard | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/dashboard/dashboard.css') }}" />
@endpush

@php
  // ---- replace everything below with the logged-in user's data ----
  $tabsNav = [
    [1, 'fa-solid fa-table-columns', 'Dashboard', null],
    [2, 'fa-solid fa-truck-fast', 'Track Order', null],
    [3, 'fa-solid fa-box-open', 'My Orders', 3],
    [4, 'fa-regular fa-heart', 'My Wishlist', 3],
    [5, 'fa-regular fa-user', 'My Profile', null],
  ];

  $stats = [['fa-box-open', 12, 'Total Orders'], ['fa-truck-fast', 1, 'On the Way'], ['fa-circle-check', 10, 'Delivered'], ['fa-rotate-left', 1, 'Cancelled / Returned']];

  // [img, title, order no + date, amount, status class, status label, button label, go-tab]
  $recent = [
    ['pro1.png', 'Handloom Cotton Bedsheet Set + 2 more items', 'Order #GPJ-20482 · 16 Nov 2026', '₹4,797', 'shipped', 'Out for Delivery', 'Track', 2],
    ['pro4.png', 'Pearl Drop Earrings × 2', 'Order #GPJ-20431 · 02 Nov 2026', '₹1,498', 'delivered', 'Delivered', 'View', 3],
    ['pro1.png', 'Jaipuri Cotton Quilt', 'Order #GPJ-20377 · 24 Oct 2026', '₹3,199', 'cancelled', 'Cancelled', 'View', 3],
  ];

  $trackSteps = [
    ['done', 'fa-receipt', 'Order Placed', '16 Nov, 10:42 AM'],
    ['done', 'fa-circle-check', 'Confirmed', '16 Nov, 11:05 AM'],
    ['done', 'fa-box', 'Packed', '17 Nov, 05:30 PM'],
    ['done', 'fa-truck-fast', 'Dispatched', '18 Nov, 09:15 AM'],
    ['current', 'fa-motorcycle', 'Out for Delivery', '20 Nov, 08:40 AM'],
    ['', 'fa-house', 'Delivered', 'Expected today'],
  ];

  // [class, title, text, time]
  $deliveryLog = [
    ['current', 'Out for delivery', 'Delivery partner is on the way to your address. Please keep your phone reachable.', '20 Nov 2026, 08:40 AM · Gurugram Hub'],
    ['done', 'Arrived at local delivery hub', 'Your parcel reached the delivery hub nearest to you.', '20 Nov 2026, 05:10 AM · Gurugram Hub'],
    ['done', 'Shipment in transit', 'Your parcel left the Delhi sorting centre.', '19 Nov 2026, 07:25 PM · Delhi Sorting Centre'],
    ['done', 'Dispatched from our store', 'Handed over to Delhivery Express.', '18 Nov 2026, 09:15 AM'],
    ['done', 'Checked & packed with care', 'Each item was checked by hand and packed in protective, gift-ready packaging.', '17 Nov 2026, 05:30 PM'],
    ['done', 'Order placed & confirmed', 'We have received your order.', '16 Nov 2026, 10:42 AM'],
  ];

  // action = [class, icon, label, href|null, extra attrs]
  $orders = [
    [
      'id' => 'GPJ-20482', 'date' => '16 Nov 2026', 'total' => '₹4,797', 'status' => 'shipped', 'label' => 'Out for Delivery',
      'items' => [['pro1.png', 'Handloom Cotton Bedsheet Set', 'Grih Shree · Double · Qty 1', '₹2,499'], ['pro2.png', 'Kundan Choker Necklace', 'Pihu Jewel · Free Size · Qty 1', '₹1,899'], ['pro3.png', 'Brass Diya Gift Set', 'Grih Shree · Gift Ready · Qty 1', '₹899']],
      'sumTitle' => 'Price details',
      'summary' => [['Subtotal', '₹5,297', '', ''], ['Coupon (PIHUSPECIAL)', '− ₹500', 'green', ''], ['Shipping', 'Free', 'green', ''], ['Total paid', '₹4,797', '', 'total']],
      'steps' => [['done', 'Order Placed', 'We have received your order.', '16 Nov, 10:42 AM'], ['done', 'Order Confirmed', 'Our team confirmed your order.', '16 Nov, 11:05 AM'], ['done', 'Packed', 'Checked by hand and packed securely.', '17 Nov, 05:30 PM'], ['done', 'Dispatched', 'Shipped with Delhivery Express.', '18 Nov, 09:15 AM'], ['current', 'Out for Delivery', 'Delivery partner is on the way.', '20 Nov, 08:40 AM'], ['', 'Delivered', 'Expected today, by 8:00 PM.', '']],
      'info' => [['Delivery address', ['Ananya Kapoor', 'B-204, Sunrise Apartments, Sector 56', 'Gurugram, Haryana - 122011', 'Mobile: +91 98111 22334']], ['Payment', ['Paid Online (UPI)', 'Transaction ID: TXN84520011', 'Amount: ₹4,797']], ['Shipment', ['Delhivery Express', 'AWB: DLV784522109', 'Expected: 20 Nov 2026']]],
      'actions' => [['btn btn-primary btn-sm go-tab', 'fa-truck-fast', 'Track Order', null, 'data-go="2"'], ['btn btn-outline-primary btn-sm', 'fa-file-invoice', 'Download Invoice', null, ''], ['btn btn-outline-primary btn-sm', 'fa-headset', 'Need Help?', 'contact', '']],
    ],
    [
      'id' => 'GPJ-20431', 'date' => '02 Nov 2026', 'total' => '₹1,498', 'status' => 'delivered', 'label' => 'Delivered',
      'items' => [['pro4.png', 'Pearl Drop Earrings', 'Pihu Jewel · Gold-tone · Qty 2', '₹1,498']],
      'sumTitle' => 'Price details',
      'summary' => [['Subtotal', '₹1,498', '', ''], ['Shipping', 'Free', 'green', ''], ['Total paid', '₹1,498', '', 'total']],
      'steps' => [['done', 'Order Placed', '', '02 Nov, 01:12 PM'], ['done', 'Packed', '', '03 Nov, 06:40 PM'], ['done', 'Dispatched', 'Shipped with Delhivery Express.', '04 Nov, 10:05 AM'], ['done', 'Delivered', 'Parcel handed over to you.', '09 Nov, 04:20 PM']],
      'info' => [['Delivery address', ['Ananya Kapoor', 'B-204, Sunrise Apartments, Sector 56', 'Gurugram, Haryana - 122011']], ['Payment', ['Paid Online (Card)', 'Transaction ID: TXN84201377', 'Amount: ₹1,498']], ['Shipment', ['Delhivery Express', 'AWB: DLV771340982', 'Delivered: 09 Nov 2026']]],
      'actions' => [['btn btn-primary btn-sm', 'fa-star', 'Write a Review', null, 'data-model=".review-pop"'], ['btn btn-outline-primary btn-sm', 'fa-rotate-right', 'Buy Again', null, ''], ['btn btn-outline-primary btn-sm', 'fa-file-invoice', 'Download Invoice', null, ''], ['btn btn-outline-primary btn-sm', 'fa-rotate-left', 'Return / Exchange', 'returns-exchange', '']],
    ],
    [
      'id' => 'GPJ-20377', 'date' => '24 Oct 2026', 'total' => '₹3,199', 'status' => 'cancelled', 'label' => 'Cancelled',
      'items' => [['pro1.png', 'Jaipuri Cotton Quilt', 'Grih Shree · Double · Qty 1', '₹3,199']],
      'sumTitle' => 'Refund details',
      'summary' => [['Refund amount', '₹3,199', '', ''], ['Refund to', 'Original payment method', '', ''], ['Status', 'Refund initiated', 'green', 'total']],
      'steps' => [['done', 'Order Placed', '', '24 Oct, 03:18 PM'], ['cancel', 'Order Cancelled', 'Cancelled by you before dispatch.', '24 Oct, 05:02 PM'], ['done', 'Refund Initiated', 'Amount will reflect in 5-7 working days.', '25 Oct, 10:30 AM']],
      'info' => [],
      'actions' => [['btn btn-primary btn-sm', 'fa-rotate-right', 'Buy Again', null, ''], ['btn btn-outline-primary btn-sm', 'fa-headset', 'Need Help?', 'contact', '']],
    ],
  ];

  // [img, name, category, price, old, save, sku, in stock, badge]
  $wishlist = [
    ['pro1.png', 'Embroidered Cushion Cover Set', 'Home Decor', '₹1,199', '₹1,599', '₹400', 'SKU-G7', true, '-25%'],
    ['pro2.png', 'Polki Choker Necklace Set', 'Jewellery', '₹2,299', '₹3,199', '₹900', 'SKU-P5', true, '-28%'],
    ['pro4.png', 'Layered Kundan Necklace', 'Jewellery', '₹1,599', '₹2,199', '₹600', 'SKU-P7', false, null],
  ];
@endphp

@section('content')
  <section class="dash-secA">
    <div class="container">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        <span class="current">My Account</span>
      </nav>

      <div class="dash-layout">
        <div class="user-card">
          <span class="avatar">A</span>
          <div class="meta">
            <h4>Ananya Kapoor</h4>
            <p>ananya@example.com</p>
          </div>
        </div>

        <ul class="tab-nav">
          @foreach($tabsNav as [$n, $icon, $label, $count])
            <li data-tab="{{ $n }}" class="{{ $n === 1 ? 'active' : '' }}">
              <i class="{{ $icon }}" aria-hidden="true"></i> {{ $label }}@if($count) <span class="count">{{ $count }}</span>@endif
            </li>
          @endforeach
        </ul>

        <div class="tab-nav-content">
          {{-- ================= TAB 1 : DASHBOARD ================= --}}
          <div class="tabs active" data-tab="1">
            <div class="welcome">
              <div class="welcome-text">
                <small class="welcome-tag">Member since Jan 2026</small>
                <h2>Welcome back, Ananya!</h2>
                <p>Track your orders, keep your favourite home and jewellery picks close and update your details in one place.</p>
              </div>
              <a href="{{ url('products') }}" class="btn btn-white">
                Continue Shopping <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
              </a>
            </div>

            <div class="stat-grid">
              @foreach($stats as [$icon, $num, $label])
                <div class="stat-card">
                  <span class="stat-icon"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                  <div><strong>{{ $num }}</strong><span>{{ $label }}</span></div>
                </div>
              @endforeach
            </div>

            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i> Recent Orders</h3>
                <a href="javascript:void(0);" class="panel-link go-tab" data-go="3">
                  View all orders <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                </a>
              </div>

              <div class="recent-list">
                @foreach($recent as [$img, $title, $meta, $amount, $sClass, $sLabel, $btn, $go])
                  <div class="recent-item">
                    <span class="thumb"><img src="{{ asset('assets/images/home/' . $img) }}" alt="" loading="lazy" /></span>
                    <div class="info"><h4>{{ $title }}</h4><p>{{ $meta }}</p></div>
                    <strong class="amount">{{ $amount }}</strong>
                    <span class="status {{ $sClass }}">{{ $sLabel }}</span>
                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab" data-go="{{ $go }}">{{ $btn }}</a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          {{-- ================= TAB 2 : TRACK ORDER ================= --}}
          <div class="tabs" data-tab="2">
            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i> Track Your Order</h3>
              </div>

              <form class="form track-form" action="{{ url('track-order') }}" method="get">
                <div class="form-group">
                  <input type="text" id="tr-id" name="order_id" placeholder=" " required />
                  <label for="tr-id">Order ID (e.g. GPJ-20482)</label>
                  <span class="error"></span>
                </div>
                <div class="form-group">
                  <input type="tel" id="tr-phone" name="phone" placeholder=" " required />
                  <label for="tr-phone">Mobile number</label>
                  <span class="error"></span>
                </div>
                <button type="submit" class="btn btn-primary">Track Order</button>
              </form>
            </div>

            <div class="dash-panel shipment">
              <div class="ship-top">
                <div>
                  <h4>Order #GPJ-20482</h4>
                  <p>Placed on 16 Nov 2026 · 3 items · ₹4,797</p>
                </div>
                <span class="status shipped">Out for Delivery</span>
              </div>

              <div class="ship-meta">
                <div><small>Expected Delivery</small><strong>Today, by 8:00 PM</strong></div>
                <div><small>Courier Partner</small><strong>Delhivery Express</strong></div>
                <div><small>Tracking ID (AWB)</small><strong>DLV784522109</strong></div>
                <div><small>Payment</small><strong>Paid Online (UPI)</strong></div>
              </div>

              <ul class="track-steps">
                @foreach($trackSteps as [$cls, $icon, $title, $time])
                  <li class="{{ $cls }}">
                    <span class="dot"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                    <h5>{{ $title }}</h5>
                    <span class="time">{{ $time }}</span>
                  </li>
                @endforeach
              </ul>

              <div class="ship-log">
                <h5 class="od-title">Delivery Updates</h5>
                <ul class="timeline">
                  @foreach($deliveryLog as [$cls, $title, $text, $time])
                    <li class="{{ $cls }}">
                      <span class="dot">@if($cls === 'done')<i class="fa-solid fa-check" aria-hidden="true"></i>@endif</span>
                      <h5>{{ $title }}</h5>
                      <p>{{ $text }}</p>
                      <span class="time">{{ $time }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          {{-- ================= TAB 3 : MY ORDERS ================= --}}
          <div class="tabs" data-tab="3">
            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-box-open" aria-hidden="true"></i> My Orders</h3>
              </div>

              <form class="form orders-bar" action="{{ url('my-orders') }}" method="get">
                <div class="form-group has-icon search-icon">
                  <input type="text" id="od-search" name="q" placeholder=" " />
                  <label for="od-search">Search by order ID or product</label>
                </div>
              </form>

              @foreach($orders as $o)
                <div class="order-card">
                  <div class="order-head">
                    <div class="oh-id"><strong>#{{ $o['id'] }}</strong><span>Placed on {{ $o['date'] }}</span></div>
                    <div class="oh-total"><small>Total</small><b>{{ $o['total'] }}</b></div>
                    <div class="oh-status"><span class="status {{ $o['status'] }}">{{ $o['label'] }}</span></div>
                    <button type="button" class="order-toggle" aria-label="Show order details">
                      <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                    </button>
                  </div>

                  <div class="order-detail">
                    <div class="od-grid">
                      <div>
                        <h5 class="od-title">Items in this order</h5>
                        <div class="od-items">
                          @foreach($o['items'] as [$img, $name, $meta, $price])
                            <div class="od-item">
                              <span class="thumb"><img src="{{ asset('assets/images/home/' . $img) }}" alt="" loading="lazy" /></span>
                              <div class="od-name"><h4>{{ $name }}</h4><p>{{ $meta }}</p></div>
                              <strong>{{ $price }}</strong>
                            </div>
                          @endforeach
                        </div>

                        <h5 class="od-title">{{ $o['sumTitle'] }}</h5>
                        <div class="od-summary">
                          @foreach($o['summary'] as [$label, $value, $vClass, $pClass])
                            <p class="{{ $pClass }}"><span>{{ $label }}</span><span class="{{ $vClass }}">{{ $value }}</span></p>
                          @endforeach
                        </div>
                      </div>

                      <div>
                        <h5 class="od-title">Order progress</h5>
                        <ul class="timeline">
                          @foreach($o['steps'] as [$cls, $title, $text, $time])
                            <li class="{{ $cls }}">
                              <span class="dot">
                                @if($cls === 'done')<i class="fa-solid fa-check" aria-hidden="true"></i>
                                @elseif($cls === 'cancel')<i class="fa-solid fa-xmark" aria-hidden="true"></i>@endif
                              </span>
                              <h5>{{ $title }}</h5>
                              @if($text)<p>{{ $text }}</p>@endif
                              @if($time)<span class="time">{{ $time }}</span>@endif
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                    @if(count($o['info']))
                      <div class="od-info">
                        @foreach($o['info'] as [$boxTitle, $lines])
                          <div class="od-box">
                            <h5 class="od-title">{{ $boxTitle }}</h5>
                            <p>
                              @foreach($lines as $i => $line)
                                {!! $i === 0 ? '<b>' . e($line) . '</b>' : e($line) !!}@if(!$loop->last)<br />@endif
                              @endforeach
                            </p>
                          </div>
                        @endforeach
                      </div>
                    @endif

                    <div class="od-actions">
                      @foreach($o['actions'] as [$cls, $icon, $label, $route, $attrs])
                        <a href="{{ $route ? url($route) : 'javascript:void(0);' }}" class="{{ $cls }}" {!! $attrs !!}>
                          <i class="fa-solid {{ $icon }}" aria-hidden="true"></i> {{ $label }}
                        </a>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          {{-- ================= TAB 4 : WISHLIST ================= --}}
          <div class="tabs" data-tab="4">
            <div class="dash-panel">
              <div class="panel-head">
                <h3>
                  <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                  <span class="muted wish-count">({{ count($wishlist) }} items)</span>
                </h3>
              </div>

              <div class="wish-grid">
                @foreach($wishlist as [$img, $name, $cat, $price, $old, $save, $sku, $inStock, $badge])
                  <article class="wish-card {{ $inStock ? '' : 'out' }}">
                    <button type="button" class="wish-remove" aria-label="Remove from wishlist">
                      <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                    <a href="{{ url('product-detail') }}" class="wish-image">
                      <img src="{{ asset('assets/images/home/' . $img) }}" alt="{{ $name }}" loading="lazy" />
                      @if($badge)<span class="badge">{{ $badge }}</span>@endif
                    </a>
                    <div class="wish-info">
                      <span class="cat">{{ $cat }}</span>
                      <h4><a href="{{ url('product-detail') }}">{{ $name }}</a></h4>
                      <div class="wish-price"><strong>{{ $price }}</strong><del>{{ $old }}</del><span class="save">Save {{ $save }}</span></div>
                      @if($inStock)
                        <span class="stock in"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> In Stock</span>
                      @else
                        <span class="stock"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i> Out of Stock</span>
                      @endif
                      <div class="wish-cta">
                        @if($inStock)
                          <button type="button" class="btn btn-primary btn-sm" data-id="{{ $sku }}" data-name="{{ $name }}" data-toast-title="Added to Bag" data-toast-text="{{ $name }} has been added to your bag." data-toast-type="success">
                            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Add to Bag
                          </button>
                        @else
                          <button type="button" class="btn btn-primary btn-sm" disabled><i class="fa-regular fa-bell" aria-hidden="true"></i> Notify Me</button>
                        @endif
                        <a href="{{ url('product-detail') }}" class="btn btn-outline-primary btn-sm">View</a>
                      </div>
                    </div>
                  </article>
                @endforeach
              </div>

              <div class="empty-state wish-empty">
                <i class="fa-regular fa-heart" aria-hidden="true"></i>
                <h4>Your wishlist is empty</h4>
                <p>Save the home and jewellery pieces you love and find them here.</p>
                <a href="{{ url('products') }}" class="btn btn-primary">Explore Collection</a>
              </div>
            </div>
          </div>

          {{-- ================= TAB 5 : PROFILE ================= --}}
          <div class="tabs" data-tab="5">
            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-regular fa-user" aria-hidden="true"></i> Personal Details</h3>
                <button type="button" class="btn btn-outline-primary btn-sm edit-toggle">
                  <span class="t-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit</span>
                  <span class="t-close"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Close</span>
                </button>
              </div>

              <div class="view-box">
                <div class="profile-head">
                  <span class="avatar lg">A</span>
                  <div><h4>Ananya Kapoor</h4><p>Member since Jan 2026</p></div>
                </div>
                <div class="detail-list">
                  <div><small>Full Name</small><p>Ananya Kapoor</p></div>
                  <div><small>Email</small><p>ananya@example.com</p></div>
                  <div><small>Mobile</small><p>+91 98111 22334</p></div>
                  <div><small>Date of Birth</small><p>12 Aug 1996</p></div>
                </div>
              </div>

              <div class="edit-box">
                <form class="form profile-form" action="{{ url('profile/update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="avatar-upload">
                    <span class="avatar lg">A</span>
                    <div>
                      <label class="btn btn-outline-primary btn-sm" for="pf-photo"><i class="fa-solid fa-camera" aria-hidden="true"></i> Change Photo</label>
                      <input type="file" id="pf-photo" name="photo" accept="image/*" hidden />
                      <p>JPG or PNG, max 2 MB.</p>
                    </div>
                  </div>

                  <div class="form-grid">
                    <div class="form-group">
                      <input type="text" id="pf-name" name="name" value="Ananya Kapoor" placeholder=" " required />
                      <label for="pf-name">Full Name</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="email" id="pf-email" name="email" value="ananya@example.com" placeholder=" " readonly />
                      <label for="pf-email">Email</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="tel" id="pf-mobile" name="mobile" value="+91 98111 22334" placeholder=" " required />
                      <label for="pf-mobile">Mobile Number</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group has-icon calender-icon">
                      <input type="text" id="pf-dob" name="dob" value="12 Aug 1996" placeholder=" " />
                      <label for="pf-dob">Date of Birth</label>
                      <span class="error"></span>
                    </div>
                  </div>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-outline-primary edit-cancel">Cancel</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Saved Addresses</h3>
                <button type="button" class="btn btn-outline-primary btn-sm addr-open"><i class="fa-solid fa-plus" aria-hidden="true"></i> Add New</button>
              </div>

              <div class="addr-list">
                @foreach([
                  ['Home · Default', 'addr-type default', 'B-204, Sunrise Apartments, Sector 56, Golf Course Road', 'Gurugram, Haryana - 122011'],
                  ['Work', 'addr-type', 'Tower C, 7th Floor, Sector 62, Near Metro Station', 'Noida, Uttar Pradesh - 201301'],
                ] as [$type, $typeClass, $line1, $line2])
                  <div class="addr-card">
                    <span class="{{ $typeClass }}">{{ $type }}</span>
                    <h5>Ananya Kapoor</h5>
                    <p>{{ $line1 }}<br />{{ $line2 }}<br />Mobile: +91 98111 22334</p>
                    <div class="addr-actions">
                      <a href="javascript:void(0);" class="addr-open"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit</a>
                      <a href="javascript:void(0);" class="remove"><i class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</a>
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="addr-form">
                <h5 class="od-title">Address details</h5>
                <form class="form address-form" action="{{ url('profile/address') }}" method="post">
                  @csrf
                  <div class="form-grid">
                    @foreach([
                      ['ad-name', 'name', 'text', 'Full Name', true, false],
                      ['ad-mobile', 'mobile', 'tel', 'Mobile Number', true, false],
                      ['ad-pin', 'pincode', 'text', 'Pincode', true, false],
                      ['ad-city', 'city', 'text', 'City', true, false],
                      ['ad-state', 'state', 'text', 'State', true, false],
                      ['ad-landmark', 'landmark', 'text', 'Landmark (optional)', false, false],
                      ['ad-line', 'address', 'text', 'House no., building, street, area', true, true],
                    ] as [$id, $name, $type, $label, $req, $full])
                      <div class="form-group {{ $full ? 'full' : '' }}">
                        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" placeholder=" " {{ $req ? 'required' : '' }} />
                        <label for="{{ $id }}">{{ $label }}</label>
                        <span class="error"></span>
                      </div>
                    @endforeach
                  </div>

                  <div class="addr-extra">
                    <div class="type-pills">
                      @foreach(['home' => 'Home', 'work' => 'Work', 'other' => 'Other'] as $val => $label)
                        <label class="pill"><input type="radio" name="type" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} /> <span>{{ $label }}</span></label>
                      @endforeach
                    </div>
                    <label class="check"><input type="checkbox" name="is_default" /> <span>Make this my default address</span></label>
                  </div>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Address</button>
                    <button type="button" class="btn btn-outline-primary addr-cancel">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <a href="javascript:void(0)" class="btn btn-outline-primary logout-btn">
          <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i> Sign Out
        </a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  $(function () {
    var $dash = $(".dash-secA");
    var $nav = $dash.find(".tab-nav");
    var $content = $dash.find(".tab-nav-content");

    // ===== Tab activate =====
    function activateTab(n) {
      var $li = $nav.children('li[data-tab="' + n + '"]');
      var $target = $content.children('.tabs[data-tab="' + n + '"]');
      if (!$li.length || !$target.length) return false;

      $li.addClass("active").siblings().removeClass("active");
      $target.addClass("active").siblings(".tabs").removeClass("active");

      var el = $li.get(0);
      if (el && el.scrollIntoView && $nav.css("overflow-x") === "auto") {
        $nav.scrollLeft(el.offsetLeft - 20);
      }
      return true;
    }

    function scrollToDash() {
      $("html, body").animate({ scrollTop: $dash.offset().top - 150 }, 300);
    }

    // ===== Open tab from hash (/dashboard#tab-1 ... #tab-5) =====
    function openTabFromHash(scroll) {
      var h = window.location.hash.match(/^#tab-(\d+)$/);
      if (!h) return;
      if (activateTab(h[1]) && scroll) scrollToDash();
    }

    openTabFromHash(false);
    $(window).on("load", function () { openTabFromHash(true); });
    setTimeout(function () { openTabFromHash(false); }, 300);
    $(window).on("hashchange", function () { openTabFromHash(true); });

    // clicking the same hash again (header/footer links) still works
    $(document).on("click", 'a[href*="dashboard#tab-"]', function () {
      var m = this.getAttribute("href").match(/#tab-(\d+)$/);
      var onDash = /\/dashboard\/?$/.test(window.location.pathname);
      if (m && onDash) {
        activateTab(m[1]);
        scrollToDash();
      }
    });

    // update URL hash on tab click
    $nav.children("li").on("click", function () {
      try { history.replaceState(null, "", "#tab-" + $(this).data("tab")); } catch (e) {}
    });

    // ===== "View all / Track" links =====
    $(".go-tab").on("click", function () {
      var n = $(this).data("go");
      $nav.children('li[data-tab="' + n + '"]').trigger("click");
      activateTab(n);
      scrollToDash();
    });

    // ===== Order detail slide (one open at a time) =====
    $(".order-head").on("click", function () {
      var $card = $(this).closest(".order-card");
      $card.siblings(".order-card.open").removeClass("open").find(".order-detail").slideUp(300);
      $card.toggleClass("open").find(".order-detail").slideToggle(300);
    });

    // ===== Orders search =====
    $(".orders-bar").on("submit", function (e) { e.preventDefault(); });
    $("#od-search").on("input", function () {
      var q = $.trim($(this).val()).toLowerCase();
      $dash.find(".order-card").each(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(q) > -1);
      });
    });

    // ===== Wishlist remove =====
    $(".wish-remove").on("click", function () {
      var $card = $(this).closest(".wish-card");
      $card.fadeOut(250, function () {
        $card.remove();
        var n = $(".wish-grid .wish-card").length;
        $(".wish-count").text("(" + n + " items)");
        $nav.children('li[data-tab="4"]').find(".count").text(n);
        if (!n) {
          $(".wish-grid").hide();
          $(".wish-empty").show();
        }
      });
    });

    // ===== Profile view <-> edit =====
    $(".edit-toggle").on("click", function () {
      var $p = $(this).closest(".dash-panel");
      $(this).toggleClass("is-open");
      $p.find(".view-box").slideToggle(250);
      $p.find(".edit-box").slideToggle(250);
    });
    $(".edit-cancel").on("click", function () {
      $(this).closest(".dash-panel").find(".edit-toggle").trigger("click");
    });

    // ===== Address form open / close =====
    $(".addr-open").on("click", function () { $(".addr-form").slideDown(250); });
    $(".addr-cancel").on("click", function () { $(".addr-form").slideUp(250); });
  });
</script>
@endpush