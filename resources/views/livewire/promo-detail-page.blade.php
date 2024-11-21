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
            <h2 class="text-center text-primary mb-4">Treatments Included in This Promo</h2>
            <div class="row g-4">
                @forelse ($promo->treatments as $treatment)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}" 
                                 alt="{{ $treatment->treatment_name }}" 
                                 class="card-img-top rounded-top" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $treatment->treatment_name }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($treatment->description->description ?? 'No description available', 100) }}
                                </p>
                                <p class="treatment-price text-success fw-bold">
                                    Price: Rp{{ number_format($treatment->price, 0, ',', '.') }}
                                </p>
                                <a href="/treatment/{{ $treatment->treatment_slug }}" class="btn btn-outline-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No treatments are included in this promo.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
