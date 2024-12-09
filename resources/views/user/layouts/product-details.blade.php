<style>
    .form-select {
        width: max-content!important;
    }
    .product-image{
        width: 50%;
    }
    .product-info {
        width: 50%;
        div {
  word-wrap: break-word; /* Allows long words to break */
  overflow-wrap: break-word; /* Modern equivalent */
}
    }
    </style>

<div class="okela">
    <section id="details" class="details">
        <div class="container-fluid">
            <div class="content d-flex justify-content-between gap-5 p-5 py-3 ">
                <!-- Gambar Produk -->
                <div class="product-image">
                    <img src="{{ asset($product->description->product_image ?? 'path/to/default/image.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';"
                        alt="{{ $product->product_name }}" class="img-fluid product-image" >
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
                        Description
                    </p>
                    <p class="product-description" align="justify">
                        {{ $product->description->description ?? 'Tidak ada deskripsi.' }}euntungan Tabel Log dalam E-Commerce
                        Audit Trail: Mempermudah pelacakan aktivitas atau perubahan data.
                        Pemantauan Kinerja: Mengetahui pola penggunaan dan mengidentifikasi masalah.
                        Keamanan: Membantu mendeteksi aktivitas mencurigakan atau tidak sah.
                        Pengambilan Keputusan: Memberikan data untuk analisis tren atau evaluasi layanan.
                        Penerapan tabel log harus disesuaikan dengan kebutuhan spesifik dan skala dari e-commerce Anda.
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
                        <button id="addToCartButton"
                            wire:click="addToCart('{{ $product->product_id }}', document.getElementById('sizeDropdown').value)"
                            class="btn btn-primary mt-4">
                            Add to Cart
                        </button>
                    </div>
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

        addToCartButton.addEventListener('click', function() {
            backdrop.classList.add('show');
        });

        closeCartButton.addEventListener('click', function() {
            const backdropElement = document.getElementById('manualBackdrop');
            if (backdropElement) {
                backdropElement.remove();
            }
        });
    });
</script>
