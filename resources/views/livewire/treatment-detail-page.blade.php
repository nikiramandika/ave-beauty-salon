<div style="background-color: #fdeef4">
    <section id="treatment-details" class="treatment-detail full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="treatment-image">
                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                        alt="{{ $treatment->treatment_name }}" class="img-fluid">
                </div>
                <div class="treatment-info">
                    <h1 class="treatment-title">{{ $treatment->treatment_name }}</h1>
                    <p class="treatment-price">{{ $treatment->price ? 'Rp' . number_format($treatment->price, 0, ',', '.') : 'Variable price' }}</p>
                    <p class="treatment-duration">
                        Duration: <span>{{ $treatment->description->duration }}</span> minutes
                    </p>
                    <p class="treatment-description" align="justify">
                        {{ $treatment->description->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
