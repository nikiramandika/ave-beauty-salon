<div>
    <!-- Promo Details -->
    <section id="promo-details" class="promo-detail py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Gambar Promo -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset($promo->description->promo_image ?? 'user/images/default.jpg') }}"
                        alt="{{ $promo->promo_name }}" class="img-fluid rounded shadow-sm">
                </div>

                <!-- Informasi Promo -->
                <div class="col-md-6">
                    <h1 class="promo-title display-5 text-primary">{{ $promo->promo_name }}</h1>
                    <div class="price d-flex align-items-center gap-3 my-3">
                        <span class="original-price text-muted text-decoration-line-through fs-5">
                            Rp{{ number_format($promo->original_price, 0, ',', '.') }}
                        </span>
                        <span class="promo-price text-danger fs-3 fw-bold">
                            Rp{{ number_format($promo->promo_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <p class="promo-description text-muted">
                        {{ $promo->description->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Treatments Included in Promo -->
    <section id="promo-treatments" class="promo-treatments py-5">
        <div class="container">
            <h3 class="text-center mb-4">Treatments Included in This Promo</h3>
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <div class="container">
                    <div class="treatment-grid open-up" data-aos="zoom-out">
                        @foreach ($promo->treatments as $treatment)
                            <div class="treatment-item image-zoom-effect link-effect">
                                <div class="image-holder">
                                    <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                        <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                            alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid">
                                    </a>
                                    <div class="treatment-content">
                                       <h5 class="text-capitalize fs-5 mt-3">
                                            <a
                                                href="{{ url('treatment/' . $treatment->treatment_slug) }}">{{ $treatment->treatment_name }}</a>
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
