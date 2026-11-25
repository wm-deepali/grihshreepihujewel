<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Grih Shree & Pihu Jewel</title>
    <!-- ================= Google Fonts ================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- ================= Vendor CSS ================= -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
    />
    <!-- ================= Project CSS ================= -->
    <link rel="stylesheet" href="assets/font/font.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/sass/header/header.css" />
    <link rel="stylesheet" href="assets/sass/footer/footer.css" />
    <link rel="stylesheet" href="assets/sass/home/home.css" />
    <!-- ================= Animation / Popup CSS ================= -->
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/fancybox.css" />
  </head>
  <body>
    <div class="toaster" id="toaster"></div>

    <header>
      <div class="top_header">
        <div class="container-fluid">
          <ul class="top-links left">
            <li><a href="dashboard.html#tab-2">Order Tracking</a></li>
            <li><a href="dashboard.html#tab-1">My Account</a></li>
            <li><a href="about.html">About Us</a></li>
          </ul>
          <div class="swiper announcement-swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <p>
                  A Beautiful World of Home &amp; Jewellery | Explore Our Latest
                  Collections
                </p>
              </div>
              <div class="swiper-slide">
                <p>
                  Handcrafted Bedding, Decor &amp; Jewellery For Every Occasion
                </p>
              </div>
              <div class="swiper-slide">
                <p>Free Shipping Across India On Orders Above ₹999</p>
              </div>
            </div>
          </div>
          <div class="top-right">
            <ul class="top-links">
              <li><a href="contact.html">Contact</a></li>
              <li><a href="shipping-policy.html">Shipping</a></li>
              <li><a href="faqs.html">FAQs</a></li>
            </ul>
            <ul class="top-social">
              <li>
                <a href="javascript:void(0)" aria-label="Facebook"
                  ><i class="fa-brands fa-facebook-f"></i
                ></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-label="Instagram"
                  ><i class="fa-brands fa-instagram"></i
                ></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-label="Pinterest"
                  ><i class="fa-brands fa-pinterest-p"></i
                ></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-label="YouTube"
                  ><i class="fa-brands fa-youtube"></i
                ></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-label="WhatsApp"
                  ><i class="fa-brands fa-whatsapp"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="header-wrapper">
          <div class="colA">
            <button
              type="button"
              class="ham-btn"
              data-model=".ham-pop"
              aria-label="Menu"
            >
              <svg
                viewBox="0 0 24 24"
                width="26"
                height="26"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              >
                <path d="M3 6h18M3 12h18M3 18h18" />
              </svg>
            </button>
            <a href="index.html" class="logo">
              <img
                src="assets/images/logo.png"
                alt="Grih Shree + Pihu Jewel"
                title="Grih Shree + Pihu Jewel"
              />
            </a>
          </div>

          <div class="colB">
            <ul class="menu-list">
              <li class="active"><a href="index.html">Home</a></li>

              <li class="hasMega">
                <a href="all-product-listing.html">
                  Shop All
                  <svg
                    class="chev"
                    viewBox="0 0 24 24"
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 9l6 6 6-6" />
                  </svg>
                </a>
                <div class="mega-menu mega-all">
                  <div class="container-fluid">
                    <div class="mega-halves">
                      <div class="mega-half half-home">
                        <div class="half-head">
                          <h4>Home &amp; Living</h4>
                          <a href="all-product-listing.html" class="head-link">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </div>
                        <div class="half-grid">
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Handloom &amp; Bedding</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bedsheets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Reversible Bedsheets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Cotton Bedsheets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Dohars &amp; Quilts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Comforters</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Pillow Covers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Cushion Covers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Bedding Sets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Home Decor</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Torans &amp; Door Hangings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Wall Decor</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Table Decor</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Showpieces</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Decorative Lanterns</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Decor</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Decorative Accessories</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Festive Collection</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Diwali Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Christmas Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Karwachauth Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Holi Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Rakhi Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Navratri Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Wedding Festivities</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Gifts &amp; Hampers</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Wedding Gifts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Hampers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Return Gifts</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Towel Hampers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Home Decor Gifts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Customised Gift Hampers</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Home Essentials</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bath Towels</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Face Towels</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Towel Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Kitchen Linen</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Table Linen</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Handcrafted Collection</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Crochet Products</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Handmade Decor</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Resin Art</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Handcrafted Accessories</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <div class="mega-half half-jewel">
                        <div class="half-head">
                          <h4>Jewellery &amp; Accessories</h4>
                          <a href="all-product-listing.html" class="head-link">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </div>
                        <div class="half-grid">
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Earrings</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Jhumkas</a>
                              </li>
                              <li><a href="category-listing.html">Studs</a></li>
                              <li>
                                <a href="category-listing.html">Chandbalis</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Drops &amp; Danglers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Earrings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Daily Wear Earrings</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Necklaces</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Matarmala</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Temple Jewellery</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Traditional Necklaces</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Choker Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Necklace Sets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Pendant Sets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Bangles &amp; Bracelets</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bangles</a>
                              </li>
                              <li><a href="category-listing.html">Kada</a></li>
                              <li>
                                <a href="category-listing.html">Bracelets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Fashion Bracelets</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Rings</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Statement Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Adjustable Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Traditional Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Fashion Rings</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Traditional Accessories</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Maang Tikka</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Matha Patti</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Hair Accessories</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Anklets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Jewellery Sets</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bridal Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Festive Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Party Wear Sets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Necklace &amp; Earring Sets</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="hasMega">
                <a href="category-listing.html">
                  Home &amp; Living
                  <svg
                    class="chev"
                    viewBox="0 0 24 24"
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 9l6 6 6-6" />
                  </svg>
                </a>
                <div class="mega-menu mega-brand">
                  <div class="container-fluid">
                    <div class="mega-inner">
                      <div class="mega-main">
                        <div class="half-head">
                          <h4>Home &amp; Living</h4>
                          <a href="category-listing.html" class="head-link">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </div>
                        <div class="mega-grid">
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Handloom &amp; Bedding</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bedsheets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Reversible Bedsheets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Cotton Bedsheets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Dohars &amp; Quilts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Comforters</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Pillow Covers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Cushion Covers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Bedding Sets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Home Decor</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Torans &amp; Door Hangings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Wall Decor</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Table Decor</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Showpieces</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Decorative Lanterns</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Decor</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Decorative Accessories</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Festive Collection</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Diwali Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Christmas Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Karwachauth Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Holi Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Rakhi Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Navratri Collection</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Wedding Festivities</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Gifts &amp; Hampers</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Wedding Gifts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Hampers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Return Gifts</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Towel Hampers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Home Decor Gifts</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Customised Gift Hampers</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Home Essentials</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bath Towels</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Face Towels</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Towel Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Kitchen Linen</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Table Linen</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Handcrafted Collection</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Crochet Products</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Handmade Decor</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Resin Art</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Handcrafted Accessories</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="mega-feature">
                        <img
                          src="assets/images/home/pro1.png"
                          alt="Beautiful Living"
                          loading="lazy"
                        />
                        <span class="feature-text">
                          <span class="feature-label">Beautiful Living</span>
                          <a href="category-listing.html" class="feature-btn">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="hasMega">
                <a href="category-listing.html">
                  Jewellery
                  <svg
                    class="chev"
                    viewBox="0 0 24 24"
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 9l6 6 6-6" />
                  </svg>
                </a>
                <div class="mega-menu mega-brand">
                  <div class="container-fluid">
                    <div class="mega-inner">
                      <div class="mega-main">
                        <div class="half-head">
                          <h4>Jewellery &amp; Accessories</h4>
                          <a href="category-listing.html" class="head-link">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </div>
                        <div class="mega-grid">
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Earrings</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Jhumkas</a>
                              </li>
                              <li><a href="category-listing.html">Studs</a></li>
                              <li>
                                <a href="category-listing.html">Chandbalis</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Drops &amp; Danglers</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Festive Earrings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Daily Wear Earrings</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Necklaces</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Matarmala</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Temple Jewellery</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Traditional Necklaces</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Choker Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Necklace Sets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Pendant Sets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Bangles &amp; Bracelets</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bangles</a>
                              </li>
                              <li><a href="category-listing.html">Kada</a></li>
                              <li>
                                <a href="category-listing.html">Bracelets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Fashion Bracelets</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Rings</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html"
                                  >Statement Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Adjustable Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Traditional Rings</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Fashion Rings</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Traditional Accessories</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Maang Tikka</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Matha Patti</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Hair Accessories</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html">Anklets</a>
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <a href="category-listing.html" class="col-title"
                              >Jewellery Sets</a
                            >
                            <ul>
                              <li>
                                <a href="category-listing.html">Bridal Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html">Festive Sets</a>
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Party Wear Sets</a
                                >
                              </li>
                              <li>
                                <a href="category-listing.html"
                                  >Necklace &amp; Earring Sets</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="mega-feature">
                        <img
                          src="assets/images/home/pro2.png"
                          alt="Timeless Adornment"
                          loading="lazy"
                        />
                        <span class="feature-text">
                          <span class="feature-label">Timeless Adornment</span>
                          <a href="category-listing.html" class="feature-btn">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="hasMega">
                <a href="all-product-listing.html">
                  Shop by Collections
                  <svg
                    class="chev"
                    viewBox="0 0 24 24"
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 9l6 6 6-6" />
                  </svg>
                </a>
                <div class="mega-menu mega-brand">
                  <div class="container-fluid">
                    <div class="mega-inner">
                      <div class="mega-main">
                        <div class="half-head">
                          <h4>Shop by Collections</h4>
                          <a href="all-product-listing.html" class="head-link">
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </div>
                        <div class="mega-grid cols-4">
                          <div class="mega-col">
                            <span class="col-title">Featured</span>
                            <ul>
                              <li>
                                <a href="all-product-listing.html"
                                  >New Arrivals</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Best Sellers</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Festive Specials</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Premium Collection</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Handcrafted Collection</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <span class="col-title">Shop by Occasion</span>
                            <ul>
                              <li>
                                <a href="all-product-listing.html">Wedding</a>
                              </li>
                              <li>
                                <a href="all-product-listing.html">Festive</a>
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Party Wear</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Daily Wear</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Housewarming</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <span class="col-title">Gift Ideas</span>
                            <ul>
                              <li>
                                <a href="all-product-listing.html"
                                  >Gifts for Her</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Gifts for Home</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Wedding Gifts</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Return Gifts</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Festive Hampers</a
                                >
                              </li>
                            </ul>
                          </div>
                          <div class="mega-col">
                            <span class="col-title">Price Range</span>
                            <ul>
                              <li>
                                <a href="all-product-listing.html"
                                  >Under ₹499</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >Under ₹999</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >₹1,000 - ₹1,999</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >₹2,000 - ₹4,999</a
                                >
                              </li>
                              <li>
                                <a href="all-product-listing.html"
                                  >₹5,000 &amp; Above</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="mega-feature">
                        <img
                          src="assets/images/home/pro3.png"
                          alt="Festive Specials"
                          loading="lazy"
                        />
                        <span class="feature-text">
                          <span class="feature-label">Festive Specials</span>
                          <a
                            href="all-product-listing.html"
                            class="feature-btn"
                          >
                            View All Collection
                            <svg
                              viewBox="0 0 24 24"
                              width="14"
                              height="14"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="hasDrop">
                <a href="category-listing.html">
                  Gifts
                  <svg
                    class="chev"
                    viewBox="0 0 24 24"
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M6 9l6 6 6-6" />
                  </svg>
                </a>
                <ul class="drop-menu">
                  <li><a href="category-listing.html">Wedding Gifts</a></li>
                  <li><a href="category-listing.html">Festive Hampers</a></li>
                  <li><a href="category-listing.html">Return Gifts</a></li>
                  <li><a href="category-listing.html">Towel Hampers</a></li>
                  <li>
                    <a href="category-listing.html">Customised Gift Hampers</a>
                  </li>
                </ul>
              </li>

              <li><a href="about.html">About Us</a></li>
            </ul>
          </div>

          <div class="colC">
            <div class="search-box-wrapper">
              <button
                type="button"
                class="action-link search-btn"
                aria-label="Search"
              >
                <svg
                  viewBox="0 0 24 24"
                  width="24"
                  height="24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                >
                  <circle cx="11" cy="11" r="7.5" />
                  <path d="M16.5 16.5L21 21" />
                </svg>
              </button>
              <div class="formField">
                <input
                  type="text"
                  class="searchInput"
                  placeholder="Search for bedsheets, home decor, earrings, necklaces..."
                  autocomplete="off"
                />
                <div class="search-results">
                  <span class="res-label">Suggestions</span>
                  <ul class="res-list">
                    <li
                      data-name="handloom cotton bedsheet set bedsheets bedding grih shree"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro1.png"
                          alt="Handloom Cotton Bedsheet Set"
                        />
                        <span class="res-info"
                          ><strong>Handloom Cotton Bedsheet Set</strong
                          ><small>Handloom &amp; Bedding</small></span
                        >
                        <span class="res-price">₹2,499</span>
                      </a>
                    </li>
                    <li
                      data-name="kundan choker necklace necklaces choker jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro2.png"
                          alt="Kundan Choker Necklace"
                        />
                        <span class="res-info"
                          ><strong>Kundan Choker Necklace</strong
                          ><small>Necklaces</small></span
                        >
                        <span class="res-price">₹1,899</span>
                      </a>
                    </li>
                    <li
                      data-name="brass diya gift set diya decor festive gifts grih shree"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro3.png"
                          alt="Brass Diya Gift Set"
                        />
                        <span class="res-info"
                          ><strong>Brass Diya Gift Set</strong
                          ><small>Festive Decor</small></span
                        >
                        <span class="res-price">₹899</span>
                      </a>
                    </li>
                    <li
                      data-name="pearl drop earrings earrings drops danglers jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro4.png"
                          alt="Pearl Drop Earrings"
                        />
                        <span class="res-info"
                          ><strong>Pearl Drop Earrings</strong
                          ><small>Earrings</small></span
                        >
                        <span class="res-price">₹749</span>
                      </a>
                    </li>
                    <li
                      data-name="jaipuri cotton quilt quilts dohars bedding grih shree"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro1.png"
                          alt="Jaipuri Cotton Quilt"
                        />
                        <span class="res-info"
                          ><strong>Jaipuri Cotton Quilt</strong
                          ><small>Dohars &amp; Quilts</small></span
                        >
                        <span class="res-price">₹3,199</span>
                      </a>
                    </li>
                    <li
                      data-name="meenakari bangle set bangles bracelets jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro4.png"
                          alt="Meenakari Bangle Set"
                        />
                        <span class="res-info"
                          ><strong>Meenakari Bangle Set</strong
                          ><small>Bangles &amp; Bracelets</small></span
                        >
                        <span class="res-price">₹1,299</span>
                      </a>
                    </li>
                    <li
                      data-name="hand-painted ceramic planter planter home decor handcrafted grih shree"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro3.png"
                          alt="Hand-Painted Ceramic Planter"
                        />
                        <span class="res-info"
                          ><strong>Hand-Painted Ceramic Planter</strong
                          ><small>Handcrafted Collection</small></span
                        >
                        <span class="res-price">₹1,099</span>
                      </a>
                    </li>
                    <li
                      data-name="temple jewellery ring set rings temple jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro2.png"
                          alt="Temple Jewellery Ring Set"
                        />
                        <span class="res-info"
                          ><strong>Temple Jewellery Ring Set</strong
                          ><small>Rings</small></span
                        >
                        <span class="res-price">₹999</span>
                      </a>
                    </li>
                    <li
                      data-name="polki choker necklace set necklace sets choker jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro2.png"
                          alt="Polki Choker Necklace Set"
                        />
                        <span class="res-info"
                          ><strong>Polki Choker Necklace Set</strong
                          ><small>Necklace Sets</small></span
                        >
                        <span class="res-price">₹2,299</span>
                      </a>
                    </li>
                    <li
                      data-name="gold plated jhumka earrings jhumkas earrings jewellery pihu jewel"
                    >
                      <a href="product-detail.html">
                        <img
                          src="assets/images/home/pro4.png"
                          alt="Gold Plated Jhumka Earrings"
                        />
                        <span class="res-info"
                          ><strong>Gold Plated Jhumka Earrings</strong
                          ><small>Jhumkas</small></span
                        >
                        <span class="res-price">₹849</span>
                      </a>
                    </li>
                  </ul>
                  <p class="res-empty">
                    No products found. Try another keyword.
                  </p>
                  <a href="all-product-listing.html" class="res-all"
                    >View All Results <i class="fa-solid fa-arrow-right"></i
                  ></a>
                </div>
              </div>
            </div>

            <a
              href="javascript:void(0)"
              class="action-link"
              data-model=".login-pop"
              aria-label="Wishlist"
            >
              <svg
                viewBox="0 0 24 24"
                width="24"
                height="24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path
                  d="M12 20.5s-8-4.9-8-11A4.6 4.6 0 0112 6.8a4.6 4.6 0 018 2.7c0 6.1-8 11-8 11z"
                />
              </svg>
              <span class="count">0</span>
            </a>

            <div class="account-wrapper">
              <button
                type="button"
                class="action-link account-btn"
                aria-label="Account"
                title="Account"
              >
                <svg
                  viewBox="0 0 24 24"
                  width="24"
                  height="24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                >
                  <circle cx="12" cy="8" r="4.2" />
                  <path d="M4 21c0-4.4 3.6-7.5 8-7.5s8 3.1 8 7.5" />
                </svg>
              </button>
              <div class="account-drop">
                <div class="acc-user">
                  <span class="acc-avatar">A</span>
                  <div class="acc-name">
                    <strong>Ananya Kapoor</strong>
                    <small>ananya@example.com</small>
                  </div>
                </div>
                <ul class="acc-list">
                  <li>
                    <a href="dashboard.html#tab-1"
                      ><i class="fa-solid fa-table-columns"></i> My Account</a
                    >
                  </li>
                  <li>
                    <a href="dashboard.html#tab-2"
                      ><i class="fa-solid fa-truck-fast"></i> Track Order</a
                    >
                  </li>
                  <li>
                    <a href="dashboard.html#tab-3"
                      ><i class="fa-solid fa-box-open"></i> My Orders</a
                    >
                  </li>
                  <li>
                    <a href="dashboard.html#tab-4"
                      ><i class="fa-regular fa-heart"></i> My Wishlist</a
                    >
                  </li>
                  <li>
                    <a href="dashboard.html#tab-5"
                      ><i class="fa-regular fa-user"></i> My Profile</a
                    >
                  </li>
                  <li class="acc-out">
                    <a href="javascript:void(0)"
                      ><i class="fa-solid fa-right-from-bracket"></i> Sign
                      Out</a
                    >
                  </li>
                </ul>
              </div>
            </div>

            <a
              href="javascript:void(0)"
              data-model=".cart-pop"
              class="action-link"
              aria-label="Cart"
            >
              <svg
                viewBox="0 0 24 24"
                width="24"
                height="24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M5 8h14l-1 12.5H6L5 8z" />
                <path d="M8.5 8V6.5a3.5 3.5 0 017 0V8" />
              </svg>
              <span class="count">1</span>
            </a>
          </div>
        </div>
      </div>
    </header>

    <main>
      <section class="home-banner">
        <div class="swiper singleSlider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="slide-img">
                <img
                  src="assets/images/home/banner.jpg"
                  alt="Beautiful living"
                />
              </div>
              <div class="container-fluid">
                <div class="hero-grid">
                  <div class="slide-content">
                    <span class="hero-eyebrow"
                      >Grih Shree &amp; Pihu Jewel</span
                    >
                    <h1 class="hero-title">
                      Beautiful Living.<br />Timeless Adornment.
                    </h1>
                    <p class="hero-desc">
                      Discover thoughtfully curated home essentials and
                      beautiful jewellery for everyday moments and special
                      occasions.
                    </p>
                    <div class="hero-btns">
                      <a href="category-listing.html" class="btn btn-white"
                        >Shop Home &amp; Living</a
                      >
                      <a
                        href="category-listing.html"
                        class="btn btn-outline-white"
                        >Explore Jewellery</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="slide-img">
                <img
                  src="assets/images/home/banner2.jpg"
                  alt="Home and living"
                />
                <!-- for video use this instead of img:
              <video src="assets/videos/hero.mp4" autoplay muted loop playsinline></video> -->
              </div>
              <div class="container-fluid">
                <div class="hero-grid">
                  <div class="slide-content">
                    <span class="hero-eyebrow"
                      >The Art of Beautiful Living</span
                    >
                    <h1 class="hero-title">
                      Make Every Corner<br />Feel Like Home.
                    </h1>
                    <p class="hero-desc">
                      Bring warmth, comfort and character to your spaces with
                      beautiful bedding, handcrafted decor and everyday
                      essentials.
                    </p>
                    <div class="hero-btns">
                      <a href="category-listing.html" class="btn btn-white"
                        >Explore Home &amp; Living</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="slider-ui">
            <div class="container-fluid">
              <div class="ui-row">
                <div class="swiper-pagination"></div>
                <div class="hero-nav">
                  <button
                    type="button"
                    class="hero-arrow singleSlider-prev"
                    aria-label="Previous"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      width="20"
                      height="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M15 4l-8 8 8 8" />
                    </svg>
                  </button>
                  <button
                    type="button"
                    class="hero-arrow singleSlider-next"
                    aria-label="Next"
                  >
                    <svg
                      viewBox="0 0 24 24"
                      width="20"
                      height="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M9 4l8 8-8 8" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secB">
        <div class="container">
          <div class="heading">
            <span>Curated just for you</span>
            <h3>Shop by <span>Collection</span></h3>
            <p>
              Discover thoughtfully selected collections for beautiful spaces,
              meaningful celebrations and effortless personal style.
            </p>
          </div>

          <ul class="tab-nav">
            <li data-tab="1" class="active">All</li>
            <li data-tab="2">Home &amp; Living</li>
            <li data-tab="3">Jewellery</li>
          </ul>

          <div class="tab-nav-content">
            <!-- ================= TAB 1 : ALL ================= -->
            <div class="tabs active" data-tab="1">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="5"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat1.png"
                              alt="Handloom &amp; Bedding"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Handloom &amp; Bedding</h4>
                          <p>Comfort begins with beautiful details.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Earrings"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Earrings</h4>
                          <p>Find your perfect finishing touch.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat3.png"
                              alt="Home Decor"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Home Decor</h4>
                          <p>Little details that make a space yours.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Necklaces"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Necklaces</h4>
                          <p>Pieces that make every look memorable.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat5.png"
                              alt="Festive Collection"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Festive Collection</h4>
                          <p>Celebrate every occasion beautifully.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Bangles &amp; Bracelets"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Bangles &amp; Bracelets</h4>
                          <p>Beautiful details for every occasion.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat1.png"
                              alt="Gifts &amp; Hampers"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Gifts &amp; Hampers</h4>
                          <p>Thoughtful gifts for meaningful moments.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Rings"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Rings</h4>
                          <p>Small details, lasting impressions.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat3.png"
                              alt="Home Essentials"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Home Essentials</h4>
                          <p>Everyday essentials, thoughtfully chosen.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Traditional Accessories"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Traditional Accessories</h4>
                          <p>Celebrate timeless Indian elegance.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat5.png"
                              alt="Handcrafted Collection"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Handcrafted Collection</h4>
                          <p>The charm of art made by hand.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Jewellery Sets"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Jewellery Sets</h4>
                          <p>Complete your look with coordinated elegance.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 2 : HOME & LIVING ================= -->
            <div class="tabs" data-tab="2">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="5"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat1.png"
                              alt="Handloom &amp; Bedding"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Handloom &amp; Bedding</h4>
                          <p>Comfort begins with beautiful details.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat3.png"
                              alt="Home Decor"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Home Decor</h4>
                          <p>Little details that make a space yours.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat5.png"
                              alt="Festive Collection"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Festive Collection</h4>
                          <p>Celebrate every occasion beautifully.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat1.png"
                              alt="Gifts &amp; Hampers"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Gifts &amp; Hampers</h4>
                          <p>Thoughtful gifts for meaningful moments.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat3.png"
                              alt="Home Essentials"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Home Essentials</h4>
                          <p>Everyday essentials, thoughtfully chosen.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat5.png"
                              alt="Handcrafted Collection"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Grih Shree</span>
                          <h4>Handcrafted Collection</h4>
                          <p>The charm of art made by hand.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 3 : JEWELLERY ================= -->
            <div class="tabs" data-tab="3">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="5"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Earrings"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Earrings</h4>
                          <p>Find your perfect finishing touch.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Necklaces"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Necklaces</h4>
                          <p>Pieces that make every look memorable.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Bangles &amp; Bracelets"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Bangles &amp; Bracelets</h4>
                          <p>Beautiful details for every occasion.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Rings"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Rings</h4>
                          <p>Small details, lasting impressions.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat2.png"
                              alt="Traditional Accessories"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Traditional Accessories</h4>
                          <p>Celebrate timeless Indian elegance.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="coll_card">
                        <figure>
                          <picture
                            ><img
                              src="assets/images/home/cat4.png"
                              alt="Jewellery Sets"
                              loading="lazy"
                          /></picture>
                        </figure>
                        <div class="info">
                          <span class="brand">Pihu Jewel</span>
                          <h4>Jewellery Sets</h4>
                          <p>Complete your look with coordinated elegance.</p>
                          <span class="cta"
                            >Explore <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secC">
        <div class="container">
          <div class="heading">
            <span>Our Best Sellers</span>
            <h3>Most Loved. <span>Best Selling.</span></h3>
            <p>
              Discover the customer favourites everyone loves, from timeless
              designs to must-have picks.
            </p>
          </div>

          <ul class="tab-nav">
            <li data-tab="1" class="active">All Favourites</li>
            <li data-tab="2">Home &amp; Living</li>
            <li data-tab="3">Jewellery</li>
          </ul>

          <div class="tab-nav-content">
            <!-- ================= TAB 1 : ALL ================= -->
            <div class="tabs active" data-tab="1">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Handloom Cotton Bedsheet Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G1"
                              data-name="Handloom Cotton Bedsheet Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Handloom Cotton Bedsheet Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Handloom Cotton Bedsheet Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Pure cotton, double bed with 2 pillow covers
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹2,499</span>
                            <span class="price-old">₹3,299</span>
                            <span class="prod-save">Save 24%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Kundan Choker Necklace"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge top"
                            ><i class="fa-solid fa-star"></i>Top Rated</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P1"
                              data-name="Kundan Choker Necklace"
                              data-toast-title="Added to Cart"
                              data-toast-text="Kundan Choker Necklace has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.9</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Kundan Choker Necklace</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Handcrafted kundan with pearl drops
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,899</span>
                            <span class="price-old">₹2,599</span>
                            <span class="prod-save">Save 27%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Brass Diya Gift Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge trend"
                            ><i class="fa-solid fa-fire"></i>Trending</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G2"
                              data-name="Brass Diya Gift Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Brass Diya Gift Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Brass Diya Gift Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 4 hand-finished brass diyas
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹899</span>
                            <span class="price-old">₹1,199</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Pearl Drop Earrings"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P2"
                              data-name="Pearl Drop Earrings"
                              data-toast-title="Added to Cart"
                              data-toast-text="Pearl Drop Earrings has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Pearl Drop Earrings</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Lightweight, for daily and festive wear
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹749</span>
                            <span class="price-old">₹999</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Jaipuri Cotton Quilt"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge top"
                            ><i class="fa-solid fa-star"></i>Top Rated</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G3"
                              data-name="Jaipuri Cotton Quilt"
                              data-toast-title="Added to Cart"
                              data-toast-text="Jaipuri Cotton Quilt has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.9</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Jaipuri Cotton Quilt</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Soft Jaipuri print, light and warm
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹3,199</span>
                            <span class="price-old">₹3,999</span>
                            <span class="prod-save">Save 20%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Meenakari Bangle Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge trend"
                            ><i class="fa-solid fa-fire"></i>Trending</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P3"
                              data-name="Meenakari Bangle Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Meenakari Bangle Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Meenakari Bangle Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 6 with colourful meenakari work
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,299</span>
                            <span class="price-old">₹1,799</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Hand-Painted Ceramic Planter"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge hand"
                            ><i class="fa-solid fa-hand-sparkles"></i
                            >Handcrafted</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G4"
                              data-name="Hand-Painted Ceramic Planter"
                              data-toast-title="Added to Cart"
                              data-toast-text="Hand-Painted Ceramic Planter has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Hand-Painted Ceramic Planter</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Hand-painted, ideal for indoor plants
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,099</span>
                            <span class="price-old">₹1,499</span>
                            <span class="prod-save">Save 27%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Temple Jewellery Ring Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P4"
                              data-name="Temple Jewellery Ring Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Temple Jewellery Ring Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.6</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Temple Jewellery Ring Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 5 adjustable temple rings
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹999</span>
                            <span class="price-old">₹1,399</span>
                            <span class="prod-save">Save 29%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 2 : HOME & LIVING ================= -->
            <div class="tabs" data-tab="2">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Handloom Cotton Bedsheet Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G1"
                              data-name="Handloom Cotton Bedsheet Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Handloom Cotton Bedsheet Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Handloom Cotton Bedsheet Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Pure cotton, double bed with 2 pillow covers
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹2,499</span>
                            <span class="price-old">₹3,299</span>
                            <span class="prod-save">Save 24%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Brass Diya Gift Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge trend"
                            ><i class="fa-solid fa-fire"></i>Trending</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G2"
                              data-name="Brass Diya Gift Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Brass Diya Gift Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Brass Diya Gift Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 4 hand-finished brass diyas
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹899</span>
                            <span class="price-old">₹1,199</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Jaipuri Cotton Quilt"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge top"
                            ><i class="fa-solid fa-star"></i>Top Rated</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G3"
                              data-name="Jaipuri Cotton Quilt"
                              data-toast-title="Added to Cart"
                              data-toast-text="Jaipuri Cotton Quilt has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.9</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Jaipuri Cotton Quilt</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Soft Jaipuri print, light and warm
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹3,199</span>
                            <span class="price-old">₹3,999</span>
                            <span class="prod-save">Save 20%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Hand-Painted Ceramic Planter"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge hand"
                            ><i class="fa-solid fa-hand-sparkles"></i
                            >Handcrafted</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G4"
                              data-name="Hand-Painted Ceramic Planter"
                              data-toast-title="Added to Cart"
                              data-toast-text="Hand-Painted Ceramic Planter has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Hand-Painted Ceramic Planter</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Hand-painted, ideal for indoor plants
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,099</span>
                            <span class="price-old">₹1,499</span>
                            <span class="prod-save">Save 27%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 3 : JEWELLERY ================= -->
            <div class="tabs" data-tab="3">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Kundan Choker Necklace"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge top"
                            ><i class="fa-solid fa-star"></i>Top Rated</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P1"
                              data-name="Kundan Choker Necklace"
                              data-toast-title="Added to Cart"
                              data-toast-text="Kundan Choker Necklace has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.9</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Kundan Choker Necklace</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Handcrafted kundan with pearl drops
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,899</span>
                            <span class="price-old">₹2,599</span>
                            <span class="prod-save">Save 27%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Pearl Drop Earrings"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P2"
                              data-name="Pearl Drop Earrings"
                              data-toast-title="Added to Cart"
                              data-toast-text="Pearl Drop Earrings has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Pearl Drop Earrings</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Lightweight, for daily and festive wear
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹749</span>
                            <span class="price-old">₹999</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Meenakari Bangle Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge trend"
                            ><i class="fa-solid fa-fire"></i>Trending</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P3"
                              data-name="Meenakari Bangle Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Meenakari Bangle Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Meenakari Bangle Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 6 with colourful meenakari work
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,299</span>
                            <span class="price-old">₹1,799</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Temple Jewellery Ring Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge best"
                            ><i class="fa-solid fa-crown"></i>Best Seller</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P4"
                              data-name="Temple Jewellery Ring Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Temple Jewellery Ring Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.6</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Temple Jewellery Ring Set</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Set of 5 adjustable temple rings
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹999</span>
                            <span class="price-old">₹1,399</span>
                            <span class="prod-save">Save 29%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="sec-btn">
            <a href="all-product-listing.html" class="btn btn-outline-primary"
              >View All Bestsellers</a
            >
          </div>
        </div>
      </section>

      <section class="home-secD">
        <div class="container">
          <div class="heading">
            <span>Our World, Our Stories</span>
            <h3>Something Beautiful for <span>Every Moment</span></h3>
            <p>
              Explore thoughtfully curated home essentials and jewellery, all in
              one place.
            </p>
          </div>
        </div>

        <div class="brand-panels">
          <!-- ================= GRIH SHREE ================= -->
          <article class="brand_panel">
            <img
              class="panel-img"
              src="assets/images/home/banner2.jpg"
              alt="Grih Shree bedding, home decor and handcrafted details"
              loading="lazy"
            />
            <div class="panel-content">
              <span class="panel-brand">Grih Shree</span>
              <h4 class="panel-title">The Art of Beautiful Living</h4>
              <p class="panel-desc">
                Bedding, home décor and handcrafted details that make every
                space feel special.
              </p>
              <a href="category-listing.html" class="btn btn-white panel-cta">
                Explore Home &amp; Living
                <svg
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M4 12h16M14 6l6 6-6 6" />
                </svg>
              </a>
            </div>
          </article>

          <!-- ================= PIHU JEWEL ================= -->
          <article class="brand_panel">
            <img
              class="panel-img"
              src="assets/images/home/moments.jpg"
              alt="Pihu Jewel necklaces and jewellery for every occasion"
              loading="lazy"
            />
            <div class="panel-content">
              <span class="panel-brand">Pihu Jewel</span>
              <h4 class="panel-title">Elegance in Every Detail</h4>
              <p class="panel-desc">
                Beautiful jewellery and accessories for everyday expression and
                special occasions.
              </p>
              <a href="category-listing.html" class="btn btn-white panel-cta">
                Explore Jewellery
                <svg
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M4 12h16M14 6l6 6-6 6" />
                </svg>
              </a>
            </div>
          </article>
        </div>
      </section>

      <section class="home-secE">
        <div class="container">
          <div class="heading">
            <span>Just Arrived</span>
            <h3>Fresh Finds, <span>Beautiful Discoveries</span></h3>
            <p>
              Explore our latest additions, thoughtfully selected to bring fresh
              charm to your home and a beautiful touch to your style.
            </p>
          </div>

          <ul class="tab-nav">
            <li data-tab="1" class="active">All New Arrivals</li>
            <li data-tab="2">Home &amp; Living</li>
            <li data-tab="3">Jewellery</li>
          </ul>

          <div class="tab-nav-content">
            <!-- ================= TAB 1 : ALL (2 Grih Shree + 2 Pihu Jewel) ================= -->
            <div class="tabs active" data-tab="1">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Block Print Cotton Dohar"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G5"
                              data-name="Block Print Cotton Dohar"
                              data-toast-title="Added to Cart"
                              data-toast-text="Block Print Cotton Dohar has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Block Print Cotton Dohar</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Hand block printed, soft and breathable
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,799</span>
                            <span class="price-old">₹2,399</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Polki Choker Necklace Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P5"
                              data-name="Polki Choker Necklace Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Polki Choker Necklace Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Polki Choker Necklace Set</a
                            >
                          </h5>
                          <p class="prod-sub">Choker with matching earrings</p>
                          <div class="prod-price">
                            <span class="price-now">₹2,299</span>
                            <span class="price-old">₹3,199</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Brass Tealight Diya Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G6"
                              data-name="Brass Tealight Diya Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Brass Tealight Diya Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.6</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Brass Tealight Diya Set</a
                            >
                          </h5>
                          <p class="prod-sub">Set of 4 for festive tables</p>
                          <div class="prod-price">
                            <span class="price-now">₹649</span>
                            <span class="price-old">₹899</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Gold Plated Jhumka Earrings"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P6"
                              data-name="Gold Plated Jhumka Earrings"
                              data-toast-title="Added to Cart"
                              data-toast-text="Gold Plated Jhumka Earrings has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Gold Plated Jhumka Earrings</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Classic jhumka with pearl finish
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹849</span>
                            <span class="price-old">₹1,199</span>
                            <span class="prod-save">Save 29%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Brass Tealight Diya Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G6"
                              data-name="Brass Tealight Diya Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Brass Tealight Diya Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.6</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Brass Tealight Diya Set</a
                            >
                          </h5>
                          <p class="prod-sub">Set of 4 for festive tables</p>
                          <div class="prod-price">
                            <span class="price-now">₹649</span>
                            <span class="price-old">₹899</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 2 : HOME & LIVING (Grih Shree only) ================= -->
            <div class="tabs" data-tab="2">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Block Print Cotton Dohar"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G5"
                              data-name="Block Print Cotton Dohar"
                              data-toast-title="Added to Cart"
                              data-toast-text="Block Print Cotton Dohar has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Block Print Cotton Dohar</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Hand block printed, soft and breathable
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,799</span>
                            <span class="price-old">₹2,399</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Brass Tealight Diya Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G6"
                              data-name="Brass Tealight Diya Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Brass Tealight Diya Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.6</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Brass Tealight Diya Set</a
                            >
                          </h5>
                          <p class="prod-sub">Set of 4 for festive tables</p>
                          <div class="prod-price">
                            <span class="price-now">₹649</span>
                            <span class="price-old">₹899</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro1.png"
                              alt="Embroidered Cushion Cover Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G7"
                              data-name="Embroidered Cushion Cover Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Embroidered Cushion Cover Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Embroidered Cushion Cover Set</a
                            >
                          </h5>
                          <p class="prod-sub">Set of 5 with fine thread work</p>
                          <div class="prod-price">
                            <span class="price-now">₹1,199</span>
                            <span class="price-old">₹1,599</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro3.png"
                              alt="Handcrafted Brass Urli Decor"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-G8"
                              data-name="Handcrafted Brass Urli Decor"
                              data-toast-title="Added to Cart"
                              data-toast-text="Handcrafted Brass Urli Decor has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Grih Shree</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Handcrafted Brass Urli Decor</a
                            >
                          </h5>
                          <p class="prod-sub">
                            For floating flowers and candles
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,499</span>
                            <span class="price-old">₹1,999</span>
                            <span class="prod-save">Save 25%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- ================= TAB 3 : JEWELLERY (Pihu Jewel only) ================= -->
            <div class="tabs" data-tab="3">
              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="3"
                  data-lg="4"
                  data-xl="4"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Polki Choker Necklace Set"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P5"
                              data-name="Polki Choker Necklace Set"
                              data-toast-title="Added to Cart"
                              data-toast-text="Polki Choker Necklace Set has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Polki Choker Necklace Set</a
                            >
                          </h5>
                          <p class="prod-sub">Choker with matching earrings</p>
                          <div class="prod-price">
                            <span class="price-now">₹2,299</span>
                            <span class="price-old">₹3,199</span>
                            <span class="prod-save">Save 28%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Gold Plated Jhumka Earrings"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P6"
                              data-name="Gold Plated Jhumka Earrings"
                              data-toast-title="Added to Cart"
                              data-toast-text="Gold Plated Jhumka Earrings has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.7</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Gold Plated Jhumka Earrings</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Classic jhumka with pearl finish
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹849</span>
                            <span class="price-old">₹1,199</span>
                            <span class="prod-save">Save 29%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro2.png"
                              alt="Layered Kundan Necklace"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P7"
                              data-name="Layered Kundan Necklace"
                              data-toast-title="Added to Cart"
                              data-toast-text="Layered Kundan Necklace has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.9</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Layered Kundan Necklace</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Two-layer kundan for festive looks
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹1,599</span>
                            <span class="price-old">₹2,199</span>
                            <span class="prod-save">Save 27%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="prod_cart">
                        <div class="prod-img">
                          <a href="product-detail.html" class="prod-link">
                            <img
                              src="assets/images/home/pro4.png"
                              alt="Pearl Chandbali Earrings"
                              loading="lazy"
                            />
                          </a>
                          <span class="prod-badge new"
                            ><i class="fa-solid fa-sparkles"></i>New</span
                          >
                          <div class="prod-actions">
                            <button
                              type="button"
                              class="act-btn wish-btn"
                              aria-label="Wishlist"
                            >
                              <i class="fa-regular fa-heart"></i>
                            </button>
                            <button
                              type="button"
                              class="act-btn quick-btn"
                              aria-label="Quick view"
                              data-model=".product-view-pop"
                            >
                              <i class="fa-regular fa-eye"></i>
                            </button>
                          </div>
                          <div class="prod-btns">
                            <button
                              type="button"
                              data-id="SKU-P8"
                              data-name="Pearl Chandbali Earrings"
                              data-toast-title="Added to Cart"
                              data-toast-text="Pearl Chandbali Earrings has been added to your cart."
                              data-toast-type="success"
                              class="btn btn-outline-black prod-cta"
                            >
                              Add to Cart
                            </button>
                            <a
                              href="product-detail.html"
                              class="btn btn-primary prod-cta"
                              >Buy Now</a
                            >
                          </div>
                        </div>
                        <div class="prod-info">
                          <div class="prod-meta">
                            <span class="prod-brand">Pihu Jewel</span>
                            <span class="prod-rate"><i>★</i> 4.8</span>
                          </div>
                          <h5 class="prod-name">
                            <a href="product-detail.html"
                              >Pearl Chandbali Earrings</a
                            >
                          </h5>
                          <p class="prod-sub">
                            Statement chandbali with pearl drops
                          </p>
                          <div class="prod-price">
                            <span class="price-now">₹999</span>
                            <span class="price-old">₹1,399</span>
                            <span class="prod-save">Save 29%</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="sec-btn">
            <a href="all-product-listing.html" class="btn btn-outline-primary"
              >View All New Arrivals</a
            >
          </div>
        </div>
      </section>

      <section class="home-secF">
        <div class="container">
          <div class="heading">
            <span>Special Picks For You</span>
            <h3>A Little Something <span>to Make You Smile</span></h3>
            <p>
              Discover special offers on thoughtfully selected pieces for your
              home, celebrations and personal style.
            </p>
          </div>

          <div class="ticket-grid">
            <!-- ================= GRIH SHREE ================= -->
            <div class="offer_ticket">
              <article class="ticket-photo">
                <img
                  src="assets/images/home/banner2.jpg"
                  alt="Grih Shree home and living offers"
                  loading="lazy"
                />
                <div class="ticket-left">
                  <span class="ticket-brand"
                    >Grih Shree &middot; Home &amp; Living</span
                  >
                  <h4 class="ticket-title">Make home feel<br />new again.</h4>
                  <a
                    href="category-listing.html"
                    class="btn btn-white ticket-cta"
                  >
                    Shop Home Offers
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M4 12h16M14 6l6 6-6 6" />
                    </svg>
                  </a>
                </div>
                <div class="ticket-save">
                  <small>Save up to</small>
                  <strong>30<sup>%</sup></strong>
                </div>
              </article>

              <div class="coupon_box">
                <span class="coupon-icon"
                  ><i class="fa-solid fa-ticket"></i
                ></span>
                <div class="coupon-text">
                  <strong>GRIHHOME</strong>
                  <p>Special savings on selected home &amp; living pieces.</p>
                </div>
                <button type="button" class="code-copy" data-code="GRIHHOME">
                  Copy Code
                </button>
              </div>
            </div>

            <!-- ================= PIHU JEWEL ================= -->
            <div class="offer_ticket">
              <article class="ticket-photo">
                <img
                  src="assets/images/home/jewellery.jpg"
                  alt="Pihu Jewel jewellery offers"
                  loading="lazy"
                />
                <div class="ticket-left">
                  <span class="ticket-brand"
                    >Pihu Jewel &middot; Jewellery</span
                  >
                  <h4 class="ticket-title">Wear the<br />moment.</h4>
                  <a
                    href="category-listing.html"
                    class="btn btn-white ticket-cta"
                  >
                    Shop Jewellery Offers
                    <svg
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M4 12h16M14 6l6 6-6 6" />
                    </svg>
                  </a>
                </div>
                <div class="ticket-save">
                  <small>Save up to</small>
                  <strong>25<sup>%</sup></strong>
                </div>
              </article>

              <div class="coupon_box">
                <span class="coupon-icon"
                  ><i class="fa-solid fa-gift"></i
                ></span>
                <div class="coupon-text">
                  <strong>PIHUSPECIAL</strong>
                  <p>Special savings on selected jewellery styles.</p>
                </div>
                <button type="button" class="code-copy" data-code="PIHUSPECIAL">
                  Copy Code
                </button>
              </div>
            </div>
          </div>

          <p class="ticket-note">
            *Terms &amp; conditions apply. Offers valid on selected products.
          </p>
        </div>
      </section>

      <section class="home-secH">
        <div class="container">
          <div class="heading">
            <span>Beautiful Finds, Lovely Prices</span>
            <h3>Find Your Favourite <span>at Every Price</span></h3>
            <p>
              Explore thoughtful picks and beautiful details that fit your
              budget.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="2"
              data-sm="3"
              data-lg="4"
              data-xl="5"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/cat2.png"
                        alt="Gifts under 299"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹299</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Tiny Delights</h4>
                        <p>Small gifts and everyday charms</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/pro4.png"
                        alt="Earrings under 499"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹499</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Little Treasures</h4>
                        <p>Earrings, diyas and accessories</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/cat3.png"
                        alt="Decor under 799"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹799</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Everyday Finds</h4>
                        <p>Home decor and festive accents</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/cat4.png"
                        alt="Necklaces under 999"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹999</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Beautiful Finds</h4>
                        <p>Necklaces, bangles and more</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/pro1.png"
                        alt="Bedding under 1499"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹1,499</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Thoughtful Picks</h4>
                        <p>Cotton bedding and cushion sets</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/cat5.png"
                        alt="Gifts under 1999"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹1,999</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Gifting Favourites</h4>
                        <p>Hampers and handcrafted sets</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="all-product-listing.html" class="price_coin">
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/cat1.png"
                        alt="Premium picks under 2999"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Under</small><strong>₹2,999</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>Premium Picks</h4>
                        <p>Quilts, chokers and statement sets</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a
                    href="all-product-listing.html"
                    class="price_coin is-premium"
                  >
                    <figure class="pc-img">
                      <img
                        src="assets/images/home/pro2.png"
                        alt="Premium collection"
                        loading="lazy"
                      />
                      <span class="pc-chip"
                        ><small>Explore</small><strong>Premium</strong></span
                      >
                    </figure>
                    <div class="pc-info">
                      <div class="pc-txt">
                        <h4>The Finest Selection</h4>
                        <p>Our most loved luxury pieces</p>
                      </div>
                      <span class="pc-arrow"
                        ><i class="fa-solid fa-arrow-right"></i
                      ></span>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-group">
              <button
                type="button"
                class="TestimonialSlider-prev btn-prev"
                aria-label="Previous"
              >
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <button
                type="button"
                class="TestimonialSlider-next btn-next"
                aria-label="Next"
              >
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secG">
        <div class="container">
          <div class="occ-wrap">
            <div class="occ-media">
              <img
                src="assets/images/home/moments.jpg"
                alt="Celebrate every moment beautifully"
                loading="lazy"
              />
              <span class="occ-caption"
                >Festive &middot; Wedding &middot; Gifting &middot;
                Everyday</span
              >
            </div>

            <div class="occ-right">
              <div class="heading">
                <span>Made for every moment</span>
                <h3>Celebrate Every <br /><span>Moment Beautifully</span></h3>
                <p>
                  From festive home accents to jewellery for special occasions,
                  find thoughtful pieces for life's most beautiful moments.
                </p>
              </div>

              <div class="swiper-wrap">
                <div
                  class="swiper fourSlider"
                  data-mob="2"
                  data-sm="2"
                  data-lg="3"
                  data-xl="3"
                >
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <a href="category-listing.html" class="occ_tile">
                        <figure>
                          <img
                            src="assets/images/home/cat5.png"
                            alt="Festive Celebrations"
                            loading="lazy"
                          />
                        </figure>
                        <div class="info">
                          <h4>Festive Celebrations</h4>
                          <span class="cta"
                            >Explore Festive Picks
                            <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="occ_tile">
                        <figure>
                          <img
                            src="assets/images/home/pro2.png"
                            alt="Wedding and Celebrations"
                            loading="lazy"
                          />
                        </figure>
                        <div class="info">
                          <h4>Wedding &amp; Celebrations</h4>
                          <span class="cta"
                            >Explore Collection
                            <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="occ_tile">
                        <figure>
                          <img
                            src="assets/images/home/pro3.png"
                            alt="Gifts and Hampers"
                            loading="lazy"
                          />
                        </figure>
                        <div class="info">
                          <h4>Gifts &amp; Hampers</h4>
                          <span class="cta"
                            >Find a Special Gift
                            <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>

                    <div class="swiper-slide">
                      <a href="category-listing.html" class="occ_tile">
                        <figure>
                          <img
                            src="assets/images/home/pro1.png"
                            alt="Everyday Living"
                            loading="lazy"
                          />
                        </figure>
                        <div class="info">
                          <h4>Everyday Living</h4>
                          <span class="cta"
                            >Explore Home Essentials
                            <i class="fa-solid fa-arrow-right"></i
                          ></span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="swiper-group">
                  <button
                    type="button"
                    class="TestimonialSlider-prev btn-prev"
                    aria-label="Previous"
                  >
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <button
                    type="button"
                    class="TestimonialSlider-next btn-next"
                    aria-label="Next"
                  >
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secI">
        <div class="container">
          <div class="heading">
            <span>Recently Viewed</span>
            <h3>A Second Look at <span>Your Favourites.</span></h3>
            <p>
              Take another look at the styles you loved and find the perfect
              addition to your collection.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="2"
              data-sm="3"
              data-lg="4"
              data-xl="4"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro1.png"
                          alt="Handloom Cotton Bedsheet Set"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-G1"
                          data-name="Handloom Cotton Bedsheet Set"
                          data-toast-title="Added to Cart"
                          data-toast-text="Handloom Cotton Bedsheet Set has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Grih Shree</span>
                        <span class="prod-rate"><i>★</i> 4.8</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html"
                          >Handloom Cotton Bedsheet Set</a
                        >
                      </h5>
                      <p class="prod-sub">
                        Pure cotton, double bed with 2 pillow covers
                      </p>
                      <div class="prod-price">
                        <span class="price-now">₹2,499</span>
                        <span class="price-old">₹3,299</span>
                        <span class="prod-save">Save 24%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro2.png"
                          alt="Kundan Choker Necklace"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-P1"
                          data-name="Kundan Choker Necklace"
                          data-toast-title="Added to Cart"
                          data-toast-text="Kundan Choker Necklace has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Pihu Jewel</span>
                        <span class="prod-rate"><i>★</i> 4.9</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html">Kundan Choker Necklace</a>
                      </h5>
                      <p class="prod-sub">
                        Handcrafted kundan with pearl drops
                      </p>
                      <div class="prod-price">
                        <span class="price-now">₹1,899</span>
                        <span class="price-old">₹2,599</span>
                        <span class="prod-save">Save 27%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro3.png"
                          alt="Brass Diya Gift Set"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-G2"
                          data-name="Brass Diya Gift Set"
                          data-toast-title="Added to Cart"
                          data-toast-text="Brass Diya Gift Set has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Grih Shree</span>
                        <span class="prod-rate"><i>★</i> 4.7</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html">Brass Diya Gift Set</a>
                      </h5>
                      <p class="prod-sub">Set of 4 hand-finished brass diyas</p>
                      <div class="prod-price">
                        <span class="price-now">₹899</span>
                        <span class="price-old">₹1,199</span>
                        <span class="prod-save">Save 25%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro4.png"
                          alt="Pearl Drop Earrings"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-P2"
                          data-name="Pearl Drop Earrings"
                          data-toast-title="Added to Cart"
                          data-toast-text="Pearl Drop Earrings has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Pihu Jewel</span>
                        <span class="prod-rate"><i>★</i> 4.8</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html">Pearl Drop Earrings</a>
                      </h5>
                      <p class="prod-sub">
                        Lightweight, for daily and festive wear
                      </p>
                      <div class="prod-price">
                        <span class="price-now">₹749</span>
                        <span class="price-old">₹999</span>
                        <span class="prod-save">Save 25%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro1.png"
                          alt="Jaipuri Cotton Quilt"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-G3"
                          data-name="Jaipuri Cotton Quilt"
                          data-toast-title="Added to Cart"
                          data-toast-text="Jaipuri Cotton Quilt has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Grih Shree</span>
                        <span class="prod-rate"><i>★</i> 4.9</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html">Jaipuri Cotton Quilt</a>
                      </h5>
                      <p class="prod-sub">Soft Jaipuri print, light and warm</p>
                      <div class="prod-price">
                        <span class="price-now">₹3,199</span>
                        <span class="price-old">₹3,999</span>
                        <span class="prod-save">Save 20%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="prod_cart">
                    <div class="prod-img">
                      <a href="product-detail.html" class="prod-link">
                        <img
                          src="assets/images/home/pro4.png"
                          alt="Meenakari Bangle Set"
                          loading="lazy"
                        />
                      </a>
                      <div class="prod-actions">
                        <button
                          type="button"
                          class="act-btn wish-btn"
                          aria-label="Wishlist"
                        >
                          <i class="fa-regular fa-heart"></i>
                        </button>
                        <button
                          type="button"
                          class="act-btn quick-btn"
                          aria-label="Quick view"
                          data-model=".product-view-pop"
                        >
                          <i class="fa-regular fa-eye"></i>
                        </button>
                      </div>
                      <div class="prod-btns">
                        <button
                          type="button"
                          data-id="SKU-P3"
                          data-name="Meenakari Bangle Set"
                          data-toast-title="Added to Cart"
                          data-toast-text="Meenakari Bangle Set has been added to your cart."
                          data-toast-type="success"
                          class="btn btn-outline-black prod-cta"
                        >
                          Add to Cart
                        </button>
                        <a
                          href="product-detail.html"
                          class="btn btn-primary prod-cta"
                          >Buy Now</a
                        >
                      </div>
                    </div>
                    <div class="prod-info">
                      <div class="prod-meta">
                        <span class="prod-brand">Pihu Jewel</span>
                        <span class="prod-rate"><i>★</i> 4.8</span>
                      </div>
                      <h5 class="prod-name">
                        <a href="product-detail.html">Meenakari Bangle Set</a>
                      </h5>
                      <p class="prod-sub">
                        Set of 6 with colourful meenakari work
                      </p>
                      <div class="prod-price">
                        <span class="price-now">₹1,299</span>
                        <span class="price-old">₹1,799</span>
                        <span class="prod-save">Save 28%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-group">
              <button
                type="button"
                class="TestimonialSlider-prev btn-prev"
                aria-label="Previous"
              >
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <button
                type="button"
                class="TestimonialSlider-next btn-next"
                aria-label="Next"
              >
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secJ">
        <div class="vid-bg">
          <video
            src="assets/video/video.mp4"
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
          ></video>
        </div>

        <div class="container">
          <div class="vid-content">
            <span class="vid-eyebrow">Crafted for Beautiful Moments</span>
            <h2 class="vid-title">Beautifully Made,<br />Beautifully Worn</h2>
            <p class="vid-desc">
              From thoughtful details that make a house feel like home to
              jewellery that completes a special moment, discover pieces chosen
              to be part of your everyday and your celebrations.
            </p>
            <div class="vid-btns">
              <a href="category-listing.html" class="btn btn-white"
                >Shop Home &amp; Living</a
              >
              <a href="category-listing.html" class="btn btn-outline-white"
                >Explore Jewellery</a
              >
            </div>
          </div>
        </div>
      </section>

      <section class="home-secK">
        <div class="container">
          <div class="craft-wrap">
            <!-- LEFT: image composition -->
            <div class="craft-media">
              <figure class="craft-main">
                <img
                  src="assets/images/home/banner2.jpg"
                  alt="Handcrafted crochet and handmade décor by Grih Shree"
                  loading="lazy"
                />
              </figure>

              <figure class="craft-sub">
                <img
                  src="assets/images/home/cat5.png"
                  alt="Handcrafted collection detail"
                  loading="lazy"
                />
              </figure>

              <span class="craft-tag">Grih Shree &middot; Handcrafted</span>
            </div>

            <!-- RIGHT: content -->
            <div class="craft-right">
              <div class="heading">
                <span>A Touch of Artistry</span>
                <h3>Beautifully Made, <span>Thoughtfully Chosen</span></h3>
                <p>
                  Discover the charm of handcrafted details, from crochet
                  creations and handmade décor to unique accessories that add
                  character to your everyday spaces.
                </p>
              </div>

              <ul class="craft-grid">
                <li class="craft_item">
                  <span class="item-icon"
                    ><i class="fa-solid fa-hand-holding-heart"></i
                  ></span>
                  <div class="item-txt">
                    <h4>Crochet Creations</h4>
                    <p>Hand-worked, stitch by stitch.</p>
                  </div>
                </li>

                <li class="craft_item">
                  <span class="item-icon"
                    ><i class="fa-solid fa-house"></i
                  ></span>
                  <div class="item-txt">
                    <h4>Handmade Décor</h4>
                    <p>Details with real character.</p>
                  </div>
                </li>

                <li class="craft_item">
                  <span class="item-icon"
                    ><i class="fa-solid fa-palette"></i
                  ></span>
                  <div class="item-txt">
                    <h4>Resin Art</h4>
                    <p>One-of-a-kind patterns.</p>
                  </div>
                </li>

                <li class="craft_item">
                  <span class="item-icon"><i class="fa-solid fa-gem"></i></span>
                  <div class="item-txt">
                    <h4>Handcrafted Accessories</h4>
                    <p>Unique touches for gifting.</p>
                  </div>
                </li>
              </ul>

              <div class="craft-btn">
                <a href="category-listing.html" class="btn btn-primary"
                  >Explore Handcrafted Collection</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secL">
        <div class="container">
          <div class="heading">
            <span>The Difference Is in the Details</span>
            <h3>A Shopping Experience <span>Made with Care</span></h3>
            <p>
              Thoughtful collections, easy discovery and dedicated support come
              together to make every shopping experience feel special.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="1.2"
              data-sm="2"
              data-lg="4"
              data-xl="4"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="why_card">
                    <span class="why-icon"
                      ><i class="fa-solid fa-wand-magic-sparkles"></i
                    ></span>
                    <h4>Thoughtfully Curated</h4>
                    <p>
                      Collections selected with care for your home and personal
                      style.
                    </p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="why_card">
                    <span class="why-icon"
                      ><i class="fa-solid fa-shield-halved"></i
                    ></span>
                    <h4>Secure Shopping</h4>
                    <p>A secure checkout experience for added peace of mind.</p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="why_card">
                    <span class="why-icon"
                      ><i class="fa-solid fa-truck-fast"></i
                    ></span>
                    <h4>Convenient Delivery</h4>
                    <p>
                      Order delivery with clear shipping information and
                      tracking.
                    </p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="why_card">
                    <span class="why-icon"
                      ><i class="fa-solid fa-headset"></i
                    ></span>
                    <h4>Dedicated Support</h4>
                    <p>
                      We're here to help with your shopping queries and orders.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-group">
              <button
                type="button"
                class="TestimonialSlider-prev btn-prev"
                aria-label="Previous"
              >
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <button
                type="button"
                class="TestimonialSlider-next btn-next"
                aria-label="Next"
              >
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secM">
        <div class="container">
          <div class="heading">
            <span>Kind Words, Happy Customers</span>
            <h3>Your Love <span>Makes It Special</span></h3>
            <p>
              Every purchase tells a story. We're grateful to be part of your
              beautiful moments.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="1.2"
              data-sm="2"
              data-lg="3"
              data-xl="3"
            >
              <div class="swiper-wrapper">
                <!-- REVIEW 1 -->
                <div class="swiper-slide">
                  <article class="review_card">
                    <div class="rev-stars" aria-label="Rated 5 out of 5">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="rev-title">Soft from the very first wash</h4>
                    <p class="rev-text">
                      The cotton feels lovely and the print looks even better in
                      person than in the photos. We've washed it a few times now
                      and the colours are still fresh. It has made our bedroom
                      feel so much warmer.
                    </p>
                    <div class="rev-user">
                      <span class="rev-avatar">S</span>
                      <div class="rev-meta">
                        <h5>
                          Sneha Verma
                          <i
                            class="fa-solid fa-circle-check"
                            title="Verified purchase"
                          ></i>
                        </h5>
                        <small>Handloom Cotton Bedsheet Set</small>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- REVIEW 2 -->
                <div class="swiper-slide">
                  <article class="review_card">
                    <div class="rev-stars" aria-label="Rated 5 out of 5">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="rev-title">Perfect for my sister's wedding</h4>
                    <p class="rev-text">
                      I wore the kundan choker with a simple silk saree and got
                      so many compliments. The pearl drops sit beautifully and
                      it is lighter than I expected, so I was comfortable all
                      evening.
                    </p>
                    <div class="rev-user">
                      <span class="rev-avatar">A</span>
                      <div class="rev-meta">
                        <h5>
                          Ananya Singh
                          <i
                            class="fa-solid fa-circle-check"
                            title="Verified purchase"
                          ></i>
                        </h5>
                        <small>Kundan Choker Necklace</small>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- REVIEW 3 -->
                <div class="swiper-slide">
                  <article class="review_card">
                    <div class="rev-stars" aria-label="Rated 4 out of 5">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                    </div>
                    <h4 class="rev-title">A lovely gift for Diwali</h4>
                    <p class="rev-text">
                      Ordered the brass diya set for my parents and they loved
                      the finish. The packaging was neat and it looked great on
                      the puja shelf. Would have liked one more diya in the set,
                      but the quality is really good.
                    </p>
                    <div class="rev-user">
                      <span class="rev-avatar">R</span>
                      <div class="rev-meta">
                        <h5>
                          Rohit Mishra
                          <i
                            class="fa-solid fa-circle-check"
                            title="Verified purchase"
                          ></i>
                        </h5>
                        <small>Brass Diya Gift Set</small>
                      </div>
                    </div>
                  </article>
                </div>

                <!-- REVIEW 4 -->
                <div class="swiper-slide">
                  <article class="review_card">
                    <div class="rev-stars" aria-label="Rated 5 out of 5">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                    </div>
                    <h4 class="rev-title">My everyday favourite earrings</h4>
                    <p class="rev-text">
                      Very light and easy to wear all day, even with office
                      outfits. The pearl finish looks elegant without being too
                      heavy. I've already ordered a second pair for my mother.
                    </p>
                    <div class="rev-user">
                      <span class="rev-avatar">P</span>
                      <div class="rev-meta">
                        <h5>
                          Priya Gupta
                          <i
                            class="fa-solid fa-circle-check"
                            title="Verified purchase"
                          ></i>
                        </h5>
                        <small>Pearl Drop Earrings</small>
                      </div>
                    </div>
                  </article>
                </div>
              </div>
            </div>

            <div class="swiper-group">
              <button
                type="button"
                class="TestimonialSlider-prev btn-prev"
                aria-label="Previous"
              >
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <button
                type="button"
                class="TestimonialSlider-next btn-next"
                aria-label="Next"
              >
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secN">
        <div class="container">
          <div class="heading">
            <span>Follow Our Journey</span>
            <h3>A Little Inspiration <span>from Our World</span></h3>
            <p>
              Explore our latest collections, styling ideas and beautiful
              moments from both our creative worlds.
            </p>
          </div>

          <div class="insta-grid">
            <!-- ================= GRIH SHREE STUDIO ================= -->
            <div class="insta_block">
              <div class="insta-album">
                <a
                  href="https://www.instagram.com/grihshreestudio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Grih Shree Studio on Instagram"
                >
                  <img
                    src="assets/images/home/cat1.png"
                    alt="Grih Shree Studio handloom and bedding"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/grihshreestudio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Grih Shree Studio on Instagram"
                >
                  <img
                    src="assets/images/home/cat3.png"
                    alt="Grih Shree Studio home decor"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/grihshreestudio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Grih Shree Studio on Instagram"
                >
                  <img
                    src="assets/images/home/cat5.png"
                    alt="Grih Shree Studio handcrafted collection"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/grihshreestudio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Grih Shree Studio on Instagram"
                >
                  <img
                    src="assets/images/home/banner2.jpg"
                    alt="Grih Shree Studio styling ideas"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
              </div>

              <div class="insta-foot">
                <div class="insta-who">
                  <span class="insta-icon"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                  <div class="insta-name">
                    <h4>Grih Shree Studio</h4>
                    <span>@grihshreestudio</span>
                  </div>
                </div>
                <a
                  href="https://www.instagram.com/grihshreestudio/"
                  target="_blank"
                  rel="noopener"
                  class="btn btn-outline-primary insta-btn"
                  >Follow on Instagram</a
                >
              </div>
            </div>

            <!-- ================= PIHU JEWELLERY STUDIO ================= -->
            <div class="insta_block">
              <div class="insta-album">
                <a
                  href="https://www.instagram.com/pihu_jewellery_studio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Pihu Jewellery Studio on Instagram"
                >
                  <img
                    src="assets/images/home/cat4.png"
                    alt="Pihu Jewellery Studio necklaces"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/pihu_jewellery_studio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Pihu Jewellery Studio on Instagram"
                >
                  <img
                    src="assets/images/home/cat2.png"
                    alt="Pihu Jewellery Studio earrings"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/pihu_jewellery_studio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Pihu Jewellery Studio on Instagram"
                >
                  <img
                    src="assets/images/home/pro2.png"
                    alt="Pihu Jewellery Studio kundan jewellery"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
                <a
                  href="https://www.instagram.com/pihu_jewellery_studio/"
                  target="_blank"
                  rel="noopener"
                  class="insta-tile"
                  aria-label="Pihu Jewellery Studio on Instagram"
                >
                  <img
                    src="assets/images/home/jewellery.jpg"
                    alt="Pihu Jewellery Studio styling ideas"
                    loading="lazy"
                  />
                  <span class="tile-over"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                </a>
              </div>

              <div class="insta-foot">
                <div class="insta-who">
                  <span class="insta-icon"
                    ><i class="fa-brands fa-instagram"></i
                  ></span>
                  <div class="insta-name">
                    <h4>Pihu Jewellery Studio</h4>
                    <span>@pihu_jewellery_studio</span>
                  </div>
                </div>
                <a
                  href="https://www.instagram.com/pihu_jewellery_studio/"
                  target="_blank"
                  rel="noopener"
                  class="btn btn-outline-primary insta-btn"
                  >Follow on Instagram</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="home-secO">
        <div class="container">
          <div class="news-card">
            <div class="news-content">
              <div class="heading">
                <span>A Note from Our World</span>
                <h3>Beautiful Things Are Worth Sharing</h3>
                <p>
                  Sign up to discover new arrivals, special collections, festive
                  inspiration and exclusive updates from Grih Shree &amp; Pihu
                  Jewel.
                </p>
              </div>

              <form class="form news-form" action="#" method="post" novalidate>
                <div class="news-row">
                  <div class="form-group news-field">
                    <input
                      type="email"
                      id="newsEmail"
                      name="email"
                      placeholder=" "
                      autocomplete="email"
                      required
                    />
                    <label for="newsEmail">Enter your email address</label>
                  </div>
                  <button type="submit" class="btn btn-white news-btn">
                    Subscribe <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </form>
            </div>

            <div class="news-img">
              <img
                src="assets/images/home/jewellery.jpg"
                alt="Grih Shree and Pihu Jewel"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="footer-wrapper">
        <ul class="footer-top">
          <li>
            <span class="ft-icon"><i class="fa-regular fa-gem"></i></span>
            <div class="content">
              <p>Thoughtfully Curated</p>
              <span>Home &amp; jewellery, chosen with care</span>
            </div>
          </li>
          <li>
            <span class="ft-icon"
              ><i class="fa-solid fa-hand-holding-heart"></i
            ></span>
            <div class="content">
              <p>Handcrafted Details</p>
              <span>Treasures with real character</span>
            </div>
          </li>
          <li>
            <span class="ft-icon"><i class="fa-solid fa-truck-fast"></i></span>
            <div class="content">
              <p>Convenient Delivery</p>
              <span>Clear shipping information</span>
            </div>
          </li>
          <li>
            <span class="ft-icon"
              ><i class="fa-solid fa-shield-halved"></i
            ></span>
            <div class="content">
              <p>Secure Payments</p>
              <span>Safe and trusted checkout</span>
            </div>
          </li>
        </ul>
      </div>

      <div class="footer-wrapper-bottom">
        <div class="footer-middle">
          <div class="container">
            <div class="foot-cols">
              <div class="colA">
                <a href="index.html" class="logo"
                  ><img
                    src="assets/images/logo.jpeg"
                    alt="Grih Shree &amp; Pihu Jewel"
                /></a>
                <p class="brand-desc">
                  Grih Shree &amp; Pihu Jewel brings together thoughtfully
                  curated home essentials, handcrafted treasures and beautiful
                  jewellery. Discover two distinctive collections, all in one
                  place.
                </p>
                <ul class="social">
                  <li>
                    <a
                      href="javascript:void(0)"
                      aria-label="Grih Shree Studio on Instagram"
                      title="Grih Shree Studio"
                      ><i class="fa-brands fa-instagram"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" aria-label="Facebook"
                      ><i class="fa-brands fa-facebook-f"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" aria-label="X (Twitter)"
                      ><i class="fa-brands fa-x-twitter"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" aria-label="WhatsApp"
                      ><i class="fa-brands fa-whatsapp"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" aria-label="YouTube"
                      ><i class="fa-brands fa-youtube"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" aria-label="Pinterest"
                      ><i class="fa-brands fa-pinterest-p"></i
                    ></a>
                  </li>
                </ul>
              </div>

              <div class="colB">
                <h5>Shop Grih Shree</h5>
                <ul>
                  <li>
                    <a href="category-listing.html">Handloom &amp; Bedding</a>
                  </li>
                  <li><a href="category-listing.html">Home Decor</a></li>
                  <li>
                    <a href="category-listing.html">Festive Collection</a>
                  </li>
                  <li>
                    <a href="category-listing.html">Gifts &amp; Hampers</a>
                  </li>
                  <li><a href="category-listing.html">Home Essentials</a></li>
                  <li>
                    <a href="category-listing.html">Handcrafted Collection</a>
                  </li>
                </ul>
              </div>

              <div class="colC">
                <h5>Shop Pihu Jewel</h5>
                <ul>
                  <li><a href="category-listing.html">Earrings</a></li>
                  <li><a href="category-listing.html">Necklaces</a></li>
                  <li>
                    <a href="category-listing.html">Bangles &amp; Bracelets</a>
                  </li>
                  <li><a href="category-listing.html">Rings</a></li>
                  <li>
                    <a href="category-listing.html">Traditional Accessories</a>
                  </li>
                  <li><a href="category-listing.html">Jewellery Sets</a></li>
                </ul>
              </div>

              <div class="colD">
                <h5>Customer Care</h5>
                <ul>
                  <li><a href="contact.html">Contact Us</a></li>
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li><a href="faqs.html">FAQs</a></li>
                  <li>
                    <a href="shipping-policy.html">Shipping Information</a>
                  </li>
                  <li>
                    <a href="returns-exchange.html">Returns &amp; Refunds</a>
                  </li>
                  <li>
                    <a href="refund-cancellation-policy.html"
                      >Refund &amp; Cancellation</a
                    >
                  </li>
                  <li><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li>
                    <a href="terms-conditions.html">Terms &amp; Conditions</a>
                  </li>
                </ul>
              </div>

              <div class="colE">
                <h5>My Account</h5>
                <ul>
                  <li><a href="dashboard.html#tab-1">My Account</a></li>
                  <li><a href="dashboard.html#tab-2">Track Order</a></li>
                  <li><a href="dashboard.html#tab-3">My Orders</a></li>
                  <li><a href="dashboard.html#tab-4">My Wishlist</a></li>
                  <li><a href="dashboard.html#tab-5">My Profile</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          <div class="container">
            <p class="copyright">
              Copyright &copy; 2026 Grih Shree &amp; Pihu Jewel. All Rights
              Reserved.
            </p>
            <p class="credit">
              Design &amp; Developed by
              <a href="javascript:void(0)" target="_blank" rel="noopener"
                >Web Mingo</a
              >.
            </p>
            <ul class="payment">
              <li><i class="fa-brands fa-cc-visa" aria-label="Visa"></i></li>
              <li>
                <i
                  class="fa-brands fa-cc-mastercard"
                  aria-label="Mastercard"
                ></i>
              </li>
              <li>
                <i
                  class="fa-brands fa-cc-amex"
                  aria-label="American Express"
                ></i>
              </li>
              <li>
                <i class="fa-brands fa-google-pay" aria-label="Google Pay"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <nav class="float-menu" aria-label="Quick navigation">
        <a href="index.html" class="float-link active"
          ><i class="fa-solid fa-house"></i><span>Home</span></a
        >
        <button
          type="button"
          class="float-link"
          data-model=".ham-pop"
          aria-label="Menu"
        >
          <i class="fa-solid fa-bars"></i><span>Menu</span>
        </button>
        <a href="dashboard.html#tab-4" class="float-link"
          ><i class="fa-regular fa-heart"></i><span>Wishlist</span
          ><b class="f-count">0</b></a
        >
        <a href="cart.html" class="float-link"
          ><i class="fa-solid fa-bag-shopping"></i><span>Bag</span
          ><b class="f-count">0</b></a
        >
        <a href="dashboard.html#tab-1" class="float-link"
          ><i class="fa-regular fa-user"></i><span>Account</span></a
        >
      </nav>
    </footer>

    <!-- ================= Models ================= -->

    <div class="model cart-pop">
      <button class="close" type="button">
        <p>Close</p>
        <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
          <path
            d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5"
            stroke="black"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
      <div class="model-body">
        <div class="cp-head">
          <h3>My Bag <span>3 items</span></h3>
          <div class="cp-ship">
            <p>
              <i class="fa-solid fa-truck-fast" aria-hidden="true"></i> You have
              unlocked <strong>FREE shipping</strong> on this order.
            </p>
            <span class="cp-bar"><i style="width: 100%"></i></span>
          </div>
        </div>
        <ul class="cp-list">
          <li class="cp-item">
            <a class="cp-img" href="product-detail.html">
              <img
                src="assets/images/home/pro1.png"
                alt="Handloom Cotton Bedsheet Set"
                width="88"
                height="88"
                loading="lazy"
              />
            </a>
            <div class="cp-info">
              <span class="cp-cat">Grih Shree</span>
              <h4 class="cp-name">
                <a href="product-detail.html">Handloom Cotton Bedsheet Set</a>
              </h4>
              <span class="cp-variant"
                >Pure cotton · Double bed · 2 pillow covers</span
              >
              <div class="cp-price">
                <strong>₹2,499</strong><del>₹3,299</del
                ><span class="cp-off">24% off</span>
              </div>
              <div class="cp-actions">
                <div
                  class="qty"
                  role="group"
                  aria-label="Quantity for Handloom Cotton Bedsheet Set"
                >
                  <button
                    type="button"
                    class="qty-minus"
                    aria-label="Decrease quantity"
                  >
                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                  </button>
                  <input
                    type="text"
                    inputmode="numeric"
                    value="1"
                    aria-label="Quantity"
                  />
                  <button
                    type="button"
                    class="qty-plus"
                    aria-label="Increase quantity"
                  >
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <button type="button" class="cp-remove">
                  <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                  Remove
                </button>
              </div>
            </div>
          </li>
          <li class="cp-item">
            <a class="cp-img" href="product-detail.html">
              <img
                src="assets/images/home/pro2.png"
                alt="Kundan Choker Necklace"
                width="88"
                height="88"
                loading="lazy"
              />
            </a>
            <div class="cp-info">
              <span class="cp-cat">Pihu Jewel</span>
              <h4 class="cp-name">
                <a href="product-detail.html">Kundan Choker Necklace</a>
              </h4>
              <span class="cp-variant">Handcrafted kundan · Pearl drops</span>
              <div class="cp-price">
                <strong>₹1,899</strong><del>₹2,599</del
                ><span class="cp-off">27% off</span>
              </div>
              <div class="cp-actions">
                <div
                  class="qty"
                  role="group"
                  aria-label="Quantity for Kundan Choker Necklace"
                >
                  <button
                    type="button"
                    class="qty-minus"
                    aria-label="Decrease quantity"
                  >
                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                  </button>
                  <input
                    type="text"
                    inputmode="numeric"
                    value="1"
                    aria-label="Quantity"
                  />
                  <button
                    type="button"
                    class="qty-plus"
                    aria-label="Increase quantity"
                  >
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <button type="button" class="cp-remove">
                  <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                  Remove
                </button>
              </div>
            </div>
          </li>
          <li class="cp-item">
            <a class="cp-img" href="product-detail.html">
              <img
                src="assets/images/home/pro3.png"
                alt="Brass Diya Gift Set"
                width="88"
                height="88"
                loading="lazy"
              />
            </a>
            <div class="cp-info">
              <span class="cp-cat">Grih Shree</span>
              <h4 class="cp-name">
                <a href="product-detail.html">Brass Diya Gift Set</a>
              </h4>
              <span class="cp-variant"
                >Set of 4 · Hand-finished · Gift ready</span
              >
              <div class="cp-price">
                <strong>₹899</strong><del>₹1,199</del
                ><span class="cp-off">25% off</span>
              </div>
              <div class="cp-actions">
                <div
                  class="qty"
                  role="group"
                  aria-label="Quantity for Brass Diya Gift Set"
                >
                  <button
                    type="button"
                    class="qty-minus"
                    aria-label="Decrease quantity"
                  >
                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                  </button>
                  <input
                    type="text"
                    inputmode="numeric"
                    value="1"
                    aria-label="Quantity"
                  />
                  <button
                    type="button"
                    class="qty-plus"
                    aria-label="Increase quantity"
                  >
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
                <button type="button" class="cp-remove">
                  <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                  Remove
                </button>
              </div>
            </div>
          </li>
        </ul>
        <div class="cp-empty" hidden>
          <span class="cp-empty-icon"
            ><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i
          ></span>
          <h4>Your bag is empty</h4>
          <p>Explore handloom bedding, home decor and beautiful jewellery.</p>
          <a href="all-product-listing.html" class="btn btn-primary"
            >Start Shopping</a
          >
        </div>
        <div class="cp-foot">
          <div class="cp-total">
            <span>Subtotal</span>
            <strong>₹5,297</strong>
          </div>
          <p class="cp-note">
            <i class="fa-solid fa-ticket" aria-hidden="true"></i>
            Apply GRIHHOME or PIHUSPECIAL at checkout for extra savings.
          </p>
          <div class="cp-btns">
            <a href="cart.html" class="btn btn-outline-primary">View Bag</a>
            <a href="checkout.html" class="btn btn-primary">Checkout</a>
          </div>
        </div>
      </div>
    </div>

    <div class="ham-pop">
      <div class="ham-body">
        <div class="ham-top">
          <button type="button" class="ham-back" data-ham-back>
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            <span>Back</span>
          </button>
          <a href="index.html" class="ham-logo">
            <img
              src="assets/images/logo.png"
              alt="Grih Shree + Pihu Jewel"
              title="Grih Shree + Pihu Jewel"
            />
          </a>
          <button class="close close-btn" type="button" aria-label="Close menu">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
          </button>
        </div>

        <div class="ham-views">
          <!-- ================= MAIN ================= -->
          <div
            class="ham-view is-active"
            data-ham-view="main"
            data-ham-title="Menu"
          >
            <ul class="ham-list">
              <li class="active"><a href="index.html">Home</a></li>
              <li><a href="all-product-listing.html">Shop All</a></li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="home-living"
                >
                  <span class="ham-link-text">Home &amp; Living</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="jewellery"
                >
                  <span class="ham-link-text">Jewellery</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="collection"
                >
                  <span class="ham-link-text">Shop by Collections</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button type="button" class="ham-link" data-ham-open="gifts">
                  <span class="ham-link-text">Gifts</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
            </ul>

            <ul class="ham-list ham-list--minor">
              <li><a href="about.html">About Us</a></li>
              <li><a href="dashboard.html#tab-2">Track Order</a></li>
              <li><a href="contact.html">Contact Us</a></li>
            </ul>
          </div>

          <!-- ================= HOME & LIVING ================= -->
          <div
            class="ham-view"
            data-ham-view="home-living"
            data-ham-title="Home &amp; Living"
            aria-hidden="true"
          >
            <div class="ham-head">
              <h3 class="ham-title">Home &amp; Living</h3>
              <p class="ham-sub">
                Grih Shree, thoughtful pieces for beautiful spaces.
              </p>
            </div>
            <ul class="ham-list ham-list--sub">
              <li>
                <a href="category-listing.html">Handloom &amp; Bedding</a>
              </li>
              <li><a href="category-listing.html">Home Decor</a></li>
              <li><a href="category-listing.html">Festive Collection</a></li>
              <li><a href="category-listing.html">Gifts &amp; Hampers</a></li>
              <li><a href="category-listing.html">Home Essentials</a></li>
              <li>
                <a href="category-listing.html">Handcrafted Collection</a>
              </li>
              <li class="ham-all">
                <a href="category-listing.html"
                  >Explore All Home &amp; Living
                  <i class="fa-solid fa-arrow-right" aria-hidden="true"></i
                ></a>
              </li>
            </ul>
          </div>

          <!-- ================= JEWELLERY ================= -->
          <div
            class="ham-view"
            data-ham-view="jewellery"
            data-ham-title="Jewellery"
            aria-hidden="true"
          >
            <div class="ham-head">
              <h3 class="ham-title">Jewellery</h3>
              <p class="ham-sub">
                Pihu Jewel, timeless adornment for every occasion.
              </p>
            </div>
            <ul class="ham-list ham-list--sub">
              <li><a href="category-listing.html">Earrings</a></li>
              <li><a href="category-listing.html">Necklaces</a></li>
              <li>
                <a href="category-listing.html">Bangles &amp; Bracelets</a>
              </li>
              <li><a href="category-listing.html">Rings</a></li>
              <li>
                <a href="category-listing.html">Traditional Accessories</a>
              </li>
              <li><a href="category-listing.html">Jewellery Sets</a></li>
              <li class="ham-all">
                <a href="category-listing.html"
                  >Explore All Jewellery
                  <i class="fa-solid fa-arrow-right" aria-hidden="true"></i
                ></a>
              </li>
            </ul>
          </div>

          <!-- ================= SHOP BY COLLECTIONS ================= -->
          <div
            class="ham-view"
            data-ham-view="collection"
            data-ham-title="Shop by Collections"
            aria-hidden="true"
          >
            <div class="ham-head">
              <h3 class="ham-title">Shop by Collections</h3>
            </div>
            <ul class="ham-list">
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="collection-featured"
                >
                  <span class="ham-link-text">Featured</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="collection-occasion"
                >
                  <span class="ham-link-text">Shop by Occasion</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="collection-gifts"
                >
                  <span class="ham-link-text">Gift Ideas</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
              <li>
                <button
                  type="button"
                  class="ham-link"
                  data-ham-open="collection-price"
                >
                  <span class="ham-link-text">Price Range</span>
                  <span class="ham-arrow"
                    ><i class="fa-solid fa-chevron-right" aria-hidden="true"></i
                  ></span>
                </button>
              </li>
            </ul>
          </div>

          <div
            class="ham-view"
            data-ham-view="collection-featured"
            data-ham-title="Shop by Collections"
            aria-hidden="true"
          >
            <div class="ham-head"><h3 class="ham-title">Featured</h3></div>
            <ul class="ham-list ham-list--sub">
              <li><a href="all-product-listing.html">New Arrivals</a></li>
              <li><a href="all-product-listing.html">Best Sellers</a></li>
              <li><a href="all-product-listing.html">Festive Specials</a></li>
              <li><a href="all-product-listing.html">Premium Collection</a></li>
              <li>
                <a href="all-product-listing.html">Handcrafted Collection</a>
              </li>
            </ul>
          </div>

          <div
            class="ham-view"
            data-ham-view="collection-occasion"
            data-ham-title="Shop by Collections"
            aria-hidden="true"
          >
            <div class="ham-head">
              <h3 class="ham-title">Shop by Occasion</h3>
            </div>
            <ul class="ham-list ham-list--sub">
              <li><a href="all-product-listing.html">Wedding</a></li>
              <li><a href="all-product-listing.html">Festive</a></li>
              <li><a href="all-product-listing.html">Party Wear</a></li>
              <li><a href="all-product-listing.html">Daily Wear</a></li>
              <li><a href="all-product-listing.html">Housewarming</a></li>
            </ul>
          </div>

          <div
            class="ham-view"
            data-ham-view="collection-gifts"
            data-ham-title="Shop by Collections"
            aria-hidden="true"
          >
            <div class="ham-head"><h3 class="ham-title">Gift Ideas</h3></div>
            <ul class="ham-list ham-list--sub">
              <li><a href="all-product-listing.html">Gifts for Her</a></li>
              <li><a href="all-product-listing.html">Gifts for Home</a></li>
              <li><a href="all-product-listing.html">Wedding Gifts</a></li>
              <li><a href="all-product-listing.html">Return Gifts</a></li>
              <li><a href="all-product-listing.html">Festive Hampers</a></li>
            </ul>
          </div>

          <div
            class="ham-view"
            data-ham-view="collection-price"
            data-ham-title="Shop by Collections"
            aria-hidden="true"
          >
            <div class="ham-head"><h3 class="ham-title">Price Range</h3></div>
            <ul class="ham-list ham-list--sub">
              <li><a href="all-product-listing.html">Under ₹499</a></li>
              <li><a href="all-product-listing.html">Under ₹999</a></li>
              <li><a href="all-product-listing.html">₹1,000 - ₹1,999</a></li>
              <li><a href="all-product-listing.html">₹2,000 - ₹4,999</a></li>
              <li><a href="all-product-listing.html">₹5,000 &amp; Above</a></li>
            </ul>
          </div>

          <!-- ================= GIFTS ================= -->
          <div
            class="ham-view"
            data-ham-view="gifts"
            data-ham-title="Gifts"
            aria-hidden="true"
          >
            <div class="ham-head">
              <h3 class="ham-title">Gifts</h3>
              <p class="ham-sub">Thoughtful gifts for meaningful moments.</p>
            </div>
            <ul class="ham-list ham-list--sub">
              <li><a href="category-listing.html">Wedding Gifts</a></li>
              <li><a href="category-listing.html">Festive Hampers</a></li>
              <li><a href="category-listing.html">Return Gifts</a></li>
              <li><a href="category-listing.html">Towel Hampers</a></li>
              <li>
                <a href="category-listing.html">Customised Gift Hampers</a>
              </li>
              <li class="ham-all">
                <a href="category-listing.html"
                  >Explore All Gifts
                  <i class="fa-solid fa-arrow-right" aria-hidden="true"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="ham-bottom">
          <div class="ham-social">
            <a
              href="javascript:void(0)"
              target="_blank"
              title="Facebook"
              aria-label="Facebook"
              ><i class="fa-brands fa-facebook-f"></i
            ></a>
            <a
              href="https://www.instagram.com/grihshreestudio/"
              target="_blank"
              rel="noopener"
              title="Instagram"
              aria-label="Instagram"
              ><i class="fa-brands fa-instagram"></i
            ></a>
            <a
              href="javascript:void(0)"
              target="_blank"
              title="Pinterest"
              aria-label="Pinterest"
              ><i class="fa-brands fa-pinterest-p"></i
            ></a>
            <a
              href="javascript:void(0)"
              target="_blank"
              title="YouTube"
              aria-label="YouTube"
              ><i class="fa-brands fa-youtube"></i
            ></a>
            <a
              href="https://wa.me/919876543210"
              target="_blank"
              rel="noopener"
              title="WhatsApp"
              aria-label="WhatsApp"
              ><i class="fa-brands fa-whatsapp"></i
            ></a>
          </div>
          <a href="all-product-listing.html" class="btn btn-primary header-cta">
            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
            Shop New Arrivals
          </a>
        </div>
      </div>
    </div>

    <div class="model login-pop">
      <button class="close" type="button">
        <p>Close</p>
        <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
          <path
            d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5"
            stroke="black"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </button>
      <div class="model-body">
        <a
          href="index.html"
          class="pop-logo"
          aria-label="Grih Shree + Pihu Jewel Home"
        >
          <img src="assets/images/logo.png" alt="Grih Shree + Pihu Jewel" />
        </a>
        <div class="pop-title">
          <h3>Welcome Back</h3>
          <p>
            Login or create an account to track your orders, save your wishlist
            and check out faster.
          </p>
        </div>
        <ul class="tab-nav">
          <li class="active" data-tab="pop-login">Login</li>
          <li data-tab="pop-register">Create Account</li>
        </ul>
        <div class="tab-nav-content">
          <div class="tabs active" data-tab="pop-login">
            <form class="form pop-form" novalidate>
              <div class="form-group">
                <input
                  type="text"
                  id="popLoginId"
                  name="login_id"
                  placeholder=" "
                  autocomplete="username"
                />
                <label for="popLoginId">Email or Mobile Number</label>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  id="popLoginPass"
                  name="password"
                  placeholder=" "
                  autocomplete="current-password"
                />
                <label for="popLoginPass">Password</label>
              </div>
              <div class="pop-meta">
                <a href="javascript:void(0);">Forgot password?</a>
              </div>
              <button type="submit" class="btn btn-primary pop-submit">
                Login
              </button>
            </form>
            <div class="pop-divider"><span>or</span></div>
            <button type="button" class="pop-google">
              <svg
                width="18"
                height="18"
                viewBox="0 0 48 48"
                aria-hidden="true"
              >
                <path
                  fill="#EA4335"
                  d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"
                />
                <path
                  fill="#4285F4"
                  d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"
                />
                <path
                  fill="#FBBC05"
                  d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"
                />
                <path
                  fill="#34A853"
                  d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"
                />
              </svg>
              Continue with Google
            </button>
          </div>
          <div class="tabs" data-tab="pop-register">
            <form class="form pop-form" novalidate>
              <div class="form-group">
                <input
                  type="text"
                  id="popRegName"
                  name="full_name"
                  placeholder=" "
                  autocomplete="name"
                />
                <label for="popRegName">Full Name</label>
              </div>
              <div class="form-group">
                <input
                  type="email"
                  id="popRegEmail"
                  name="email"
                  placeholder=" "
                  autocomplete="email"
                />
                <label for="popRegEmail">Email Address</label>
              </div>
              <div class="pop-row">
                <div class="form-group">
                  <input
                    type="tel"
                    id="popRegMobile"
                    name="mobile"
                    placeholder=" "
                    inputmode="numeric"
                    maxlength="10"
                    autocomplete="tel"
                  />
                  <label for="popRegMobile">Mobile Number</label>
                </div>
                <div class="form-group">
                  <input
                    type="tel"
                    id="popRegAlt"
                    name="alternate_mobile"
                    placeholder=" "
                    inputmode="numeric"
                    maxlength="10"
                    autocomplete="off"
                  />
                  <label for="popRegAlt">Alternate (optional)</label>
                </div>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  id="popRegPass"
                  name="password"
                  placeholder=" "
                  autocomplete="new-password"
                />
                <label for="popRegPass">Create Password</label>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  id="popRegConfirm"
                  name="password_confirmation"
                  placeholder=" "
                  autocomplete="new-password"
                />
                <label for="popRegConfirm">Confirm Password</label>
              </div>
              <button type="submit" class="btn btn-primary pop-submit">
                Create My Account
              </button>
              <p class="pop-note">
                By continuing, you agree to our
                <a href="terms-conditions.html">Terms &amp; Conditions</a> and
                <a href="privacy-policy.html">Privacy Policy</a>.
              </p>
            </form>
            <div class="pop-divider"><span>or</span></div>
            <button type="button" class="pop-google">
              <svg
                width="18"
                height="18"
                viewBox="0 0 48 48"
                aria-hidden="true"
              >
                <path
                  fill="#EA4335"
                  d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"
                />
                <path
                  fill="#4285F4"
                  d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"
                />
                <path
                  fill="#FBBC05"
                  d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"
                />
                <path
                  fill="#34A853"
                  d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"
                />
              </svg>
              Continue with Google
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="model product-view-pop">
      <div class="model-body">
        <button
          class="close close-btn"
          type="button"
          aria-label="Close quick view"
        >
          <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
        <div class="pvp-grid">
          <div class="pvp-visual">
            <img src="assets/images/home/pro4.png" alt="Meenakari Bangle Set" />
            <span class="pvp-badge">Trending</span>
          </div>
          <div class="pvp-content">
            <div class="pvp-meta">
              <span class="pvp-cat">Pihu Jewel</span>
              <span class="pvp-rate"><i class="fa-solid fa-star"></i> 4.8</span>
            </div>
            <h4 class="pvp-title">Meenakari Bangle Set</h4>
            <div class="pvp-price">
              <span class="price-now">₹1,299</span>
              <del class="price-old">₹1,799</del>
              <span class="price-off">28% OFF</span>
            </div>
            <p class="pvp-desc">
              A set of 6 bangles with colourful meenakari work, made for
              weddings, festive evenings and everyday celebrations.
            </p>
            <div class="pvp-size">
              <span class="pvp-label">Select Size</span>
              <div class="pvp-size-list">
                <input type="radio" name="pvpSize" id="pvpS22" checked />
                <label for="pvpS22">2.2</label>
                <input type="radio" name="pvpSize" id="pvpS24" />
                <label for="pvpS24">2.4</label>
                <input type="radio" name="pvpSize" id="pvpS26" />
                <label for="pvpS26">2.6</label>
                <input type="radio" name="pvpSize" id="pvpS28" />
                <label for="pvpS28">2.8</label>
              </div>
            </div>
            <div class="pvp-actions">
              <div class="pvp-qty qty">
                <button
                  type="button"
                  class="qty-minus"
                  aria-label="Decrease quantity"
                >
                  <i class="fa-solid fa-minus"></i>
                </button>
                <input type="text" class="qty-input" value="1" readonly />
                <button
                  type="button"
                  class="qty-plus"
                  aria-label="Increase quantity"
                >
                  <i class="fa-solid fa-plus"></i>
                </button>
              </div>
              <button
                type="button"
                data-id="SKU-P3"
                data-name="Meenakari Bangle Set"
                data-toast-title="Added to Cart"
                data-toast-text="Meenakari Bangle Set has been added to your cart."
                data-toast-type="success"
                class="btn btn-outline-black pvp-cart"
              >
                Add to Cart
              </button>
            </div>
            <a href="cart.html" class="btn btn-primary pvp-buy">
              Buy Now <i class="fa-solid fa-arrow-right-long"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="model offer-pop">
      <div class="model-body">
        <button class="close close-btn" type="button" aria-label="Close offer">
          <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
        <div class="op-grid">
          <div class="op-visual">
            <img
              src="assets/images/home/moments.jpg"
              alt="Welcome to Grih Shree and Pihu Jewel"
              loading="lazy"
            />
            <span class="op-badge"><b>10%</b> Off First Order</span>
          </div>
          <div class="op-content">
            <span class="op-eyebrow">A Welcome Gift</span>
            <h4 class="op-title">A Beautiful Beginning</h4>
            <p class="op-desc">
              Enjoy a special welcome offer on your first order of home
              essentials and jewellery.
            </p>
            <div class="op-price">
              <span class="op-save">Extra 10% Off</span>
              <span class="op-min">on your first order</span>
            </div>
            <div class="op-coupon">
              <span class="op-label">Use Coupon Code</span>
              <div class="op-code-box">
                <span class="op-code">WELCOME10</span>
                <button
                  type="button"
                  class="op-copy coupon-copy"
                  data-code="WELCOME10"
                >
                  <span>Copy Code</span>
                </button>
              </div>
            </div>
            <ul class="op-points">
              <li>
                <i class="fa-solid fa-check"></i> Home &amp; Living and
                Jewellery
              </li>
              <li>
                <i class="fa-solid fa-check"></i> Free shipping above ₹999
              </li>
            </ul>
            <div class="op-btns">
              <a href="all-product-listing.html" class="btn btn-primary">
                Shop Now <i class="fa-solid fa-arrow-right-long"></i>
              </a>
              <a href="all-product-listing.html" class="btn btn-outline-primary"
                >View Offers</a
              >
            </div>
            <p class="op-note">*Terms &amp; conditions apply.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="overlay"></div>

    <!-- ================= jQuery ================= -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.min.js"
      integrity="sha512-771ZvVCYr4EfUGXr63AcX7thw7EKa6QE1fhxi8JG7mPacB/arC0cyvYPXKUkCrX2sYKnnFCZby3ZZik42jOuSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"
      integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- ================= Swiper ================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>

    <!-- ================= Project JS ================= -->
    <script type="text/javascript" src="assets/js/animate.js"></script>
    <script type="text/javascript" src="assets/js/fancybox.js"></script>
    <script type="text/javascript" src="assets/js/function.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
  </body>
</html>
