<div class="okela">
    <section id="details" class="details">
        <div class="container-fluid">
            <div class="content d-flex justify-content-between gap-5 p-5 py-3 ">
                <!-- Gambar Produk -->
                <div class="product-image">
                    <img src="{{ asset($product->description->product_image ?? 'path/to/default/image.jpg') }}"
                        onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';"
                        alt="{{ $product->product_name }}" class="img-fluid product-image">
                </div>

                <!-- Informasi Produk -->
                <div class="product-info">
                    <h1 class="product-title">{{ $product->product_name }}</h1>
                    <p class="product-price heading-color" style="font-weight:600;">
                        Rp {{ number_format($product->details->first()->price ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="product-availability" id="productStock" style="">
                        Stock: {{ $product->details->first()->product_stock ?? '0' }}
                    </p>

                    <!-- Harga dan Stok -->


                    <hr>
                    <!-- Deskripsi -->
                    <p class="heading-color" style="font-weight: 500">
                    </p>
                    <p class="product-description" align="justify">
                        {{ $product->description->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                    <!-- Pilih Ukuran -->
                    @if ($product->details->count() > 0)
                        <label for="sizeDropdown" class="form-label" style="font-weight: 500">Pilih Ukuran:</label>
                        <select id="sizeDropdown" class="form-select">
                            @foreach ($product->details as $detail)
                                <option value="{{ $detail->detail_id }}" data-stock="{{ $detail->product_stock }}"
                                    data-price="{{ $detail->price }}">
                                    Ukuran: {{ $detail->size }} - Rp{{ number_format($detail->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <p class="text-danger">Ukuran tidak tersedia.</p>
                    @endif

                    <!-- Tombol Tambah ke Keranjang -->
                    <div>
                        @auth
                            <!-- Jika sudah login, tombol akan menambah ke keranjang -->
                            <button id="addToCartButton"
                                wire:click="addToCart('{{ $product->product_id }}', document.getElementById('sizeDropdown').value)"
                                class="btn btn-primary mt-4">
                                Add to Cart
                            </button>
                        @else
                            <!-- Jika belum login, tombol mengarah ke halaman login -->
                            <a href="/login" class="btn btn-primary mt-4 " style="text-decoration: none; color: white">
                                Add to Cart
                            </a>
                        @endauth
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" style="z-index: 10000"
                            id="errorMessage" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        <script>
                            window.isError = true;
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeDropdown = document.getElementById('sizeDropdown'); // Dropdown ukuran
        const priceElement = document.getElementById('productPrice'); // Elemen harga
        const stockElement = document.getElementById('productStock'); // Elemen stok

        function updatePriceAndStock() {
            const selectedOption = sizeDropdown.options[sizeDropdown.selectedIndex]; // Ambil opsi terpilih
            const price = selectedOption.getAttribute('data-price'); // Ambil data harga
            const stock = selectedOption.getAttribute('data-stock'); // Ambil data stok

            // Update elemen harga dan stok
            priceElement.innerText = `Harga: Rp${new Intl.NumberFormat('id-ID').format(price)}`;
            stockElement.innerText = `Stock: ${stock}`;
        }

        // Jalankan fungsi saat dropdown diubah
        sizeDropdown.addEventListener('change', updatePriceAndStock);

        // Jalankan fungsi saat halaman pertama kali dimuat
        updatePriceAndStock();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeCartButton = document.querySelector('[data-bs-dismiss="offcanvas"]');
        const addToCartButton = document.getElementById('addToCartButton');
        const backdrop = document.createElement('div');
        backdrop.className = 'manual-backdrop';
        backdrop.id = 'manualBackdrop';
        document.body.appendChild(backdrop);

        // Cek apakah ada elemen dengan kelas alert-danger
        const errorAlert = document.querySelector('.alert-danger');
        if (errorAlert) {
            const backdropElement = document.getElementById('manualBackdrop');
            if (backdropElement) {
                backdropElement.remove();
            }
        }

        addToCartButton.addEventListener('click', function() {
            // Menambahkan backdrop hanya jika tidak ada alert-danger
            if (!errorAlert) {
                backdrop.classList.add('show');
            }
        });

        closeCartButton.addEventListener('click', function() {
            const backdropElement = document.getElementById('manualBackdrop');
            if (backdropElement) {
                backdropElement.remove();
            }
        });
    });
</script>
