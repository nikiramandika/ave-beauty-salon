{{-- <div>
    <div class="container">
        <h2>Search Results for "{{ $query }}"</h2>

        <!-- Jika Produk Kosong dan Treatment Ada -->
        @if ($products->isEmpty() && !$treatments->isEmpty())
            <!-- Treatment Section -->
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h3>Treatments</h3>
                <div class="treatment-grid open-up" data-aos="zoom-out">
                    @foreach ($treatments as $treatment)
                        <div class="treatment-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid">
                                </a>
                                <div class="treatment-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
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
            </section>

            <!-- Pesan Produk Tidak Ditemukan -->
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h3>Products</h3>
                <p class="text-muted">No products found matching "{{ $query }}".</p>
            </section>
        @endif

        <!-- Jika Treatment Kosong dan Produk Ada -->
        @if ($treatments->isEmpty() && !$products->isEmpty())
            <!-- Produk Section -->
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h3>Products</h3>
                <div class="product-grid open-up" data-aos="zoom-out">
                    @foreach ($products as $product)
                        <div class="product-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('products/' . $product->product_slug) }}">
                                    <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                        style="width: 250px; height:250px; object-fit:cover;"
                                        alt="{{ $product->product_name }}" class="product-image img-fluid">
                                </a>
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ url('products/' . $product->product_slug) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <a href="#" class="text-decoration-none" data-after="Add to cart">
                                        <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Pesan Treatment Tidak Ditemukan -->
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h3>Treatments</h3>
                <p class="text-muted">No treatments found matching "{{ $query }}".</p>
            </section>
        @endif

        <!-- Jika Keduanya Ada -->
        @if (!$products->isEmpty() && !$treatments->isEmpty())
            <!-- Produk Section -->
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h3>Products</h3>
                <div class="product-grid open-up" data-aos="zoom-out">
                    @foreach ($products as $product)
                        <div class="product-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('products/' . $product->product_slug) }}">
                                    <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                        style="width: 250px; height:250px; object-fit:cover;"
                                        alt="{{ $product->product_name }}" class="product-image img-fluid">
                                </a>
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ url('products/' . $product->product_slug) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <a href="#" class="text-decoration-none" data-after="Add to cart">
                                        <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Treatment Section -->
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h3>Treatments</h3>
                <div class="treatment-grid open-up" data-aos="zoom-out">
                    @foreach ($treatments as $treatment)
                        <div class="treatment-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid">
                                </a>
                                <div class="treatment-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
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
            </section>
        @endif

        <!-- Jika Keduanya Kosong -->
        @if ($products->isEmpty() && $treatments->isEmpty())
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h3>Products</h3>
                <p class="text-muted">No products found matching "{{ $query }}".</p>
            </section>
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h3>Treatments</h3>
                <p class="text-muted">No treatments found matching "{{ $query }}".</p>
            </section>
        @endif
    </div>
</div> --}}


<div>
    <div class="container" style="min-height: 50vh;">
        <h3 class="mt-5">Search Results for "{{ $query }}"</h3>

        <!-- Jika Produk Kosong dan Treatment Ada -->
        @if ($products->isEmpty() && !$treatments->isEmpty())
            <!-- Treatment Section -->
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h4>Treatments</h4>
                <div class="treatment-grid open-up" data-aos="zoom-out">
                    @foreach ($treatments as $treatment)
                        <div class="treatment-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                </a>
                                <div class="treatment-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
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
            </section>
        @endif

        <!-- Jika Treatment Kosong dan Produk Ada -->
        @if ($treatments->isEmpty() && !$products->isEmpty())
            <!-- Produk Section -->
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h4>Products</h4>
                <div class="product-grid open-up" data-aos="zoom-out">
                    @foreach ($products as $product)
                        <div class="product-item image-zoom-effect link-effect">
                            <div class="image-holder" style="">
                                <div class="img-cont">
                                    <a href="{{ url('products/' . $product->product_slug) }}">
                                        <div>
                                            <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                                {{-- style="width: 250px; height:250px; object-fit:cover;" --}}
                                                alt="{{ $product->product_name }}" class="product-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ url('products/' . $product->product_slug) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <a class="text-decoration-none" data-after="Add to cart"
                                        wire:click.prevent="addToCart('{{ $product->product_id }}', 1)">
                                        <!-- Gunakan price_range -->
                                        <span>{{ $product->price_range ?? 'Harga tidak tersedia' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Jika Keduanya Ada -->
        @if (!$products->isEmpty() && !$treatments->isEmpty())
            <!-- Produk Section -->
            <section id="related-products"
                class="related-products product-carousel py-5 position-relative overflow-hidden">
                <h4>Products</h4>
                <div class="product-grid open-up" data-aos="zoom-out">
                    @foreach ($products as $product)
                        <div class="product-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('products/' . $product->product_slug) }}">
                                    <div>
                                        <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                            style="width: 250px; height:250px; object-fit:cover;"
                                            alt="{{ $product->product_name }}" class="product-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                    </div>
                                </a>
                                <div class="product-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
                                        <a href="{{ url('products/' . $product->product_slug) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <a class="text-decoration-none" data-after="Add to cart"
                                        wire:click.prevent="addToCart('{{ $product->product_id }}', 1)">
                                        <!-- Gunakan price_range -->
                                        <span>{{ $product->price_range ?? 'Harga tidak tersedia' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Treatment Section -->
            <section id="related-treatments"
                class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
                <h4>Treatments</h4>
                <div class="treatment-grid open-up" data-aos="zoom-out">
                    @foreach ($treatments as $treatment)
                        <div class="treatment-item image-zoom-effect link-effect">
                            <div class="image-holder">
                                <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                </a>
                                <div class="treatment-content">
                                    <h5 class="text-uppercase fs-5 mt-3">
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
            </section>
        @endif

        <!-- Jika Keduanya Kosong -->
        @if ($products->isEmpty() && $treatments->isEmpty())
            <p class="text-muted">No products or treatments found matching "{{ $query }}".</p>
        @endif
    </div>
</div>
