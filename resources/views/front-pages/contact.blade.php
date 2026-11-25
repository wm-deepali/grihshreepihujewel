@extends('layouts.app')

@section('title', 'Contact Us | Grih Shree & Pihu Jewel')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/contact/contact.css') }}" />
@endpush

@php
  // replace the XXXXX placeholders with real contact details (or Setting values)
  $phone    = '+91XXXXXXXXXX';
  $phoneTxt = '+91 XXXXX XXXXX';
  $email    = 'hello@yourdomain.com';

  $topics = ['Product Enquiry', 'Order Support', 'Gifting & Bulk', 'Something Else'];

  $brandForms = [
    ['key' => 'gs', 'tab' => 1, 'brand' => 'Grih Shree', 'sub' => 'Home & Living', 'icon' => 'fa-house',
      'intro' => 'Questions about bedding, decor, festive pieces or gifting? Write to the Grih Shree team.',
      'categories' => ['Handloom & Bedding', 'Home Decor', 'Festive Collection', 'Gifts & Hampers', 'Home Essentials', 'Handcrafted Collection']],
    ['key' => 'pj', 'tab' => 2, 'brand' => 'Pihu Jewel', 'sub' => 'Jewellery', 'icon' => 'fa-gem',
      'intro' => 'Looking for earrings, necklaces, bangles or a complete set? Write to the Pihu Jewel team.',
      'categories' => ['Earrings', 'Necklaces', 'Bangles & Bracelets', 'Rings', 'Traditional Accessories', 'Jewellery Sets']],
  ];

  $steps = [
    ['01', 'Choose your brand', 'Pick Grih Shree or Pihu Jewel from the tabs.'],
    ['02', 'Share your query', 'Select what you need help with and add a few details.'],
    ['03', 'We get back to you', 'The right team will reply on your phone or email.'],
  ];

  $faqs = [
    ['How can I place an order?', 'Browse our collections, select your favourite products, add them to your cart and follow the checkout process to complete your order.'],
    ['How can I track my order?', 'Use the Track Order option on our website and enter the required order details to check your order status.'],
    ['Can I enquire about a product before ordering?', 'Yes. Select Grih Shree or Pihu Jewel in the enquiry form and share your product question with us.'],
    ['How can I get help with shipping or delivery?', 'Contact our support team or refer to the Shipping Information page for details about delivery and order updates.'],
    ['What should I do if I need help with a return or refund?', 'Please review our Returns & Refunds policy and contact our team with your order details for assistance.'],
    ['How can I contact the right brand?', 'Select Grih Shree for home and lifestyle enquiries or Pihu Jewel for jewellery-related enquiries in the contact form.'],
  ];
@endphp

@section('content')
  {{-- ================= BANNER ================= --}}
  <section class="comman-banner">
    <div class="container">
      <ul class="crumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><i class="fa-solid fa-chevron-right"></i></li>
        <li class="current">Contact Us</li>
      </ul>

      <div class="banner-grid">
        <div class="banner-content">
          <span class="eyebrow">We're Here to Help</span>
          <h1 class="banner-title">We'd Love to Hear From You.</h1>
          <p class="banner-desc">
            Have a question about our collections, need help with an order or simply want to know more? We're here to
            make your experience with Grih Shree &amp; Pihu Jewel smooth and enjoyable.
          </p>
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

  {{-- ================= A : CONTACT CARDS ================= --}}
  <section class="contact-secA">
    <div class="container">
      <div class="heading">
        <span>Let's Connect</span>
        <h3>We're Just a <span>Message Away</span></h3>
        <p>
          Whether you have a question about home essentials or need assistance with jewellery, choose the easiest way
          to reach our team.
        </p>
      </div>

      <div class="swiper-wrap">
        <div class="swiper fourSlider" data-mob="1.2" data-sm="2" data-lg="4" data-xl="4">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="contact_card">
                <span class="contact-icon"><i class="fa-solid fa-phone"></i></span>
                <h4>Call Us</h4>
                <a href="tel:{{ $phone }}" class="contact-main">{{ $phoneTxt }}</a>
                <p>Mon – Sat, 10:30 AM – 8:30 PM</p>
                <a href="tel:{{ $phone }}" class="contact-cta">Call Now <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="contact_card">
                <span class="contact-icon"><i class="fa-brands fa-whatsapp"></i></span>
                <h4>WhatsApp Us</h4>
                <a href="https://wa.me/{{ ltrim($phone, '+') }}" target="_blank" rel="noopener" class="contact-main">{{ $phoneTxt }}</a>
                <p>Quick assistance for your queries</p>
                <a href="https://wa.me/{{ ltrim($phone, '+') }}" target="_blank" rel="noopener" class="contact-cta">Chat With Us <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="contact_card">
                <span class="contact-icon"><i class="fa-solid fa-envelope"></i></span>
                <h4>Email Us</h4>
                <a href="mailto:{{ $email }}" class="contact-main">{{ $email }}</a>
                <p>We aim to reply within one business day.</p>
                <a href="mailto:{{ $email }}" class="contact-cta">Send an Email <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="contact_card">
                <span class="contact-icon"><i class="fa-solid fa-clock"></i></span>
                <h4>Business Hours</h4>
                <span class="contact-main">Monday – Saturday</span>
                <span class="contact-time">10:30 AM – 8:30 PM</span>
                <p>Sunday: As per business availability</p>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-group">
          <button type="button" class="TestimonialSlider-prev btn-prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
          <button type="button" class="TestimonialSlider-next btn-next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= B : CONTACT FORM ================= --}}
  <section class="contact-secB" id="contactForm">
    <div class="container">
      <div class="cf-wrap">
        {{-- LEFT --}}
        <div class="cf-left">
          <div class="heading">
            <span>Send Us a Message</span>
            <h3>How Can <span>We Help?</span></h3>
            <p>
              Tell us a little about what you're looking for. Whether it's a product enquiry, an order question or a
              gifting idea, choose the right brand and share the details. Our team will take it from there.
            </p>
          </div>

          <figure class="cf-media">
            <img src="{{ asset('assets/images/home/moments.jpg') }}" alt="Home decor and jewellery" loading="lazy" />
            <span class="cf-tag">Home Decor &middot; Jewellery</span>
          </figure>

          <ul class="cf-steps">
            @foreach($steps as [$no, $title, $text])
              <li>
                <span class="step-no">{{ $no }}</span>
                <div><h4>{{ $title }}</h4><p>{{ $text }}</p></div>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- RIGHT --}}
        <div class="cf-right">
          <div class="cf-card">
            <ul class="tab-nav">
              @foreach($brandForms as $f)
                <li data-tab="{{ $f['tab'] }}" class="{{ $loop->first ? 'active' : '' }}">
                  <span class="tab-ico"><i class="fa-solid {{ $f['icon'] }}"></i></span>
                  <span class="tab-txt"><b>{{ $f['brand'] }}</b><small>{{ $f['sub'] }}</small></span>
                </li>
              @endforeach
            </ul>

            <div class="tab-nav-content">
              @foreach($brandForms as $f)
                @php $k = $f['key']; @endphp
                <div class="tabs {{ $loop->first ? 'active' : '' }}" data-tab="{{ $f['tab'] }}">
                  <div class="cf-body">
                    <p class="cf-intro">{{ $f['intro'] }}</p>

                    <form class="form" action="{{ url('contact') }}" method="post" novalidate>
                      @csrf
                      <input type="hidden" name="brand" value="{{ $f['brand'] }}" />

                      <span class="cf-title">I need help with</span>
                      <div class="cf-chips">
                        @foreach($topics as $i => $topic)
                          <input type="radio" id="{{ $k }}-t{{ $i + 1 }}" name="{{ $k }}-topic" value="{{ $topic }}" {{ $i === 0 ? 'checked' : '' }} />
                          <label for="{{ $k }}-t{{ $i + 1 }}">{{ $topic }}</label>
                        @endforeach
                      </div>

                      <div class="form-grid">
                        <div class="form-group">
                          <input type="text" id="{{ $k }}-name" name="name" placeholder=" " autocomplete="name" required />
                          <label for="{{ $k }}-name">Full Name*</label>
                          <span class="error"></span>
                        </div>
                        <div class="form-group">
                          <input type="tel" id="{{ $k }}-phone" name="phone" placeholder=" " autocomplete="tel" required />
                          <label for="{{ $k }}-phone">Phone Number*</label>
                          <span class="error"></span>
                        </div>
                        <div class="form-group">
                          <input type="email" id="{{ $k }}-email" name="email" placeholder=" " autocomplete="email" required />
                          <label for="{{ $k }}-email">Email Address*</label>
                          <span class="error"></span>
                        </div>
                        <div class="form-group">
                          <select id="{{ $k }}-cat" name="category" required>
                            <option value="" disabled selected>Category*</option>
                            @foreach($f['categories'] as $cat)<option>{{ $cat }}</option>@endforeach
                          </select>
                          <label for="{{ $k }}-cat">Category*</label>
                          <span class="error"></span>
                        </div>
                        <div class="form-group full msg-group">
                          <textarea id="{{ $k }}-msg" name="message" placeholder=" " required></textarea>
                          <label for="{{ $k }}-msg">Your Message*</label>
                          <span class="error"></span>
                        </div>
                      </div>

                      <div class="submit-grp">
                        <button type="submit" class="btn btn-primary">Send Message <i class="fa-solid fa-arrow-right-long"></i></button>
                        <span class="cf-note"><i class="fa-solid fa-lock"></i>Your details are safe with us.</span>
                      </div>
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= C : VISIT US ================= --}}
  <section class="contact-secC">
    <div class="container">
      <div class="visit-wrap">
        <div class="visit-info">
          <div class="heading">
            <span>Come Say Hello</span>
            <h3>Visit <span>Us</span></h3>
            <p>Prefer connecting in person? We'd love to welcome you. Find our location and plan your visit.</p>
          </div>

          <ul class="visit-list">
            <li class="visit_item">
              <span class="visit-icon"><i class="fa-solid fa-location-dot"></i></span>
              <div class="visit-txt">
                <small>Our Location</small>
                <address>24, Hazratganj Main Road, Lucknow, Uttar Pradesh – 226001</address>
              </div>
            </li>
            <li class="visit_item">
              <span class="visit-icon"><i class="fa-solid fa-clock"></i></span>
              <div class="visit-txt">
                <small>Business Hours</small>
                <p>Monday – Saturday, 10:30 AM – 8:30 PM</p>
                <p>Sunday: As per business availability</p>
              </div>
            </li>
            <li class="visit_item">
              <span class="visit-icon"><i class="fa-solid fa-phone"></i></span>
              <div class="visit-txt">
                <small>Phone</small>
                <a href="tel:+919876543210">+91 98765 43210</a>
              </div>
            </li>
          </ul>

          <div class="visit-btn">
            <a href="https://www.google.com/maps/dir/?api=1&destination=Hazratganj+Lucknow+Uttar+Pradesh+226001" target="_blank" rel="noopener" class="btn btn-primary">
              Get Directions <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="visit-map">
          <iframe
            title="Our store location on Google Maps"
            src="https://maps.google.com/maps?q=Hazratganj%20Lucknow%20Uttar%20Pradesh%20226001&t=&z=15&ie=UTF8&iwloc=&output=embed"
            width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= E : FAQ ================= --}}
  <section class="contact-secE">
    <div class="container">
      <div class="faq-wrap">
        <div class="faq-left">
          <div class="heading">
            <span>Need a Quick Answer?</span>
            <h3>Before You <span>Write to Us</span></h3>
            <p>
              You may find what you're looking for in our frequently asked questions. Explore helpful information about
              orders, delivery, products and more.
            </p>
          </div>

          <div class="faq-help">
            <h4>Did not find your answer?</h4>
            <p>Talk to our team directly.</p>
            <a href="tel:{{ $phone }}" class="btn btn-primary"><i class="fa-solid fa-phone"></i> Call Us Now</a>
          </div>
        </div>

        <div class="faq-right">
          <div class="accordion-wrapper">
            @foreach($faqs as [$q, $a])
              <div class="accordion-item">
                <div class="accordion-header">
                  <h4>{{ $q }}</h4>
                  <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-content"><p>{{ $a }}</p></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ================= D : CTA ================= --}}
  <section class="contact-secD">
    <div class="container">
      <div class="cta-card">
        <div class="cta-content">
          <div class="heading">
            <span>We're Always Happy to Help</span>
            <h3>Still Have a Question?</h3>
            <p>
              Couldn't find the answer you were looking for? Send us a message or connect with our team. We're here to
              help you find the right answers.
            </p>
          </div>

          <div class="cta-btns">
            <a href="#contactForm" class="btn btn-white cta-btn">Send an Enquiry <i class="fa-solid fa-arrow-right"></i></a>
            <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="btn btn-white cta-btn">Chat on WhatsApp <i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <div class="cta-img">
          <img src="{{ asset('assets/images/home/jewellery.jpg') }}" alt="Get in touch with Grih Shree and Pihu Jewel" loading="lazy" />
        </div>
      </div>
    </div>
  </section>
@endsection