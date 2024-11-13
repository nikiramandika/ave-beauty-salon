@extends('user.layouts.main')

@section('content')
<section id="billboard" class="bg-light full-screen">
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
      <h1 class="section-title text-center mt-4" data-aos="fade-up">Ave Beauty Salon</h1>
      <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
        <p>Experience elegance and relaxation at Ave Beauty Salon, where beauty meets expertise. Our skilled professionals
          are here to provide exceptional salon services, premium products, and personalized treatments crafted just for you.
          Let us help you look and feel your best.</p>
        <a href="#start" class="btn btn-primary mt-4">Check it out</a>
      </div>
    </div>
  </section>

<section class="features py-5" id="start">
  <div class="container">
    <div class="row">
      <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="0">
        <div class="py-5">
          <svg width="38" height="38" viewBox="0 0 24 24">
            <use xlink:href="#calendar"></use>
          </svg>
          <h4 class="element-title text-capitalize my-3">Book Appointment</h4>
          <p>Make an appointment for personalized salon services tailored to your needs.</p>
        </div>
      </div>
      <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
        <div class="py-5">
          <svg width="38" height="38" viewBox="0 0 24 24">
            <use xlink:href="#shopping-bag"></use>
          </svg>
          <h4 class="element-title text-capitalize my-3">Shop Salon Products</h4>
          <p>Explore a curated selection of beauty and hair products available in-store.</p>
        </div>
      </div>
      <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
        <div class="py-5">
          <svg width="38" height="38" viewBox="0 0 24 24">
            <use xlink:href="#gift"></use>
          </svg>
          <h4 class="element-title text-capitalize my-3">Salon Courses</h4>
          <p>Join our courses to learn professional salon skills from experts.</p>
        </div>
      </div>
      <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="900">
        <div class="py-5">
          <svg width="38" height="38" viewBox="0 0 24 24">
            <use xlink:href="#heart"></use>
          </svg>
          <h4 class="element-title text-capitalize my-3">Salon Treatments</h4>
          <p>Indulge in our range of treatments for ultimate relaxation and beauty.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="categories overflow-hidden">
  <div class="container">
    <div class="open-up" data-aos="zoom-out">
      <div class="row">
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="{{ route('user.pages.products') }}">
                <img src="user/images/cat-item1.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a class="nav-link" href="{{ route('user.pages.products') }}">Shop Product</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="{{ route('user.pages.treatment') }}">
                <img src="user/images/cat-item2.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a href="{{ route('user.pages.treatment') }}" class="btn btn-common text-uppercase">Treatment Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cat-item image-zoom-effect">
            <div class="image-holder">
              <a href="{{ route('user.pages.course') }}">
                <img src="user/images/cat-item3.jpg" alt="categories" class="product-image img-fluid">
              </a>
            </div>
            <div class="category-content">
              <div class="product-button">
                <a href="{{ route('user.pages.course') }}" class="btn btn-common text-uppercase">Course Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
</section>

<section class="collection bg-light position-relative py-5">
  <div class="container">
    <div class="row">
      <div class="title-xlarge text-uppercase txt-fx domino">Collection</div>
      <div class="collection-item d-flex flex-wrap my-5">
        <div class="col-md-6 column-container">
          <div class="image-holder">
            <img src="user/images/single-image-2.jpg" alt="collection" class="product-image img-fluid">
          </div>
        </div>
        <div class="col-md-6 column-container bg-white">
          <div class="collection-content p-5 m-0 m-md-">
            <h3 class="element-title text-uppercase">Salon Essentials</h3>
            <p align="justify">A curated collection of premium salon-quality hair care products, including nourishing shampoo, hydrating conditioner,
              revitalizing vitamins, smoothing serum, and strengthening tonic. Each product is crafted to enhance the health, shine,
              and vitality of your hair, giving you a luxurious salon experience at home. This collection is ideal for all hair types,
              helping to repair damage, protect against environmental stressors, and support overall hair wellness.</p>
            <a href="/about" class="btn btn-dark text-uppercase mt-3">Salon Details</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
      <h4 class="text-uppercase">You May Also Like</h4>
      <a href="{{ route('user.pages.products') }}" class="btn-link">View All Products</a>
    </div>
    <div class="swiper product-swiper open-up" data-aos="zoom-out">
      <div class="swiper-wrapper d-flex">
        <div class="swiper-slide">
          <div class="product-item image-zoom-effect link-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="user/images/product-item-5.jpg" alt="product" class="product-image img-fluid">
              </a>
              <div class="product-content">
                <h5 class="text-uppercase fs-5 mt-3">
                  <a href="index.html">Serum Biolage Matrix</a>
                </h5>
                <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>Rp150.000</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="product-item image-zoom-effect link-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="user/images/product-item-6.jpg" alt="product" class="product-image img-fluid">
              </a>
              <div class="product-content">
                <h5 class="text-uppercase fs-5 mt-3">
                  <a href="index.html">Matrix Scalppure Shampoo</a>
                </h5>
                <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>Rp180.000</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="product-item image-zoom-effect link-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="user/images/product-item-7.jpg" alt="product" class="product-image img-fluid">
              </a>
              <div class="product-content">
                <h5 class="text-uppercase fs-5 mt-3">
                  <a href="index.html">Barbara Foam Hair</a>
                </h5>
                <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>Rp80.000</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="product-item image-zoom-effect link-effect">
            <div class="image-holder">
              <a href="index.html">
                <img src="user/images/product-item-8.jpg" alt="product" class="product-image img-fluid">
              </a>
              <div class="product-content">
                <h5 class="text-uppercase fs-5 mt-3">
                  <a href="index.html">Matrix Plex Shampoo Inaura</a>
                </h5>
                <a href="index.html" class="text-decoration-none" data-after="Add to cart"><span>Rp100.000</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="blog py-5">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
      <h4 class="text-uppercase">Choose the Right Treatment for You</h4>
      <a href="{{ route('user.pages.treatment') }}" class="btn-link">View All</a>
    </div>
    <div class="row">
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a>
              <img src="user/images/post-image1.jpg" alt="image" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <h5 class="post-title text-uppercase">
              <a>Hairmask</a>
            </h5>
            <p align="justify">A deep-conditioning treatment that nourishes and repairs damaged hair, leaving it softer, shinier, and more manageable.</p>
          </div>
        </article>
      </div>
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a>
              <img src="user/images/post-image2.jpg" alt="image" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <h5 class="post-title text-uppercase">
              <a>Menicure</a>
            </h5>
            <p align="justify">A hand and nail treatment that includes shaping, cuticle care, and polishing, leaving your nails looking healthy and well-groomed.</p>
          </div>
        </article>
      </div>
      <div class="col-md-4">
        <article class="post-item">
          <div class="post-image">
            <a>
              <img src="user/images/post-image3.jpg" alt="image" class="post-grid-image img-fluid">
            </a>
          </div>
          <div class="post-content d-flex flex-wrap gap-2 my-3">
            <h5 class="post-title text-uppercase">
              <a>Pedicure</a>
            </h5>
            <p align="justify">A foot and nail care treatment that includes exfoliation, nail trimming, and moisturizing, resulting in soft, rejuvenated feet.</p>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<section class="newsletter bg-light" style="background: url(/user/images/pattern-bg.png) no-repeat;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 py-4 my-4">
        <div class="subscribe-header text-center pb-3">
        <h3 class="section-title text-uppercase">Check Our Instagram for Details</h3>
      </div>
      </div>
    </div>
  </div>
</section>

<section class="instagram position-relative">
  <div class="d-flex justify-content-center w-100 position-absolute bottom-0 z-1">
    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="btn btn-dark px-5">Follow us on Instagram</a>
  </div>
  <div class="row g-0">
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item1.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item2.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item3.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item4.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item5.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
    <div class="col-6 col-sm-4 col-md-2">
      <div class="insta-item">
        <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
          <img src="user/images/insta-item6.jpg" alt="instagram" class="insta-image img-fluid">
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
