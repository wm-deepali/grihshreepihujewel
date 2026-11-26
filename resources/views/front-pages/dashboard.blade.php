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
    [3, 'fa-solid fa-box-open', 'My Orders', $orders->total() ?: null],
    [4, 'fa-regular fa-heart', 'My Wishlist', $wishlist->count() ?: null],
    [5, 'fa-regular fa-user', 'My Profile', null],
  ];

  $dob = $customer->dob ? \Carbon\Carbon::parse($customer->dob) : null;
  $mob = substr(preg_replace('/\D/', '', (string) $customer->mobile), -10);
  $mobFmt = strlen($mob) === 10 ? '+91 ' . substr($mob, 0, 5) . ' ' . substr($mob, 5) : ($customer->mobile ?: '-');
  $initial = mb_strtoupper(mb_substr(trim((string) $customer->name), 0, 1));
  $avatarUrl = $customer->avatar
    ? (str_starts_with($customer->avatar, 'http') ? $customer->avatar : asset('storage/' . $customer->avatar))
    : null;
  $since = $customer->created_at?->format('M Y');
  $typeLabels = ['home' => 'Home', 'office' => 'Work', 'other' => 'Other'];
  $avatarImg = '<img src="' . e($avatarUrl) . '" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';

  $money = fn($n) => '₹' . number_format((float) $n);
  $firstName = explode(' ', trim((string) $customer->name))[0] ?? '';
  $activeStatuses = ['new', 'pending', 'processing', 'shipped', 'ndr'];

  $statCards = [
    ['fa-box-open', $stats['total'], 'Total Orders'],
    ['fa-truck-fast', $stats['active'], 'In Progress'],
    ['fa-circle-check', $stats['delivered'], 'Delivered'],
    ['fa-rotate-left', $stats['closed'], 'Cancelled / Returned'],
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
          <span class="avatar">{!! $avatarUrl ? $avatarImg : e($initial) !!}</span>
          <div class="meta">
            <h4>{{ $customer->name }}</h4>
            <p>{{ $customer->email }}</p>
          </div>
        </div>

        <ul class="tab-nav">
          @foreach($tabsNav as [$n, $icon, $label, $count])
            <li data-tab="{{ $n }}" class="{{ $n === 1 ? 'active' : '' }}">
              <i class="{{ $icon }}" aria-hidden="true"></i> {{ $label }}@if($count) <span
              class="count">{{ $count }}</span>@endif
            </li>
          @endforeach
        </ul>

        <div class="tab-nav-content">

          {{-- ================= TAB 1 : DASHBOARD ================= --}}
          <div class="tabs active" data-tab="1">
            <div class="welcome">
              <div class="welcome-text">
                @if($since)<small class="welcome-tag">Member since {{ $since }}</small>@endif
                <h2>Welcome back, {{ $firstName }}!</h2>
                <p>Track your orders, keep your favourite home and jewellery picks close and update your details in one
                  place.</p>
              </div>
              <a href="{{ url('products') }}" class="btn btn-white">
                Continue Shopping <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
              </a>
            </div>

            <div class="stat-grid">
              @foreach($statCards as [$icon, $num, $label])
                <div class="stat-card">
                  <span class="stat-icon"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                  <div><strong>{{ $num }}</strong><span>{{ $label }}</span></div>
                </div>
              @endforeach
            </div>

            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i> Recent Orders</h3>
                @if($recentOrders->isNotEmpty())
                  <a href="javascript:void(0);" class="panel-link go-tab" data-go="3">
                    View all orders <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                  </a>
                @endif
              </div>

              <div class="recent-list">
                @forelse($recentOrders as $ro)
                  @php
                    $rMeta = $statusMeta[$ro->status] ?? [ucfirst($ro->status), 'processing'];
                    $rFirst = $ro->items->first();
                    $rCount = $ro->items->count();
                    $rTitle = $rFirst?->product_name ?? $rFirst?->product?->name ?? 'Your order';
                    if ($rCount > 1) {
                      $rTitle .= ' + ' . ($rCount - 1) . ' more ' . ($rCount - 1 === 1 ? 'item' : 'items');
                    } elseif ($rFirst && $rFirst->quantity > 1) {
                      $rTitle .= ' × ' . $rFirst->quantity;
                    }
                    $rImg = $rFirst?->imageVariant?->image
                      ? asset('storage/' . $rFirst->imageVariant->image)
                      : $rFirst?->product?->display_image;
                  @endphp
                  <div class="recent-item">
                    <span class="thumb">@if($rImg)<img src="{{ $rImg }}" alt="" loading="lazy" />@endif</span>
                    <div class="info">
                      <h4>{{ $rTitle }}</h4>
                      <p>Order #{{ $ro->order_number }} · {{ $ro->created_at->format('d M Y') }}</p>
                    </div>
                    <strong class="amount">{{ $money($ro->grand_total) }}</strong>
                    <span class="status {{ $rMeta[1] }}">{{ $rMeta[0] }}</span>
                    @if(in_array($ro->status, $activeStatuses))
                      <a href="{{ route('user.dashboard.index', ['track' => $ro->order_number]) }}#tab-2"
                        class="btn btn-outline-primary btn-sm">Track</a>
                    @else
                      <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab" data-go="3">View</a>
                    @endif
                  </div>
                @empty
                  <p class="muted">You have not placed any order yet.</p>
                @endforelse
              </div>
            </div>
          </div>

          {{-- ================= TAB 2 : TRACK ORDER ================= --}}
          <div class="tabs" data-tab="2">
            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i> Track Your Order</h3>
              </div>

              <form class="form track-form" action="{{ route('user.dashboard.index') }}" method="get" novalidate>
                <div class="form-group">
                  <input type="text" id="tr-id" name="track" value="{{ request('track') }}" placeholder=" " required />
                  <label for="tr-id">Order ID (e.g.
                    {{ $recentOrders->first()->order_number ?? 'ORD-65F2A1B3C4D5E' }})</label>
                  <span class="error"></span>
                </div>
                <div class="form-group">
                  <input type="tel" id="tr-phone" name="phone" value="{{ request('phone') }}" placeholder=" "
                    inputmode="numeric" />
                  <label for="tr-phone">Mobile number (optional)</label>
                  <span class="error"></span>
                </div>
                <button type="submit" class="btn btn-primary">Track Order</button>
              </form>

              @if($trackError)
                <p style="color:#c0392b;margin-top:12px"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
                  {{ $trackError }}
                </p>
              @endif
            </div>

            @if($trackOrder)
              @php
                $t = $trackOrder;
                $tMeta = $statusMeta[$t->status] ?? [ucfirst($t->status), 'processing'];
                $tKey = $t->status === 'new' ? 'pending' : $t->status;
                $tClosed = in_array($t->status, ['delivered', 'cancelled', 'rto']);
                $tHist = $t->statusHistory->sortBy('created_at')->values();
                $tShipped = $tHist->firstWhere('status', 'shipped');
                $tDelivered = $tHist->firstWhere('status', 'delivered');

                // estimate: 3 days from dispatch, otherwise 7 days from order date
                $tEtaDate = $tShipped ? $tShipped->created_at->copy()->addDays(3) : $t->created_at->copy()->addDays(7);
                if ($t->status === 'delivered') {
                  $tEta = 'Delivered on ' . ($tDelivered?->created_at ?? $t->updated_at)->format('d M Y');
                } elseif (in_array($t->status, ['cancelled', 'rto'])) {
                  $tEta = '-';
                } else {
                  $tEta = $tEtaDate->format('D, d M');
                }

                $tPay = ($t->payment_method === 'cod' ? 'Cash on Delivery' : 'Paid Online') . ' · ' . ucfirst($t->payment_status);

                // stepper (normal flow only)
                $tFlow = [
                  'pending' => ['fa-receipt', 'Order Placed'],
                  'processing' => ['fa-box', 'Processing'],
                  'shipped' => ['fa-truck-fast', 'Shipped'],
                  'delivered' => ['fa-house', 'Delivered'],
                ];
                $tKeys = array_keys($tFlow);
                $tIdx = array_search($tKey, $tKeys);
                $tByStatus = $tHist->groupBy(fn($h) => $h->status === 'new' ? 'pending' : $h->status)->map(fn($g) => $g->first());
                $trackSteps = [];
                if ($tIdx !== false) {
                  foreach ($tKeys as $i => $key) {
                    $h = $tByStatus->get($key);
                    $cls = $i < $tIdx ? 'done' : ($i === $tIdx ? ($tKey === 'delivered' ? 'done' : 'current') : '');
                    if ($h) {
                      $time = $h->created_at->format('d M, h:i A');
                    } elseif ($key === 'pending') {
                      $time = $t->created_at->format('d M, h:i A');
                    } elseif ($key === 'delivered' && !$tClosed) {
                      $time = 'Expected ' . $tEta;
                    } else {
                      $time = '';
                    }
                    $trackSteps[] = [$cls, $tFlow[$key][0], $tFlow[$key][1], $time];
                  }
                }

                // delivery updates, newest first
                $tLog = [];
                foreach ($tHist->reverse()->values() as $i => $h) {
                  $cls = in_array($h->status, ['cancelled', 'ndr', 'rto']) ? 'cancel' : (($i === 0 && !$tClosed) ? 'current' : 'done');
                  $tLog[] = [$cls, $statusMeta[$h->status][0] ?? ucfirst($h->status), (string) $h->remarks, $h->created_at->format('d M Y, h:i A')];
                }
                if (!$tLog) {
                  $tLog[] = ['done', 'Order placed', '', $t->created_at->format('d M Y, h:i A')];
                }
              @endphp

              <div class="dash-panel shipment">
                <div class="ship-top">
                  <div>
                    <h4>Order #{{ $t->order_number }}</h4>
                    <p>Placed on {{ $t->created_at->format('d M Y') }} · {{ (int) $t->items->sum('quantity') }}
                      {{ $t->items->sum('quantity') == 1 ? 'item' : 'items' }} · {{ $money($t->grand_total) }}
                    </p>
                  </div>
                  <span class="status {{ $tMeta[1] }}">{{ $tMeta[0] }}</span>
                </div>

                <div class="ship-meta">
                  <div>
                    <small>{{ $t->status === 'delivered' ? 'Delivery' : 'Expected Delivery' }}</small><strong>{{ $tEta }}</strong>
                  </div>
                  <div><small>Courier Partner</small><strong>{{ $t->courier?->name ?? 'Not assigned yet' }}</strong></div>
                  <div><small>Tracking ID (AWB)</small><strong>{{ $t->tracking_number ?: 'Not available yet' }}</strong>
                  </div>
                  <div><small>Payment</small><strong>{{ $tPay }}</strong></div>
                </div>

                @if($t->courier?->website_url && $t->tracking_number)
                  <p style="margin:0 0 16px">
                    <a href="{{ $t->courier->website_url }}" target="_blank" rel="noopener"
                      class="btn btn-outline-primary btn-sm">
                      <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Track on
                      {{ $t->courier->name }}
                    </a>
                  </p>
                @endif

                @if($trackSteps)
                  <ul class="track-steps">
                    @foreach($trackSteps as [$cls, $icon, $title, $time])
                      <li class="{{ $cls }}">
                        <span class="dot"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                        <h5>{{ $title }}</h5>
                        @if($time)<span class="time">{{ $time }}</span>@endif
                      </li>
                    @endforeach
                  </ul>
                @endif

                <div class="ship-log">
                  <h5 class="od-title">Delivery Updates</h5>
                  <ul class="timeline">
                    @foreach($tLog as [$cls, $title, $text, $time])
                      <li class="{{ $cls }}">
                        <span class="dot">
                          @if($cls === 'done')<i class="fa-solid fa-check" aria-hidden="true"></i>
                          @elseif($cls === 'cancel')<i class="fa-solid fa-xmark" aria-hidden="true"></i>@endif
                        </span>
                        <h5>{{ $title }}</h5>
                        @if($text)
                        <p>{{ $text }}</p>@endif
                        <span class="time">{{ $time }}</span>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @elseif(!$trackError)
              <div class="dash-panel">
                <div class="empty-state" style="display:block">
                  <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
                  <h4>No orders to track yet</h4>
                  <p>Once you place an order, you can follow it here.</p>
                  <a href="{{ url('products') }}" class="btn btn-primary">Start Shopping</a>
                </div>
              </div>
            @endif
          </div>

          {{-- ================= TAB 3 : MY ORDERS ================= --}}
          <div class="tabs" data-tab="3">
            <div class="dash-panel">
              <div class="panel-head">
                <h3><i class="fa-solid fa-box-open" aria-hidden="true"></i> My Orders</h3>
              </div>

              @if($orders->isEmpty())
                <div class="empty-state" style="display:block">
                  <i class="fa-solid fa-box-open" aria-hidden="true"></i>
                  <h4>No orders yet</h4>
                  <p>When you place an order, it will show up here.</p>
                  <a href="{{ url('products') }}" class="btn btn-primary">Start Shopping</a>
                </div>
              @else
                <form class="form orders-bar" action="#" method="get">
                  <div class="form-group has-icon search-icon">
                    <input type="text" id="od-search" name="q" placeholder=" " />
                    <label for="od-search">Search by order ID or product</label>
                  </div>
                </form>

                @foreach($orders as $o)
                  @php
                    $meta = $statusMeta[$o->status] ?? [ucfirst($o->status), 'processing'];
                    $oItems = $o->items;
                    $isPaid = $o->payment_status === 'paid';
                    $isCod = $o->payment_method === 'cod';
                    $closed = in_array($o->status, ['delivered', 'cancelled', 'rto']);
                    $refundCase = $o->status === 'cancelled' && in_array($o->payment_status, ['paid', 'refunded']);
                    $firstSlug = $oItems->first()?->product?->slug;
                    $firstUrl = $firstSlug ? route('product.show', $firstSlug) : url('products');

                    // ---- price summary ----
                    $money = fn($n) => '₹' . number_format((float) $n);
                    if ($refundCase) {
                      $sumTitle = 'Refund details';
                      $summary = [
                        ['Refund amount', $money($o->grand_total - $o->shipping_charge), '', ''],
                        ['Refund to', 'Original payment method', '', ''],
                        ['Status', $o->payment_status === 'refunded' ? 'Refunded' : 'Refund initiated', 'green', 'total'],
                      ];
                    } else {
                      $sumTitle = 'Price details';
                      $summary = [['Subtotal', $money($o->subtotal), '', '']];
                      if ($o->discount > 0) {
                        $summary[] = ['Coupon' . ($o->coupon_code ? ' (' . $o->coupon_code . ')' : ''), '− ' . $money($o->discount), 'green', ''];
                      }
                      if ($o->tax_amount > 0) {
                        $summary[] = ['GST', '₹' . number_format($o->tax_amount, 2), '', ''];
                      }
                      $summary[] = $o->shipping_charge > 0
                        ? ['Shipping', $money($o->shipping_charge), '', '']
                        : ['Shipping', 'Free', 'green', ''];
                      $summary[] = [$isPaid ? 'Total paid' : 'Total payable', $money($o->grand_total), '', 'total'];
                    }

                    // ---- progress timeline ----
                    $hist = $o->statusHistory->sortBy('created_at')->values();
                    $steps = [];
                    $curKey = $o->status === 'new' ? 'pending' : $o->status;
                    $flow = [
                      'pending' => ['Order Placed', 'We have received your order.'],
                      'processing' => ['Processing', 'Your order is being packed.'],
                      'shipped' => ['Shipped', 'Your order is on its way.'],
                      'delivered' => ['Delivered', 'Parcel handed over to you.'],
                    ];

                    if (isset($flow[$curKey])) {
                      // normal flow: show every stage, mark progress
                      $keys = array_keys($flow);
                      $curIdx = array_search($curKey, $keys);
                      $byStatus = $hist->groupBy(fn($h) => $h->status === 'new' ? 'pending' : $h->status)
                        ->map(fn($g) => $g->first());

                      foreach ($keys as $idx => $key) {
                        $h = $byStatus->get($key);
                        $cls = $idx < $curIdx ? 'done' : ($idx === $curIdx ? ($curKey === 'delivered' ? 'done' : 'current') : '');
                        $time = $h ? $h->created_at->format('d M, h:i A') : ($key === 'pending' ? $o->created_at->format('d M, h:i A') : '');
                        $text = $h && $h->remarks ? (string) $h->remarks : ($idx <= $curIdx ? $flow[$key][1] : '');
                        $steps[] = [$cls, $flow[$key][0], $text, $time];
                      }
                    } else {
                      // cancelled / ndr / rto: show what actually happened
                      foreach ($hist as $h) {
                        $cls = in_array($h->status, ['cancelled', 'ndr', 'rto']) ? 'cancel' : 'done';
                        $steps[] = [$cls, $statusMeta[$h->status][0] ?? ucfirst($h->status), (string) $h->remarks, $h->created_at->format('d M, h:i A')];
                      }
                      if (!$steps) {
                        $steps[] = ['done', 'Order Placed', '', $o->created_at->format('d M, h:i A')];
                      }
                    }

                    // ---- info boxes ----
                    $addrLines = [
                      $o->customer_name,
                      collect([$o->address_line_1, $o->address_line_2])->filter()->implode(', '),
                      collect([$o->city?->name, $o->state?->name])->filter()->implode(', ') . ($o->pincode ? ' - ' . $o->pincode : ''),
                    ];
                    if ($o->customer_phone) {
                      $addrLines[] = 'Mobile: +91 ' . $o->customer_phone;
                    }

                    $payLines = [$isCod ? 'Cash on Delivery' : 'Paid Online'];
                    $payLines[] = 'Status: ' . ucfirst($o->payment_status);
                    $txn = $o->razorpay_payment_id ?: $o->transaction_id;
                    if ($txn) {
                      $payLines[] = 'Transaction ID: ' . $txn;
                    }
                    $payLines[] = 'Amount: ' . $money($o->grand_total);

                    $info = [['Delivery address', array_values(array_filter($addrLines))], ['Payment', $payLines]];
                    if ($o->courier || $o->tracking_number) {
                      $shipLines = [$o->courier?->name ?: 'Courier Service'];
                      if ($o->tracking_number) {
                        $shipLines[] = 'AWB: ' . $o->tracking_number;
                      }
                      $info[] = ['Shipment', $shipLines];
                    }

                    // ---- actions: [class, icon, label, href, extra attrs] ----
                    $actions = [];
                    if (in_array($o->status, ['new', 'pending', 'processing', 'shipped', 'ndr'])) {
                      $actions[] = ['btn btn-primary btn-sm', 'fa-truck-fast', 'Track Order', route('user.dashboard.index', ['track' => $o->order_number]) . '#tab-2', ''];
                    }
                    if ($o->status === 'delivered') {
                      $actions[] = ['btn btn-primary btn-sm', 'fa-star', 'Write a Review', $firstUrl, ''];
                    }
                    if (in_array($o->status, ['delivered', 'cancelled'])) {
                      $actions[] = ['btn btn-outline-primary btn-sm', 'fa-rotate-right', 'Buy Again', $firstUrl, ''];
                    }
                    if ($o->invoice) {
                      $actions[] = ['btn btn-outline-primary btn-sm', 'fa-file-invoice', 'Download Invoice', route('account.orders.invoice', $o->id), ''];
                    }
                    if ($o->status === 'delivered') {
                      $actions[] = ['btn btn-outline-primary btn-sm', 'fa-rotate-left', 'Return / Exchange', url('returns-exchange'), ''];
                    }
                    $actions[] = ['btn btn-outline-primary btn-sm', 'fa-headset', 'Need Help?', route('contact'), ''];
                  @endphp

                  <div class="order-card">
                    <div class="order-head">
                      <div class="oh-id"><strong>#{{ $o->order_number }}</strong><span>Placed on
                          {{ $o->created_at->format('d M Y') }}</span></div>
                      <div class="oh-total"><small>Total</small><b>{{ $money($o->grand_total) }}</b></div>
                      <div class="oh-status"><span class="status {{ $meta[1] }}">{{ $meta[0] }}</span></div>
                      <button type="button" class="order-toggle" aria-label="Show order details">
                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                      </button>
                    </div>

                    <div class="order-detail">
                      <div class="od-grid">
                        <div>
                          <h5 class="od-title">Items in this order</h5>
                          <div class="od-items">
                            @foreach($oItems as $item)
                              @php
                                $img = $item->imageVariant?->image
                                  ? asset('storage/' . $item->imageVariant->image)
                                  : $item->product?->display_image;
                                $attrs = collect($item->selected_attributes ?? [])
                                  ->map(fn($v) => is_array($v) ? ($v['value'] ?? $v['label'] ?? null) : $v)
                                  ->filter()->implode(' · ');
                                $sub = collect([$attrs, 'Qty ' . $item->quantity])->filter()->implode(' · ');
                                $line = ($item->price * $item->quantity) + $item->addons->sum('price');
                              @endphp
                              <div class="od-item">
                                <span class="thumb">@if($img)<img src="{{ $img }}" alt="" loading="lazy" />@endif</span>
                                <div class="od-name">
                                  <h4>{{ $item->product_name ?? ($item->product->name ?? 'Product') }}</h4>
                                  <p>{{ $sub }}</p>
                                  @foreach($item->addons as $ad)
                                    <p>+ {{ $ad->detail }}</p>
                                  @endforeach
                                </div>
                                <strong>{{ $money($line) }}</strong>
                              </div>
                            @endforeach
                          </div>

                          <h5 class="od-title">{{ $sumTitle }}</h5>
                          <div class="od-summary">
                            @foreach($summary as [$label, $value, $vClass, $pClass])
                              <p class="{{ $pClass }}"><span>{{ $label }}</span><span class="{{ $vClass }}">{{ $value }}</span>
                              </p>
                            @endforeach
                          </div>
                        </div>

                        <div>
                          <h5 class="od-title">Order progress</h5>
                          <ul class="timeline">
                            @foreach($steps as [$cls, $title, $text, $time])
                              <li class="{{ $cls }}">
                                <span class="dot">
                                  @if($cls === 'done')<i class="fa-solid fa-check" aria-hidden="true"></i>
                                  @elseif($cls === 'cancel')<i class="fa-solid fa-xmark" aria-hidden="true"></i>@endif
                                </span>
                                <h5>{{ $title }}</h5>
                                @if($text)
                                <p>{{ $text }}</p>@endif
                                @if($time)<span class="time">{{ $time }}</span>@endif
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>

                      <div class="od-info">
                        @foreach($info as [$boxTitle, $lines])
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

                      <div class="od-actions">
                        @foreach($actions as [$cls, $icon, $label, $href, $attrs])
                          <a href="{{ $href }}" class="{{ $cls }}" {!! $attrs !!}>
                            <i class="fa-solid {{ $icon }}" aria-hidden="true"></i> {{ $label }}
                          </a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endforeach

                @if($orders->hasPages())
                  <div class="orders-pager">{{ $orders->withQueryString()->fragment('tab-3')->links() }}</div>
                @endif
              @endif
            </div>
          </div>

          {{-- ================= TAB 4 : WISHLIST ================= --}}
          <div class="tabs" data-tab="4">
            <div class="dash-panel">
              <div class="panel-head">
                <h3>
                  <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                  <span class="muted wish-count">({{ $wishlist->count() }}
                    {{ $wishlist->count() === 1 ? 'item' : 'items' }})</span>
                </h3>
              </div>

              <div class="wish-grid" @if($wishlist->isEmpty()) style="display:none" @endif>
                @foreach($wishlist as $w)
                  @php
                    $p = $w->product;
                    $pUrl = $p->slug ? route('product.show', $p->slug) : url('products');
                    $pImg = $p->display_image;
                    $pCat = $p->subcategory?->name ?? $p->category?->name;
                    $pPrice = (float) ($p->price ?? 0);   // change to your selling price column if different
                    $pMrp = (float) ($p->mrp ?? 0);
                    $pOff = $pMrp > $pPrice && $pPrice > 0 ? (int) round(($pMrp - $pPrice) / $pMrp * 100) : 0;
                    $pStock = (int) ($p->stock ?? 0);
                    $pIn = $pStock > 0;
                  @endphp
                  <article class="wish-card {{ $pIn ? '' : 'out' }}" data-product="{{ $p->id }}">
                    <button type="button" class="wish-remove" data-id="{{ $p->id }}" aria-label="Remove from wishlist">
                      <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                    <a href="{{ $pUrl }}" class="wish-image">
                      @if($pImg)<img src="{{ $pImg }}" alt="{{ $p->name }}" loading="lazy" />@endif
                      @if($pOff)<span class="badge">-{{ $pOff }}%</span>@endif
                    </a>
                    <div class="wish-info">
                      @if($pCat)<span class="cat">{{ $pCat }}</span>@endif
                      <h4><a href="{{ $pUrl }}">{{ $p->name }}</a></h4>
                      <div class="wish-price">
                        <strong>{{ $money($pPrice) }}</strong>
                        @if($pOff)
                          <del>{{ $money($pMrp) }}</del><span class="save">Save {{ $money($pMrp - $pPrice) }}</span>
                        @endif
                      </div>
                      @if($pIn)
                        <span class="stock in"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> In Stock</span>
                      @else
                        <span class="stock"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i> Out of Stock</span>
                      @endif
                      <div class="wish-cta">
                        @if($pIn)
                          <a href="{{ $pUrl }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Select &amp; Add to Bag
                          </a>
                        @else
                          <button type="button" class="btn btn-primary btn-sm" disabled>
                            <i class="fa-regular fa-bell" aria-hidden="true"></i> Out of Stock
                          </button>
                        @endif
                        <a href="{{ $pUrl }}" class="btn btn-outline-primary btn-sm">View</a>
                      </div>
                    </div>
                  </article>
                @endforeach
              </div>

              <div class="empty-state wish-empty" @if($wishlist->isEmpty()) style="display:block" @endif>
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
                  <span class="avatar lg">{!! $avatarUrl ? $avatarImg : e($initial) !!}</span>
                  <div>
                    <h4>{{ $customer->name }}</h4>
                    <p>Member since {{ $since }}</p>
                  </div>
                </div>
                <div class="detail-list">
                  <div><small>Full Name</small>
                    <p>{{ $customer->name }}</p>
                  </div>
                  <div><small>Email</small>
                    <p>{{ $customer->email }}</p>
                  </div>
                  <div><small>Mobile</small>
                    <p>{{ $mobFmt }}</p>
                  </div>
                  <div><small>Date of Birth</small>
                    <p>{{ $dob ? $dob->format('d M Y') : '-' }}</p>
                  </div>
                </div>
              </div>

              <div class="edit-box">
                <form class="form profile-form" action="{{ route('account.profile.update') }}" method="post"
                  enctype="multipart/form-data" novalidate>
                  @csrf
                  <div class="avatar-upload">
                    <span class="avatar lg" id="pf-preview">{!! $avatarUrl ? $avatarImg : e($initial) !!}</span>
                    <div>
                      <label class="btn btn-outline-primary btn-sm" for="pf-photo"><i class="fa-solid fa-camera"
                          aria-hidden="true"></i> Change Photo</label>
                      <input type="file" id="pf-photo" name="avatar" accept="image/*" hidden />
                      <p>JPG or PNG, max 2 MB.</p>
                    </div>
                  </div>

                  <div class="form-grid">
                    <div class="form-group">
                      <input type="text" id="pf-name" name="name" value="{{ $customer->name }}" placeholder=" "
                        required />
                      <label for="pf-name">Full Name</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="email" id="pf-email" value="{{ $customer->email }}" placeholder=" " readonly />
                      <label for="pf-email">Email</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="tel" id="pf-mobile" name="mobile" value="{{ $mob }}" placeholder=" "
                        inputmode="numeric" maxlength="10" required />
                      <label for="pf-mobile">Mobile Number</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group has-icon calender-icon">
                      <input type="text" id="pf-dob" name="dob" value="{{ $dob ? $dob->format('d M Y') : '' }}"
                        placeholder=" " />
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
                <button type="button" class="btn btn-outline-primary btn-sm addr-open addr-add"><i
                    class="fa-solid fa-plus" aria-hidden="true"></i> Add New</button>
              </div>

              <div class="addr-list">
                @forelse($addresses as $a)
                  <div class="addr-card" data-id="{{ $a->id }}">
                    <span class="addr-type {{ $a->is_default ? 'default' : '' }}">
                      {{ $typeLabels[$a->address_type] ?? 'Home' }}{{ $a->is_default ? ' · Default' : '' }}
                    </span>
                    <h5>{{ $a->name }}</h5>
                    <p>
                      {{ collect([$a->address_line_1, $a->address_line_2])->filter()->implode(', ') }}<br />
                      {{ collect([$a->city?->name, $a->state?->name])->filter()->implode(', ') }}{{ $a->pincode ? ' - ' . $a->pincode : '' }}<br />
                      Mobile: +91 {{ $a->phone }}
                    </p>
                    <div class="addr-actions">
                      <a href="javascript:void(0);" class="addr-open addr-edit-btn" data-id="{{ $a->id }}"
                        data-name="{{ $a->name }}" data-phone="{{ $a->phone }}" data-pin="{{ $a->pincode }}"
                        data-state="{{ $a->state_id }}" data-city="{{ $a->city_id }}" data-house="{{ $a->address_line_1 }}"
                        data-street="{{ $a->address_line_2 }}"
                        data-type="{{ $a->address_type === 'office' ? 'work' : ($a->address_type ?: 'home') }}"
                        data-default="{{ $a->is_default ? 1 : 0 }}">
                        <i class="fa-solid fa-pen" aria-hidden="true"></i> Edit
                      </a>
                      <a href="javascript:void(0);" class="remove"><i class="fa-regular fa-trash-can"
                          aria-hidden="true"></i> Remove</a>
                    </div>
                  </div>
                @empty
                  <p class="muted">You have not saved any address yet.</p>
                @endforelse
              </div>

              <div class="addr-form">
                <h5 class="od-title" id="addrFormTitle">Add new address</h5>
                <form class="form address-form" novalidate>
                  <input type="hidden" name="id" value="" />
                  <div class="form-grid">
                    <div class="form-group">
                      <input type="text" id="ad-name" name="name" placeholder=" " autocomplete="name" />
                      <label for="ad-name">Full Name</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="tel" id="ad-mobile" name="phone" placeholder=" " inputmode="numeric" maxlength="10"
                        autocomplete="tel-national" />
                      <label for="ad-mobile">Mobile Number</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="text" id="ad-pin" name="pincode" placeholder=" " inputmode="numeric" maxlength="6"
                        autocomplete="postal-code" />
                      <label for="ad-pin">Pincode</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group has-select">
                      <select id="ad-state" name="state_id">
                        <option value="">Select state</option>
                        @foreach($states as $s)
                          <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                      </select>
                      <label for="ad-state">State</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group has-select">
                      <select id="ad-city" name="city_id" disabled>
                        <option value="">Select city</option>
                      </select>
                      <label for="ad-city">City</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group">
                      <input type="text" id="ad-house" name="address_line_1" placeholder=" "
                        autocomplete="address-line1" />
                      <label for="ad-house">House / Flat no.</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group full">
                      <input type="text" id="ad-street" name="address_line_2" placeholder=" "
                        autocomplete="address-line2" />
                      <label for="ad-street">Street / Area / Locality</label>
                      <span class="error"></span>
                    </div>
                    <div class="form-group full">
                      <input type="text" id="ad-landmark" name="landmark" placeholder=" " />
                      <label for="ad-landmark">Landmark (optional)</label>
                    </div>
                  </div>

                  <div class="addr-extra">
                    <div class="type-pills">
                      @foreach(['home' => 'Home', 'work' => 'Work', 'other' => 'Other'] as $val => $label)
                        <label class="pill"><input type="radio" name="type" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} /> <span>{{ $label }}</span></label>
                      @endforeach
                    </div>
                    <label class="check"><input type="checkbox" name="is_default" /> <span>Make this my default
                        address</span></label>
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
  @include('partials.geo-js')
  <script>
    $(function () {
      var URLS = {
        profile: "{{ route('account.profile.update') }}",
        addrStore: "{{ route('account.address.store') }}",
        addrUpdate: "{{ route('account.address.update', '__ID__') }}",
        addrDelete: "{{ route('account.address.delete', '__ID__') }}"
      };
      var H = function () {
        return { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), Accept: "application/json" };
      };
      var reload = function () { window.location.reload(); };

      function errMsg(xhr) {
        var j = xhr.responseJSON || {};
        if (j.errors) return Object.values(j.errors)[0][0];
        return j.message || "Something went wrong. Please try again.";
      }

      // put each validation message under its own field; anything else goes to an alert
      function showErrors($f, xhr) {
        $f.find(".error").text("");
        var j = xhr.responseJSON || {};
        if (!j.errors) return alert(errMsg(xhr));
        var extra = null;
        $.each(j.errors, function (k, m) {
          var $e = $f.find('[name="' + k + '"]').closest(".form-group").find(".error");
          if ($e.length) $e.text(m[0]); else if (!extra) extra = m[0];
        });
        if (extra) alert(extra);
      }

      // ===== profile =====
      $("#pf-photo").on("change", function () {
        var f = this.files && this.files[0];
        if (!f) return;
        $("#pf-preview").html($("<img>").attr("src", URL.createObjectURL(f))
          .css({ width: "100%", height: "100%", objectFit: "cover", borderRadius: "50%" }));
      });

      $(".profile-form").on("submit", function (e) {
        e.preventDefault();
        var $f = $(this), $b = $f.find('[type="submit"]');
        if ($b.prop("disabled")) return;
        $b.prop("disabled", true);
        $.ajax({ url: URLS.profile, method: "POST", data: new FormData(this), processData: false, contentType: false, headers: H() })
          .done(reload)
          .fail(function (xhr) { showErrors($f, xhr); })
          .always(function () { $b.prop("disabled", false); });
      });

      // ===== addresses =====
      var $af = $(".address-form");
      Geo.bind($("#ad-state"), $("#ad-city"));

      function resetAddr() {
        $af[0].reset();
        $af.find('[name="id"]').val("");
        $af.find(".error").text("");
        $("#ad-city").html('<option value="">Select city</option>').prop("disabled", true);
        $("#addrFormTitle").text("Add new address");
      }

      $(document).on("click", ".addr-add", resetAddr);
      $(".addr-cancel").on("click", resetAddr);

      $(document).on("click", ".addr-edit-btn", function () {
        var d = $(this).data();
        resetAddr();
        $af.find('[name="id"]').val(d.id);
        $af.find('[name="name"]').val(d.name);
        $af.find('[name="phone"]').val(d.phone);
        $af.find('[name="pincode"]').val(d.pin);
        $af.find('[name="address_line_1"]').val(d.house);
        $af.find('[name="address_line_2"]').val(d.street);
        $af.find('[name="type"][value="' + d.type + '"]').prop("checked", true);
        $af.find('[name="is_default"]').prop("checked", !!d.default);
        // state change loads the cities, then geo-js selects data-pending
        $("#ad-city").attr("data-pending", d.city);
        $("#ad-state").val(String(d.state)).trigger("change");
        $("#addrFormTitle").text("Edit address");
      });

      $af.on("submit", function (e) {
        e.preventDefault();
        var $b = $af.find('[type="submit"]');
        if ($b.prop("disabled")) return;

        var g = function (n) { return $.trim($af.find('[name="' + n + '"]').val() || ""); };
        var id = g("id");
        var type = $af.find('[name="type"]:checked').val();
        var data = {
          name: g("name"), phone: g("phone"), pincode: g("pincode"),
          state_id: g("state_id"), city_id: g("city_id"),
          address_line_1: g("address_line_1"),
          address_line_2: [g("address_line_2"), g("landmark")].filter(Boolean).join(", "),
          address_type: type === "work" ? "office" : (type === "other" ? "other" : "home"),
          is_default: $af.find('[name="is_default"]').is(":checked") ? 1 : 0
        };
        if (id) data._method = "PUT";

        $b.prop("disabled", true);
        $.ajax({ url: id ? URLS.addrUpdate.replace("__ID__", id) : URLS.addrStore, method: "POST", data: data, headers: H() })
          .done(reload)
          .fail(function (xhr) { showErrors($af, xhr); })
          .always(function () { $b.prop("disabled", false); });
      });

      $(document).on("click", ".addr-card .remove", function () {
        var id = $(this).closest(".addr-card").data("id");
        if (!confirm("Remove this address?")) return;
        $.ajax({ url: URLS.addrDelete.replace("__ID__", id), method: "DELETE", headers: H() })
          .done(reload)
          .fail(function (xhr) { alert(errMsg(xhr)); });
      });
    });
  </script>
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
        try { history.replaceState(null, "", "#tab-" + $(this).data("tab")); } catch (e) { }
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
      $(document).on("click", ".wish-remove", function () {
        var $b = $(this), $card = $b.closest(".wish-card");
        if ($b.data("busy")) return;
        $b.data("busy", true);
        $.ajax({
          url: "{{ route('account.wishlist.remove', '__ID__') }}".replace("__ID__", $b.data("id")),
          method: "DELETE",
          headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), Accept: "application/json" }
        })
          .done(function (res) {
            $card.fadeOut(250, function () {
              $card.remove();
              var n = res && res.count !== undefined ? res.count : $(".wish-grid .wish-card").length;
              $(".wish-count").text("(" + n + " " + (n === 1 ? "item" : "items") + ")");
              $nav.children('li[data-tab="4"]').find(".count").text(n);
              if (!n) {
                $(".wish-grid").hide();
                $(".wish-empty").show();
              }
            });
          })
          .fail(function () { alert("Could not remove this item. Please try again."); })
          .always(function () { $b.data("busy", false); });
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