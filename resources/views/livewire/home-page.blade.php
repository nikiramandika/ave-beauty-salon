<style>
    .image-holder {
        border-radius: 10px!important;

        
    }
    .product-image {
        border-radius: 10px 10px 10px 10px!important;
        padding-right: 0px!important;
        
    }
    .category-content {
    margin: auto; /* Ensures content within this div is centered */
    }

    .salon-essentials {
        max-width: none!important;
    }
    .rounded {
        border-radius: 10px!important;
    }
</style>

<div>
    <section id="billboard" class="bg-light full-screen">
        <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
            <h1 class="section-title text-center mt-4" data-aos="fade-up">Ave Beauty Salon</h1>
            <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                <p>Experience elegance and relaxation at Ave Beauty Salon, where beauty meets expertise. Our skilled
                    professionals
                    are here to provide exceptional salon services, premium products, and personalized treatments
                    crafted
                    just for you.
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
                        <h4 class="element-title text-capitalize my-3 heading-font">Relax</h4>
                        <p class="text-muted">Make an appointment for personalized salon services tailored to your needs.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#shopping-bag"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3 heading-font">Shop Products</h4>
                        <p class="text-muted">Explore a curated selection of beauty and hair products available in-store.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#gift"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3 heading-font">Salon Courses</h4>
                        <p class="text-muted">Join our courses to learn professional salon skills from experts.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="900">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#heart"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3 heading-font">Salon Treatments</h4>
                        <p class="text-muted">Indulge in our range of treatments for ultimate relaxation and beauty.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categories overflow-hidden">
        <div class="container">
            <div class="open-up" data-aos="zoom-out">
                <div class="row g-4"> <!-- Add `g-4` for consistent gap -->
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect text-center"> <!-- Added text-center for alignment -->
                            <div class="image-holder">
                                <a href="/products">
                                    <img src="user/images/shop-product.jpg" alt="categories"
                                        class="product-image img-fluid rounded">
                                </a>
                            </div>
                            <div class="category-content mt-3"> <!-- Added margin for spacing -->
                                <a href="/products" class="btn btn-common text-uppercase">Shop Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect text-center">
                            <div class="image-holder">
                                <a href="/treatment">
                                    <img src="user/images/treatment-details.jpg" alt="categories"
                                        class="product-image img-fluid rounded">
                                </a>
                            </div>
                            <div class="category-content mt-3">
                                <a href="/treatment" class="btn btn-common text-uppercase">Treatment Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect text-center">
                            <div class="image-holder">
                                <a href="/course">
                                    <img src="user/images/course-details.jpg" alt="categories"
                                        class="product-image img-fluid rounded">
                                </a>
                            </div>
                            <div class="category-content mt-3">
                                <a href="/course" class="btn btn-common text-uppercase text-center">Course Details</a>
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
                <div class="collection-item d-flex flex-wrap my-5 rounded bg-white px-0 mx-2">
                    <div class="col-md-6 column-container">
                        <div class=" ">
                            <img src="user/images/salon-essentials.jpg" alt="collection" class="product-image img-fluid w-100 salon-essentials">
                        </div>
                    </div>
                    <div class="col-md-6 column-container bg-white rounded">
                        <div class="collection-content p-5 m-0 m-md-">
                            <h4 class="element-title text-uppercase pb-2">About Ave Beauty</h4>
                            <p align="justify" class="text-muted">A curated collection of premium salon-quality hair care products,
                                including
                                nourishing shampoo, hydrating conditioner,
                                revitalizing vitamins, smoothing serum, and strengthening tonic. Each product is crafted
                                to
                                enhance the health, shine,
                                and vitality of your hair, giving you a luxurious salon experience at home. This
                                collection
                                is ideal for all hair types,
                                helping to repair damage, protect against environmental stressors, and support overall
                                hair
                                wellness.</p>
                            <a href="/about" class="btn btn-dark mt-3 rounded px-4">See more about us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="">Explore Categories Product</h4>
                <a href="/product" class="btn-link">View All Products</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder">
                                    <a href="/products?category={{ $category->category_slug }}">
                                        <img src="{{ asset($category->category_image ?? 'user/images/default.jpg') }}"
                                            alt="{{ $category->category_name }}" class="product-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                    </a>
                                    <div class="product-content">
                                       <h5 class="text-capitalize fs-5 mt-3">
                                            <a href="">
                                                {{ $category->category_name }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="blog py-5">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="">Choose the Right Treatment for You</h4>
                <a href="/treatment" class="btn-link">View All</a>
            </div>
            <div class="row g-5">
                @foreach($treatments->take(6) as $treatment)
                <div class="col-md-4">
                    <article class="post-item image-zoom-effect link-effect ">
                        <div class="post-image rounded image-holder">
                            <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}" alt="image"
                                class="product-image img-fluid rounded" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                            </a>
                        </div>
                        <div class="post-content gap-2 my-3">
                            <h5 class="post-title text-capitalize">
                                <a>{{ $treatment->treatment_name }}</a>
                            </h5>
                            <p align="justify" class="text-muted" >{{ strlen($treatment->description->description) > 200 ? substr($treatment->description->description, 0, 200) . '...' : $treatment->description->description }}</p>

                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="newsletter bg-light" style="background: url(/user/images/pattern-bg.png) no-repeat;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 py-4 my-4">
                    <div class="subscribe-header text-center pb-3">
                        <h3 class="section-title ">Check Our Instagram for Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="instagram position-relative">
        <div class="d-flex justify-content-center w-100 position-absolute bottom-0 z-1">
            <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                class="btn btn-dark rounded px-5 py-2" target="blank">Follow us on Instagram</a>
        </div>
        <div class="row g-0">
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram1.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram2.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram3.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram4.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram5.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="insta-item">
                    <a href="https://www.instagram.com/ave.beautysalon?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        target="_blank">
                        <img src="user/images/instagram6.jpg" alt="instagram" class="insta-image img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
