<div>
    <!-- Promo Details -->
        <section id="promo-details" class="details">
            <div class="container-fluid">
                <div class="content d-flex justify-content-between gap-5 p-5 py-3">
                    <div class="product-image">
                        <img src="{{ asset($promo->description->promo_image ?? 'user/images/default.jpg') }}"
                        alt="{{ $promo->promo_name }}" class="img-fluid product-image" 
                        onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                    </div>
                    <div class="treatment-info">
                        <h1 class="treatment-title text-capitalize">{{ $promo->promo_name }}</h1>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted text-decoration-line-through fs-5">
                                Rp{{ number_format($promo->original_price, 0, ',', '.') }}
                            </span>
                            <span class="treatment-price heading-color my-0" style="font-weight: 600;">
                                Rp{{ number_format($promo->promo_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <hr>
                        <p class="promo-description text-muted">
                            {{ $promo->description->description }}
                        </p>

                        <a href="#promo-treatments" class="btn-link py-2" style="text-decoration: none;">Treatments Included in This Promo</a>
                    </div>
    
                </div>
            </div>
        </section>
    <!-- Treatments Included in Promo -->
    <section id="promo-treatments" class="promo-treatments py-3">
        <div class="container py-3">
            <h4 class="text-center mb-0 py-3">Treatments Included in This Promo</h4>
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-3 position-relative overflow-hidden">
                <div class="container">
                    <div class="treatment-grid open-up" data-aos="zoom-out">
                        @foreach ($promo->treatments as $treatment)
                            <div class="treatment-item image-zoom-effect link-effect">
                                <div class="image-holder">
                                    <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                        <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                            alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid" 
                                            onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                    </a>
                                    <div class="treatment-content">
                                       <h5 class="text-capitalize fs-5 mt-3">
                                            <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">{{ $treatment->treatment_name }}</a>
                                        </h5>
                                        <a href="#" class="text-decoration-none" data-after="View Details">
                                            <span>Rp{{ number_format($treatment->price, 0, ',', '.') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>