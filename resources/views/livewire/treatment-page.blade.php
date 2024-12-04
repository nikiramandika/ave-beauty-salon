<div> <!-- Elemen root tunggal -->
    <section id="related-treatments" class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" data-aos="zoom-out">
                @foreach ($treatments as $treatment)
                    <div class="treatment-item image-zoom-effect link-effect">
                        <div class="image-holder">
                            <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                    alt="{{ $treatment->treatment_name }}"
                                    class="bd-placeholder-img card-img-top product-image img-fluid" width="100%"
                                    style="aspect-ratio: 1 / 1;">
                            </a>
                            <div class="treatment-content">
                                <h5 class="text-uppercase fs-5 mt-3">
                                    <a
                                        href="{{ url('treatment/' . $treatment->treatment_slug) }}">{{ $treatment->treatment_name }}</a>
                                </h5>
                                <a href="#" class="text-decoration-none" data-after="View Details">
                                    <span>
                                        {{$treatment->price ? 'Rp' . number_format($treatment->price, 0, ',', '.') : 'Variable price' }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
