@extends('layouts.app')

@section('title', 'Faqs | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/faqs/faqs.css') }}" />
@endpush

@section('content')
  <section class="comman-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">FAQs</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">Help &amp; Information</span>
          <h1 class="banner-title">Answers to Everything You Wonder</h1>
          <p class="banner-desc">
            Quick answers about orders, delivery, returns, home essentials and jewellery, all in one place.
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

  <section class="faq-secA">
    <div class="container">
      <div class="heading">
        <span>Need Some Help?</span>
        <h3>Find Your Answer <br /><span>in a Minute</span></h3>
        <p>Pick a topic and open a question. Still stuck? Our team is one message away.</p>
      </div>

      <div class="faq-layout">
        <div class="faq-side">
          <ul class="tab-nav">
            <li class="active" data-tab="1">
              <span class="tab-ico"><i class="fa-solid fa-credit-card"></i></span>
              <span class="tab-txt">Orders &amp; Payments</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
            <li data-tab="2">
              <span class="tab-ico"><i class="fa-solid fa-truck-fast"></i></span>
              <span class="tab-txt">Shipping &amp; Delivery</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
            <li data-tab="3">
              <span class="tab-ico"><i class="fa-solid fa-rotate-left"></i></span>
              <span class="tab-txt">Returns &amp; Exchange</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
            <li data-tab="4">
              <span class="tab-ico"><i class="fa-solid fa-house"></i></span>
              <span class="tab-txt">Home &amp; Living</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
            <li data-tab="5">
              <span class="tab-ico"><i class="fa-regular fa-gem"></i></span>
              <span class="tab-txt">Jewellery</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
            <li data-tab="6">
              <span class="tab-ico"><i class="fa-solid fa-gift"></i></span>
              <span class="tab-txt">Gifting &amp; Offers</span>
              <span class="tab-arr"><i class="fa-solid fa-arrow-right"></i></span>
            </li>
          </ul>

          <div class="aside-card aside-help">
            <span class="ah-icon"><i class="fa-solid fa-headset" aria-hidden="true"></i></span>
            <small>Still Have a Question?</small>
            <h4>Talk to Our Team</h4>
            <p>We usually reply within one business day.</p>
            <a href="https://wa.me/919876543210" class="btn btn-white" target="_blank" rel="noopener">
              <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> WhatsApp Us
            </a>
          </div>
        </div>

        <div class="faq-main">
          <div class="tab-nav-content">

            {{-- TAB 1 : ORDERS & PAYMENTS --}}
            <div class="tabs active" data-tab="1">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I place an order?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Choose your product, add it to your bag and follow the checkout steps: Bag, Address and
                      Payment. You will get a confirmation on email and WhatsApp.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>What payment methods do you accept?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>We accept cards, UPI, wallets and net banking. All available options are shown at checkout.</p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I use a coupon code?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Enter your code in the coupon box on the bag page and tap Apply. For example, GRIHHOME works
                      on selected home &amp; living pieces and PIHUSPECIAL on selected jewellery.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Can I cancel my order?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      You can cancel an order before it is dispatched from
                      <a href="{{ url('dashboard') }}#tab-3">My Orders</a> or by
                      <a href="{{ url('contact') }}">contacting us</a> with your order number. Refunds go back to
                      your original payment method.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {{-- TAB 2 : SHIPPING & DELIVERY --}}
            <div class="tabs" data-tab="2">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How long will my order take to arrive?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Ready to ship products are dispatched within 48 hours. Standard delivery takes 3–7 working
                      days and Priority delivery is faster, both with tracking.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Is shipping free?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Standard delivery is free. Priority delivery has a small fee, which is shown at checkout
                      before you pay.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How can I track my order?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Once your order ships, you will get a tracking link by email and SMS. You can also track it
                      anytime from <a href="{{ url('dashboard') }}#tab-2">your account</a>.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Do you deliver across India?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Yes. Enter your pincode on the bag page to check delivery availability and the estimated date.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {{-- TAB 3 : RETURNS & EXCHANGE --}}
            <div class="tabs" data-tab="3">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Do you offer returns or exchanges?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Yes, unused items in original packaging can be returned or exchanged within the window
                      mentioned in our <a href="{{ url('returns-exchange') }}">returns &amp; exchange</a> policy.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I start a return?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Open <a href="{{ url('dashboard') }}#tab-3">My Orders</a>, choose the delivered order and
                      select Return / Exchange. Our team will take it from there.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>What if I receive a damaged or wrong item?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Contact us as soon as you receive the parcel with your order number and a few photos. We will
                      arrange the right solution.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How long does a refund take?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Once a refund is initiated, it usually reflects in 5–7 working days, depending on your bank.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {{-- TAB 4 : HOME & LIVING --}}
            <div class="tabs" data-tab="4">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I choose the right bedding size?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Each product page lists the sheet and pillow cover sizes. Match them with your mattress size
                      and add a little extra for the drop.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How should I wash handloom and cotton products?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Wash separately in cold water with a mild detergent for the first few washes and dry in shade.
                      This keeps colours and prints fresh.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Are the decor pieces really handcrafted?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Yes. Our handcrafted collection is made by hand, so small natural variations are part of its
                      charm.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I care for brass items?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Wipe with a soft dry cloth and polish occasionally with a little lemon and salt. Keep brass
                      away from moisture when not in use.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {{-- TAB 5 : JEWELLERY --}}
            <div class="tabs" data-tab="5">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I take care of my jewellery?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Keep it dry, store each piece in its pouch and put it on after perfume or makeup. Wipe gently
                      with a soft cloth after wearing.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Is the jewellery comfortable for everyday wear?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Many of our pieces, like pearl earrings, are light and made for daily wear. The product page
                      mentions the style and occasion.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Do rings and bangles come in adjustable sizes?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Selected rings are adjustable and bangles come in size options. Check the size details on each
                      product page.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {{-- TAB 6 : GIFTING & OFFERS --}}
            <div class="tabs" data-tab="6">
              <div class="accordion-wrapper">
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Do you offer gift packaging?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>Yes, selected products come gift ready. Look for the Gift Ready note on the product page.</p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>Can I send a gift to someone else?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Of course. Choose Deliver to a new address at checkout and enter your loved one&rsquo;s details.
                    </p>
                  </div>
                </div>
                <div class="accordion-item">
                  <button type="button" class="accordion-header">
                    <h4>How do I join the journal for offers?</h4>
                    <span class="accordion-icon">+</span>
                  </button>
                  <div class="accordion-content">
                    <p>
                      Add your email in the Stay Inspired box at the bottom of any page to hear first about new
                      arrivals and special offers.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="aside-card aside-links">
            <h4>Quick Links</h4>
            <ul>
              <li>
                <a href="{{ url('dashboard') }}#tab-2"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Track Order</a>
              </li>
              <li>
                <a href="{{ url('returns-exchange') }}"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i> Returns &amp; Exchange</a>
              </li>
              <li>
                <a href="{{ url('shipping-policy') }}"><i class="fa-solid fa-box" aria-hidden="true"></i> Shipping Policy</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="faq-secB">
    <div class="container">
      <div class="heading">
        <span>Quick Help</span>
        <h3>Things People <span>Ask Most</span></h3>
      </div>

      <div class="help-grid">
        <a href="{{ url('dashboard') }}#tab-2" class="help_card">
          <span class="hc-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
          <h4>Track Your Order</h4>
          <p>See where your parcel is right now.</p>
          <span class="hc-link">Track Now <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></span>
        </a>
        <a href="{{ url('returns-exchange') }}" class="help_card">
          <span class="hc-icon"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></span>
          <h4>Returns &amp; Exchange</h4>
          <p>Simple steps if something is not right.</p>
          <span class="hc-link">Read Policy <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></span>
        </a>
        <a href="{{ url('blog') }}" class="help_card">
          <span class="hc-icon"><i class="fa-solid fa-book-open" aria-hidden="true"></i></span>
          <h4>Care &amp; Styling Guides</h4>
          <p>Ideas from our journal for home and jewellery.</p>
          <span class="hc-link">Read Journal <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></span>
        </a>
        <a href="{{ url('contact') }}" class="help_card">
          <span class="hc-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
          <h4>Contact Us</h4>
          <p>Write to us and we will help you out.</p>
          <span class="hc-link">Get in Touch <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></span>
        </a>
      </div>
    </div>
  </section>

  <section class="contact-secD">
    <div class="container">
      <div class="cta-card">
        <div class="cta-content">
          <div class="heading">
            <span>We're Always Happy to Help</span>
            <h3>Still Have a Question?</h3>
            <p>
              Couldn't find the answer you were looking for? Send us a message or connect with our team. We're here
              to help you find the right answers.
            </p>
          </div>

          <div class="cta-btns">
            <a href="{{ url('contact') }}#contactForm" class="btn btn-white cta-btn">
              Send an Enquiry <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="btn btn-white cta-btn">
              Chat on WhatsApp <i class="fa-brands fa-whatsapp"></i>
            </a>
          </div>
        </div>

        <div class="cta-img">
          <img src="{{ asset('assets/images/home/jewellery.jpg') }}"
            alt="Get in touch with Grih Shree and Pihu Jewel" loading="lazy" />
        </div>
      </div>
    </div>
  </section>
@endsection