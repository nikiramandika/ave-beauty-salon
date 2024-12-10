<div>
    <section id="details" class="details">
        <div class="container-fluid">
            <div class="content d-flex justify-content-between gap-5 p-5 py-3">
                <div class="product-image">
                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                        alt="{{ $treatment->treatment_name }}" class="img-fluid product-image" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                </div>
                <div class="treatment-info ">
                    <h1 class="treatment-title">{{ $treatment->treatment_name }}</h1>
                    <p class="treatment-price heading-color" style="font-weight:600;">{{ $treatment->price ? 'Rp' . number_format($treatment->price, 0, ',', '.') : 'Variable price' }}</p>
                    <p class="treatment-duration">
                        Duration: <span>{{ $treatment->description->duration }}</span> minutes
                    </p><hr>
                    <p class="treatment-description" align="justify">
                        {{ $treatment->description->description }}
                    </p>
                    <p>Go to our salon to get our best treatment!</p>
                </div>
            </div>
        </div>
    </section>
</div>