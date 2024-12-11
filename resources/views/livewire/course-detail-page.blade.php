<div>
    <section id="course-detail" class="details">
        <div class="container-fluid">
            <div class="content d-flex justify-content-between gap-5 p-5 py-3 ">
                <!-- Gambar Produk -->
                <div class="product-image">
                    <img src="{{ asset($course->description->course_image) }}" alt="{{ $course->course_name }}"
                        onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';" class="img-fluid product-image">
                </div>

                <!-- Informasi Produk -->
                <div class="product-info">
                    <h1 class="product-title *:heading-color" style="font-weight:600;">{{ $course->course_name }}</h1>
                    <p class="product-price">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
                    <hr>
                    <p class="course-sessions"><strong>Sessions:</strong> {{ $course->sessions }}</p>
                    <p class="course-benefits"><strong>Benefits:</strong> {{ $course->description->benefits }}</p>
                    <p class="course-free-items"><strong>Free Items:</strong> {{ $course->description->free_items }}</p>
                    <p class="course-description" align="justify">{{ $course->description->description }}</p>
                    <button wire:click="redirectToCheckout" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </section>
</div>