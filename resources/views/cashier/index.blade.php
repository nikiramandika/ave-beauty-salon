<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery (Dibutuhkan oleh Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hidden {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('cashier.components.navbar')

    <!-- Sidebar -->
    @include('cashier.components.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen pt-16 pl-64 transition-all duration-300">
        <div class="p-6 flex gap-6">
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="tabs-nav flex border-b border-gray-300 mb-4">
                        <button
                            class="tab-link py-2 px-4 font-medium text-blue-600 border-blue-600 border-b-2 focus:outline-none"
                            data-section="productsSection" onclick="showSection('productsSection', this)">
                            Produk
                        </button>
                        <button
                            class="tab-link py-2 px-4 font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600 border-b-2 border-transparent focus:outline-none"
                            data-section="treatmentsSection" onclick="showSection('treatmentsSection', this)">
                            Treatment
                        </button>
                        <button
                            class="tab-link py-2 px-4 font-medium text-gray-600 hover:text-blue-600 hover:border-blue-600 border-b-2 border-transparent focus:outline-none"
                            data-section="promosSection" onclick="showSection('promosSection', this)">
                            Promo
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <!-- Product Grid -->
                    <div id="productsSection" class="section block">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($products as $product)
                                @if ($product->details->isNotEmpty())
                                    @foreach ($product->details as $detail)
                                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer"
                                            data-id="{{ $product->product_id }}"
                                            data-name="{{ $product->product_name }}"
                                            data-price="{{ $detail->price ?? 0 }}"
                                            data-detail-id="{{ $detail->detail_id ?? '' }}"
                                            data-stock="{{ $detail->product_stock ?? 0 }}"
                                            data-size="{{ $detail->size ?? 'N/A' }}" data-type="product"
                                            onclick="addToCart(this)">
                                            <!-- Gambar Produk -->
                                            <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                                alt="{{ $product->product_name }}" class="w-full h-32 object-cover">
                                            <!-- Informasi Detail Produk -->
                                            <div class="p-3">
                                                <h3 class="font-semibold">{{ $product->product_name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    Size: {{ $detail->size ?? 'N/A' }}
                                                </p>
                                                <p class="text-green-600 font-bold">
                                                    Rp{{ number_format($detail->price ?? 0, 0, ',', '.') }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    Stock: {{ $detail->product_stock ?? 0 }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Tampilkan Pesan Jika Tidak Ada Detail -->
                                    <div class="bg-red-100 border border-red-300 rounded-lg p-3 text-center">
                                        <h3 class="font-semibold text-red-500">{{ $product->product_name }}</h3>
                                        <p class="text-sm text-red-400">Detail produk tidak tersedia.</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


                    <!-- Treatment Grid -->
                    <div id="treatmentsSection" class="section hidden">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($treatments as $treatment)
                                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer"
                                    data-id="{{ $treatment->treatment_id }}"
                                    data-name="{{ $treatment->treatment_name }}" data-type="treatment"
                                    data-price="{{ $treatment->price ?? '' }}"
                                    onclick="{{ $treatment->price !== null ? 'addToCart(this)' : 'openPriceModal(this)' }}">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="w-full h-32 object-cover">
                                    <div class="p-3">
                                        <h3 class="font-semibold">{{ $treatment->treatment_name }}</h3>
                                        @if ($treatment->price !== null)
                                            <p class="text-green-600 font-bold">Rp
                                                {{ number_format($treatment->price, 0, ',', '.') }}</p>
                                        @else
                                            <p class="text-red-600 font-bold">Variable Price</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!-- Promo Grid -->
                    <div id="promosSection" class="section hidden">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($promos as $promo)
                                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer"
                                    data-id="{{ $promo->promo_id }}" data-name="{{ $promo->promo_name }}"
                                    data-type="promo" data-price="{{ $promo->promo_price }}" onclick="addToCart(this)">
                                    <img src="{{ asset($promo->description->promo_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $promo->promo_name }}" class="w-full h-32 object-cover">
                                    <div class="p-3">
                                        <h3 class="font-semibold">{{ $promo->promo_name }}</h3>
                                        <div class="price flex items-center space-x-2">
                                            <span
                                                class="line-through text-red-500">Rp{{ number_format($promo->original_price, 0, ',', '.') }}</span>
                                            <span
                                                class="text-green-600 font-bold">Rp{{ number_format($promo->promo_price, 0, ',', '.') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500" align="justify">
                                            {{ \Illuminate\Support\Str::limit($promo->description->description, 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cashier Section -->
            <div class="w-96">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-center mb-6">Kasir</h1>
                        <div id="cartList" class="mb-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Daftar Produk</h3>
                            <!-- Produk yang dipilih akan ditambahkan di sini -->
                        </div>
                        <form id="paymentForm" action="{{ route('cashier.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart" id="cartInput">
                            <!-- Total Belanja -->
                            <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700">Total Belanja</label>
                                <input type="text" id="totalAmountDisplay"
                                    class="mt-1 block w-full text-3xl font-bold text-blue-600 bg-transparent border-none"
                                    value="Rp 0" readonly>
                                <input type="hidden" id="totalAmount" name="total_amount" value="0">
                            </div>


                            <!-- Metode Pembayaran -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Metode
                                    Pembayaran</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" id="cash" value="cash"
                                            class="form-radio h-4 w-4 text-blue-600" checked>
                                        <label for="cash" class="ml-2">Tunai</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" id="cashless"
                                            value="Bank Transfer" class="form-radio h-4 w-4 text-blue-600">
                                        <label for="cashless" class="ml-2">Non-Tunai</label>
                                    </div>
                                </div>

                                <!-- Dropdown Bank -->
                                <div id="bankSelection" class="mt-4 hidden">
                                    <label for="bank" class="block text-sm font-medium text-gray-700">Pilih
                                        Bank</label>
                                    <select id="bank" name="bank"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">-- Pilih Bank --</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Input Uang Tunai -->
                            <div id="cashInput" class="mb-6">
                                <label for="cashAmount" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Uang
                                </label>
                                <input type="number" name="cash_amount" id="cashAmount"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Masukkan jumlah uang">
                            </div>

                            <!-- Kembalian -->
                            <div id="changeAmount" class="mb-6 hidden bg-green-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700">Kembalian</label>
                                <div id="changeDisplay" class="text-2xl font-bold text-green-600">Rp 0</div>
                            </div>
                            <!-- Dropdown Pilihan User -->
                            <div class="mb-6">
                                <select id="userSelect" class="w-full select2">
                                    <option value=""></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" data-phone="{{ $user->phone ?? '-' }}"
                                            data-email="{{ $user->email ?? '-' }}"
                                            data-member="{{ $user->member ? 1 : 0 }}"
                                            data-poin="{{ $user->member->points ?? 0 }}">
                                            {{ $user->nama_depan }} {{ $user->nama_belakang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input Nomor Telepon dan Email (Default Hidden) -->
                            <div id="userDetails" class="hidden">
                                <div class="mb-4">
                                    <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="mb-4">
                                    <label for="emailAddress"
                                        class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="emailAddress" name="emailAddress" readonly
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                            <!-- Bagian Detail Member -->
                            <div id="memberDetails" class="hidden">
                                <div class="mb-4">
                                    <label for="poinUsed" class="block text-sm font-medium text-gray-700">
                                        Poin (Tersedia: <span id="availablePoin">0</span>)
                                    </label>
                                    <input type="number" id="poinUsed" name="poinUsed"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Masukkan jumlah poin yang akan digunakan" min="0">
                                </div>
                            </div>





                            <!-- Tombol Submit -->
                            <button type="button" id="confirmPaymentButton"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50">
                                Proses Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="priceModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 transform transition-transform scale-95 duration-300">
            <h2 class="text-lg font-semibold mb-4">Enter Price</h2>
            <form id="priceForm">
                <div class="mb-4">
                    <label for="modalTreatmentName" class="block text-sm font-medium text-gray-700">Treatment
                        Name</label>
                    <input type="text" id="modalTreatmentName"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                </div>
                <div class="mb-4">
                    <label for="modalPrice" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="modalPrice"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter price" required>
                </div>
                <input type="hidden" id="modalTreatmentId">
            </form>
            <div class="flex justify-end gap-2">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                    onclick="closePriceModal()">Cancel</button>
                <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    onclick="savePrice()">Save</button>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="confirmationModal"
        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4">Konfirmasi Pembayaran</h2>
                <div id="modalContent">
                    <!-- Konten dinamis akan diisi dengan JavaScript -->
                </div>
                <div class="flex justify-between mt-6">
                    <button id="cancelButton" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        Batal
                    </button>
                    <button id="printInvoiceButton"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function () {
    // Variabel untuk nilai konversi poin ke rupiah
    const pointValue = 5000; // 1 poin = Rp 5.000

    // Simpan total belanja asli saat halaman dimuat
    const originalTotalAmount = parseInt($('#totalAmount').val()) || 0;

    // Event listener untuk input poin
    $('#poinUsed').on('input', function () {
        const usedPoints = parseInt($(this).val()) || 0; // Jumlah poin yang dimasukkan
        const availablePoints = parseInt($('#availablePoin').text()) || 0; // Poin yang tersedia

        // Validasi agar tidak melebihi poin yang tersedia
        if (usedPoints > availablePoints) {
            alert("Jumlah poin yang dimasukkan melebihi poin yang tersedia.");
            $(this).val(availablePoints); // Atur nilai maksimum
            return;
        }

        // Hitung total pengurangan
        const discount = usedPoints * pointValue;

        // Perbarui nilai totalAmountDisplay dan totalAmount
        const newTotal = originalTotalAmount - discount > 0 ? originalTotalAmount - discount : 0; // Pastikan tidak negatif
        $('#totalAmountDisplay').val(formatRupiah(newTotal));
        $('#totalAmount').val(newTotal);
    });

    // Fungsi untuk memformat angka menjadi format Rupiah
    function formatRupiah(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});


    </script>


    <script>
        let currentElement = null;

        function openPriceModal(element) {
            currentElement = element;

            // Ambil data dari elemen yang diklik
            const treatmentName = element.getAttribute('data-name');
            const treatmentId = element.getAttribute('data-id');

            // Isi data modal
            document.getElementById('modalTreatmentName').value = treatmentName;
            document.getElementById('modalTreatmentId').value = treatmentId;

            // Tampilkan modal
            const modal = document.getElementById('priceModal');
            modal.classList.remove('hidden');

            // Tambahkan kelas untuk animasi masuk
            const modalContent = modal.querySelector('.transform');
            modalContent.classList.add('scale-100'); // Skala akhir
            modalContent.classList.remove('scale-95'); // Hapus skala awal
            modalContent.classList.add('transition-transform'); // Pastikan transisi aktif
            modal.focus();
        }


        function closePriceModal() {
            // Sembunyikan modal
            const modal = document.getElementById('priceModal');
            // Tambahkan animasi keluar
            const modalContent = modal.querySelector('.transform');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');

            // Sembunyikan modal setelah animasi selesai
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150); // Sesuaikan dengan durasi animasi Tailwind
        }

        function savePrice() {
            const enteredPrice = document.getElementById('modalPrice').value;

            // Validasi input harga
            if (enteredPrice !== "" && !isNaN(enteredPrice) && parseFloat(enteredPrice) > 0) {
                // Set data-price pada elemen yang sedang diproses
                currentElement.setAttribute('data-price', enteredPrice);

                // Panggil fungsi addToCart (sudah ada di sistem Anda)
                addToCart(currentElement);

                // Tutup modal
                closePriceModal();
            } else {
                alert("Please enter a valid price.");
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cashRadio = document.getElementById('cash');
            const cashlessRadio = document.getElementById('cashless');
            const bankSelection = document.getElementById('bankSelection');

            // Fungsi untuk menunjukkan atau menyembunyikan dropdown bank
            function toggleBankSelection() {
                if (cashlessRadio.checked) {
                    bankSelection.classList.remove('hidden'); // Tampilkan dropdown bank
                } else {
                    bankSelection.classList.add('hidden'); // Sembunyikan dropdown bank
                }
            }

            // Event listener untuk perubahan pada radio button
            cashRadio.addEventListener('change', toggleBankSelection);
            cashlessRadio.addEventListener('change', toggleBankSelection);
        });
    </script>


    <script>
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmPaymentButton = document.getElementById('confirmPaymentButton');
        const cancelButton = document.getElementById('cancelButton');
        const printInvoiceButton = document.getElementById('printInvoiceButton');
        const modalContent = document.getElementById('modalContent');

        // ID kasir
        const cashierId =
            "{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}"; // Pastikan Anda mengambil ID kasir dari backend

        // Fungsi untuk membuka modal
        confirmPaymentButton.addEventListener('click', function() {
    // Tampilkan produk dan total harga di modal
    let cartItems = cart.map((item, index) => `
        <div class="flex justify-between mb-2">
            <span>${index + 1}. ${item.name} (x${item.quantity})</span>
            <span>${formatRupiah(item.price * item.quantity)}</span>
        </div>
    `).join('');

    // Total harga asli (sebelum diskon poin)
    let totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // Ambil poin yang digunakan dari input
    let poinUsed = parseInt(document.getElementById('poinUsed').value) || 0;
    const pointValue = 5000; // Nilai 1 poin dalam rupiah
    let discountFromPoints = poinUsed * pointValue;

    // Total harga setelah diskon poin
    let discountedPrice = totalPrice - discountFromPoints;
    discountedPrice = discountedPrice > 0 ? discountedPrice : 0; // Pastikan tidak negatif

    // Ambil jumlah uang tunai dari input
    let cashAmount = parseInt(document.getElementById('cashAmount').value) || 0;

    // Hitung kembalian
    let changeAmount = cashAmount - discountedPrice;
    let formattedChangeAmount = formatRupiah(changeAmount > 0 ? changeAmount : 0);

    // Ambil nama pelanggan dari dropdown
    let userSelect = document.getElementById('userSelect');
    let selectedUser = userSelect.options[userSelect.selectedIndex].text || "Tidak Ada Pelanggan";

    // Ambil metode pembayaran
    let paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    let paymentMethodText = paymentMethod === 'cash' ? 'Tunai' : 'Non-Tunai';

    // Perbarui konten modal
    modalContent.innerHTML = `
        <div class="mb-4">
            <strong>ID Kasir:</strong> ${cashierId}
        </div>
        <div class="mb-4">
            <strong>Pelanggan:</strong> ${selectedUser}
        </div>
        <div class="mb-4">
            <h3 class="text-sm font-semibold mb-2">Produk:</h3>
            ${cartItems}
        </div>
        <div class="mb-4">
            <strong>Metode Pembayaran:</strong> ${paymentMethodText}
        </div>
        <div class="mb-4">
            <strong>Total Harga Sebelum Diskon:</strong> ${formatRupiah(totalPrice)}
        </div>
        <div class="mb-4">
            <strong>Potongan Poin:</strong> ${formatRupiah(discountFromPoints)}
        </div>
        <div class="mb-4">
            <strong>Total Harga Setelah Diskon:</strong> ${formatRupiah(discountedPrice)}
        </div>
        ${paymentMethod === 'cash' ? `
        <div class="mb-4">
            <strong>Jumlah Tunai:</strong> ${formatRupiah(cashAmount)}
        </div>
        <div class="mb-4">
            <strong>Kembalian:</strong> ${formattedChangeAmount}
        </div>` : ''}
    `;

    // Tampilkan modal
    confirmationModal.classList.remove('hidden');
});




        // Fungsi untuk menutup modal
        cancelButton.addEventListener('click', function() {
            confirmationModal.classList.add('hidden');
        });

        printInvoiceButton.addEventListener('click', function () {
    console.log('Tombol Cetak Invoice diklik');

    try {
        // Ambil metode pembayaran
        let paymentMethodElement = document.querySelector('input[name="payment_method"]:checked');
        let paymentMethod = paymentMethodElement ? paymentMethodElement.value : null;
        if (!paymentMethod) {
            console.error('Metode pembayaran tidak ditemukan!');
            alert('Harap pilih metode pembayaran.');
            return;
        }

        // Ambil bank jika metode pembayaran Non-Tunai
        let recipientBank = null; // Default null
        if (paymentMethod === "Bank Transfer") {
            let bankSelectionElement = document.getElementById('bank');
            recipientBank = bankSelectionElement ? bankSelectionElement.value : null;

            if (!recipientBank) {
                console.error('Bank belum dipilih!');
                alert('Harap pilih bank untuk pembayaran Non-Tunai.');
                return;
            }
        }

        // Ambil data pelanggan dari dropdown
        let customerSelect = document.getElementById('userSelect');
        let recipientName = customerSelect && customerSelect.selectedOptions.length > 0 ?
            customerSelect.selectedOptions[0].textContent.trim() :
            null;

        let customerId = customerSelect ? customerSelect.value : null;

        // Ambil nomor telepon
        let recipientPhoneElement = document.getElementById('phoneNumber');
        let recipientPhone = recipientPhoneElement ? recipientPhoneElement.value.trim() : null;

        // Ambil email
        let recipientEmailElement = document.getElementById('emailAddress');
        let recipientEmail = recipientEmailElement ? recipientEmailElement.value.trim() : null;

        // Total harga asli (sebelum diskon poin)
        let totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        // Ambil poin yang digunakan dari input
        let poinUsed = parseInt(document.getElementById('poinUsed').value) || 0;
        if (poinUsed < 0) poinUsed = 0; // Pastikan poin tidak negatif
        const pointValue = 5000; // Nilai 1 poin dalam rupiah
        let discountFromPoints = poinUsed * pointValue;

        // Total harga setelah diskon poin
        let discountedPrice = totalPrice - discountFromPoints;
        discountedPrice = discountedPrice > 0 ? discountedPrice : 0; // Pastikan tidak negatif

        // Ambil jumlah uang tunai dari input
        let cashAmount = parseInt(document.getElementById('cashAmount').value) || 0;
        if (cashAmount < 0) cashAmount = 0; // Pastikan uang tunai tidak negatif

        // Hitung kembalian
        let changeAmount = cashAmount - discountedPrice;
        let formattedChangeAmount = formatRupiah(changeAmount > 0 ? changeAmount : 0);

        // Masukkan used_points dan discount_from_points ke dalam cart
        cart = cart.map(item => {
            return {
                ...item,
                used_points: poinUsed, // Seluruh poin digunakan didistribusikan ke keranjang
                discount_from_points: discountFromPoints // Diskon total yang digunakan
            };
        });

        console.log('Updated Cart:', cart);
        console.log('Recipient Name:', recipientName);
        console.log('Customer ID:', customerId);
        console.log('Recipient Phone:', recipientPhone);
        console.log('Recipient Email:', recipientEmail);
        console.log('Recipient Bank:', recipientBank);
        console.log('Cart Data:', cart);
        console.log('Total Price (Before Discount):', totalPrice);
        console.log('Total Discount from Points:', discountFromPoints);
        console.log('Total Price (After Discount):', discountedPrice);
        console.log('Cash Amount:', cashAmount);
        console.log('Change Amount:', formattedChangeAmount);

        // Pastikan cart tidak kosong
        if (!cart || cart.length === 0) {
            console.error('Keranjang belanja kosong!');
            alert('Keranjang belanja kosong. Harap tambahkan item sebelum melanjutkan.');
            return;
        }

        // Kirim permintaan dengan fetch API
        fetch('/process-invoice-cashier', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                cashier_id: "{{ auth()->id() }}",
                customer_id: customerId,
                recipient_name: recipientName,
                recipient_email: recipientEmail,
                recipient_phone: recipientPhone,
                recipient_bank: recipientBank,
                payment_method: paymentMethod,
                cart: cart // Keranjang yang sudah termasuk poin dan diskon
            })
        })
            .then(response => {
                console.log('Response Status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Invoice processed:', data);

                // Sembunyikan modal konfirmasi jika sukses
                confirmationModal.classList.add('hidden');

                // Tampilkan modal alert
                showAlertModal();
            })
            .catch(error => {
                console.error('Error processing invoice:', error);
                alert('Terjadi kesalahan saat memproses invoice. Silakan coba lagi.');
            });
    } catch (error) {
        console.error('Unhandled error:', error);
        alert('Terjadi kesalahan yang tidak terduga. Harap periksa input Anda.');
    }
});


        function showAlertModal() {
            // Buat modal HTML
            const modalHTML = `
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold text-center mb-4">Invoice Berhasil Diproses</h2>
                <p class="text-sm text-gray-600 text-center mb-6">Silakan pilih untuk mencetak invoice atau menghapus keranjang.</p>
                <div class="flex justify-around">
                    <button id="printInvoice" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Print Invoice
                    </button>
                    <button id="okButton" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        OK
                    </button>
                </div>
            </div>
        </div>
    `;

            // Tambahkan modal ke body
            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Event listener untuk tombol Print Invoice
            document.getElementById('printInvoice').addEventListener('click', function() {
                printInvoice(); // Panggil fungsi print
                clearCart(); // Hapus keranjang
                closeModal();
            });

            // Event listener untuk tombol OK
            document.getElementById('okButton').addEventListener('click', function() {
                clearCart(); // Hapus keranjang dari localStorage
                closeModal();
            });
        }

        function closeModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.remove();
            }
        }

        function clearCart() {
            console.log('Menghapus keranjang...');
            localStorage.removeItem('cart'); // Hapus data keranjang dari localStorage
            cart = []; // Reset data keranjang di memori
            updateCartDisplay(); // Perbarui tampilan keranjang
            updateTotal(); // Perbarui total harga
        }

        function printInvoice() {
            console.log('Mencetak invoice...');
            let totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            let invoiceWindow = window.open('', '_blank');
            invoiceWindow.document.write(`
        <html>
        <head>
            <title>Invoice</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .invoice-header { text-align: center; margin-bottom: 20px; }
                .invoice-items { margin-bottom: 20px; }
                .invoice-total { font-weight: bold; }
            </style>
        </head>
        <body>
            <div class="invoice-header">
                <h1>Invoice</h1>
                <p>Total: Rp ${totalPrice.toLocaleString('id-ID')}</p>
            </div>
            <div class="invoice-items">
                ${cart.map((item, index) => `
                                                                                                                                                            <div>${index + 1}. ${item.name} (x${item.quantity}) - Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</div>
                                                                                                                                                        `).join('')}
            </div>
            <div class="invoice-total">
                <strong>Total:</strong> Rp ${totalPrice.toLocaleString('id-ID')}
            </div>
        </body>
        </html>
    `);
            invoiceWindow.document.close();
            invoiceWindow.print();
        }
    </script>

<script>
    $(document).ready(function () {
    // Inisialisasi Select2
    $('#userSelect').select2({
        placeholder: "Pilih Pelanggan...",
        allowClear: true
    });

    // Muat data yang tersimpan di localStorage saat halaman dimuat
    const savedUserId = localStorage.getItem('selectedUserId');
    if (savedUserId) {
        $('#userSelect').val(savedUserId).trigger('change'); // Pilih pengguna di dropdown

        // Ambil data dari opsi yang sesuai
        const selectedOption = $('#userSelect').find(`option[value="${savedUserId}"]`);
        const phone = selectedOption.data('phone') || '-';
        const email = selectedOption.data('email') || '-';
        const isMember = selectedOption.data('member') === 1; // Data member
        const poin = selectedOption.data('poin') || 0; // Data poin

        // Set nilai pada input dan tampilkan
        $('#phoneNumber').val(phone);
        $('#emailAddress').val(email);
        $('#userDetails').removeClass('hidden');

        // Tampilkan poin jika user adalah member
        if (isMember) {
            $('#memberDetails').removeClass('hidden');
            $('#availablePoin').text(poin); // Tampilkan poin yang tersedia
            $('#poinUsed').attr('max', poin); // Batasi input poin hingga jumlah poin yang tersedia
        } else {
            $('#memberDetails').addClass('hidden');
            $('#availablePoin').text('0');
            $('#poinUsed').val('').attr('max', 0);
        }
    }

    // Event listener untuk perubahan dropdown
    $('#userSelect').on('change', function () {
        const selectedOption = $(this).find(':selected'); // Opsi yang dipilih
        const userId = $(this).val(); // ID pengguna yang dipilih
        const phone = selectedOption.data('phone') || '-';
        const email = selectedOption.data('email') || '-';
        const isMember = selectedOption.data('member') === 1; // Data member
        const poin = selectedOption.data('poin') || 0; // Data poin

        if (userId) {
            // Simpan ID pengguna ke localStorage
            localStorage.setItem('selectedUserId', userId);

            // Set nilai pada input dan tampilkan
            $('#phoneNumber').val(phone);
            $('#emailAddress').val(email);
            $('#userDetails').removeClass('hidden');

            // Tampilkan poin jika user adalah member
            if (isMember) {
                $('#memberDetails').removeClass('hidden');
                $('#availablePoin').text(poin); // Tampilkan poin yang tersedia
                $('#poinUsed').attr('max', poin); // Batasi input poin hingga jumlah poin yang tersedia
            } else {
                $('#memberDetails').addClass('hidden');
                $('#availablePoin').text('0');
                $('#poinUsed').val('').attr('max', 0);
            }

            // Buat input nomor telepon editable jika nilainya adalah '-'
            if (phone === '-') {
                $('#phoneNumber').prop('readonly', false).addClass(
                    'border-blue-500 focus:ring-blue-500');
            } else {
                $('#phoneNumber').prop('readonly', true).removeClass(
                    'border-blue-500 focus:ring-blue-500');
            }
        } else {
            // Hapus data dari localStorage jika tidak ada pengguna yang dipilih
            localStorage.removeItem('selectedUserId');

            // Kosongkan dan sembunyikan input jika tidak ada pilihan
            $('#phoneNumber').val('').prop('readonly', true);
            $('#emailAddress').val('');
            $('#userDetails').addClass('hidden');

            // Sembunyikan detail member
            $('#memberDetails').addClass('hidden');
            $('#availablePoin').text('0');
            $('#poinUsed').val('').attr('max', 0);
        }
    });
});

    </script>



    <script>
        function showSection(sectionId, button) {
            // Hapus status aktif dari semua tab-link
            document.querySelectorAll('.tab-link').forEach((tab) => {
                tab.classList.remove('text-blue-600', 'border-blue-600');
                tab.classList.add('text-gray-600', 'border-transparent');
            });

            // Tambahkan status aktif ke tombol yang diklik
            if (button) {
                button.classList.add('text-blue-600', 'border-blue-600');
                button.classList.remove('text-gray-600', 'border-transparent');
            }

            // Sembunyikan semua konten tab
            document.querySelectorAll('.section').forEach((section) => {
                section.classList.add('hidden');
            });

            // Tampilkan konten tab yang dipilih
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
    <script>
        let cart = []; // Array untuk menyimpan produk yang dipilih
        const totalAmountInput = document.getElementById('totalAmount');
        const submitBtn = document.getElementById('confirmationModal'); // Tombol proses pembayaran
        const cartListContainer = document.getElementById('cartList');
        const cashAmountInput = document.getElementById('cashAmount'); // Input jumlah uang tunai
        const changeDisplay = document.getElementById('changeDisplay'); // Tampilan kembalian

        function saveCartToLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        function loadCartFromLocalStorage() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCartDisplay();
                updateTotal();
            }
        }

        function addToCart(productElement) {
            const productId = productElement.dataset.id; // Product ID
            const productName = productElement.dataset.name; // Product Name
            const productPrice = parseInt(productElement.dataset.price); // Product Price
            const productType = productElement.dataset.type; // Product Type
            const detailId = productElement.dataset.detailId; // Detail ID (unique variation)
            const productSize = productElement.dataset.size; // Product Size

            // Cari produk di keranjang berdasarkan product_id, detail_id, dan productType
            const existingProductIndex = cart.findIndex(
                (item) =>
                item.id == productId &&
                item.detailId == detailId && // Tambahkan pengecekan detailId
                item.type === productType
            );

            if (existingProductIndex !== -1) {
                // Jika produk sudah ada di keranjang, tambahkan kuantitas
                cart[existingProductIndex].quantity++;
            } else {
                // Jika produk belum ada, tambahkan sebagai item baru
                cart.push({
                    id: productId,
                    detailId: detailId, // Simpan detail ID
                    name: productName,
                    price: productPrice,
                    type: productType,
                    size: productSize, // Simpan ukuran produk (jika ada)
                    quantity: 1,
                });
            }

            updateCartDisplay();
            updateTotal();
            saveCartToLocalStorage();
        }


        function updateCartDisplay() {
            cartListContainer.innerHTML = "";

            cart.forEach((item, index) => {
                const productItem = document.createElement('div');
                productItem.className = "flex justify-between items-center border-b py-2";
                productItem.innerHTML = `
                <span>${index + 1}. ${item.name} (x${item.quantity})</span>
                <div class="flex items-center gap-2">
                    <span>Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                    <button onclick="removeFromCart('${item.id}', '${item.type}')" class="text-red-500 hover:underline">Kurangi</button>
                </div>
            `;
                cartListContainer.appendChild(productItem);
            });
        }

        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        function updateTotal() {
            // Hitung total belanja
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            console.log('Total sebelum format:', total);

            // Format total belanja untuk ditampilkan
            const formattedTotal = formatRupiah(total);
            console.log('Total setelah format:', formattedTotal);

            // Set tampilan dengan format Rupiah
            const totalAmountDisplay = document.getElementById('totalAmountDisplay');
            totalAmountDisplay.value = formattedTotal;

            // Set nilai mentah untuk pengiriman form
            const totalAmount = document.getElementById('totalAmount');
            totalAmount.value = total; // Hanya angka

            // Ambil jumlah uang tunai dari input
            const cashAmountInput = document.getElementById('cashAmount');
            const cashAmount = parseInt(cashAmountInput?.value) || 0;

            // Hitung kembalian
            const changeAmount = cashAmount - total;

            // Perbarui tampilan kembalian
            const changeDisplay = document.getElementById('changeDisplay');
            if (changeDisplay) {
                changeDisplay.textContent = `Rp ${changeAmount.toLocaleString('id-ID')}`;
                changeDisplay.classList.toggle('text-red-600', changeAmount < 0); // Warna merah jika negatif
                changeDisplay.classList.toggle('text-green-600', changeAmount >= 0); // Warna hijau jika positif
            }

            // Validasi tombol Proses Pembayaran
            const confirmPaymentButton = document.getElementById('confirmPaymentButton');
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;

            if (paymentMethod === 'cash') {
                // Jika metode pembayaran tunai
                confirmPaymentButton.disabled = changeAmount < 0 || cashAmount <= 0;
            } else {
                // Jika metode pembayaran non-tunai
                confirmPaymentButton.disabled = false;
            }

            console.log('Button Disabled:', confirmPaymentButton.disabled); // Debugging tombol
        }


        function removeFromCart(productId, productType) {
            console.log('Remove Product ID:', productId);
            console.log('Remove Product Type:', productType);
            console.log('Current Cart:', cart);

            const existingProductIndex = cart.findIndex(
                (item) => item.id == productId && item.type === productType
            );

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity--;

                if (cart[existingProductIndex].quantity <= 0) {
                    cart.splice(existingProductIndex, 1);
                }
            }

            console.log('Updated Cart:', cart);

            updateCartDisplay();
            updateTotal();
            saveCartToLocalStorage();
        }

        const paymentForm = document.getElementById('paymentForm');
        const cartInput = document.getElementById('cartInput');

        paymentForm.addEventListener('submit', function() {
            cartInput.value = JSON.stringify(cart);
        });

        document.addEventListener('DOMContentLoaded', () => {
            loadCartFromLocalStorage();

            // Event listener untuk memantau input jumlah tunai
            cashAmountInput.addEventListener('input', updateTotal);

            // Event listener untuk perubahan metode pembayaran
            document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'cash') {
                        cashAmountInput.disabled = false; // Aktifkan input uang tunai
                    } else {
                        cashAmountInput.disabled =
                            true; // Nonaktifkan input uang tunai jika Non-Tunai
                        cashAmountInput.value = ''; // Kosongkan input uang tunai
                    }
                    updateTotal(); // Perbarui status tombol
                });
            });
        });
    </script>




    <script>
        $(document).ready(function() {

            // Periksa status sidebar di localStorage
            if (localStorage.getItem('sidebarOpen') === 'true') {
                $('#sidebar').removeClass('-translate-x-full');
                $('#mainContent').addClass('pl-64').removeClass('pl-0');
            } else {
                $('#sidebar').addClass('-translate-x-full');
                $('#mainContent').addClass('pl-0').removeClass('pl-64');
            }

            // Sidebar Toggle
            $('#sidebarToggle').click(function() {
                const sidebar = $('#sidebar');
                const mainContent = $('#mainContent');

                if (sidebar.hasClass('-translate-x-full')) {
                    sidebar.removeClass('-translate-x-full');
                    mainContent.addClass('pl-64').removeClass('pl-0');
                    localStorage.setItem('sidebarOpen', 'true'); // Simpan status terbuka
                } else {
                    sidebar.addClass('-translate-x-full');
                    mainContent.addClass('pl-0').removeClass('pl-64');
                    localStorage.setItem('sidebarOpen', 'false'); // Simpan status tertutup
                }
            });

            // Fungsi format rupiah
            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }

            // Handle perubahan metode pembayaran
            $('input[name="payment_method"]').change(function() {
                if (this.value === 'cash') {
                    $('#cashInput').show();
                    $('#changeAmount').show();
                } else {
                    $('#cashInput').hide();
                    $('#changeAmount').hide();
                    $('#confirmationModal').prop('disabled', cart.length === 0);
                }
            });

            // Handle input jumlah uang tunai
            $('#cashAmount').on('input', function() {
                const totalAmount = parseInt($('#totalAmount').val()) || 0;
                const cashAmount = parseInt($(this).val()) || 0;
                const change = cashAmount - totalAmount;

                $('#changeDisplay').text(formatRupiah(change));
                $('#changeAmount').removeClass('hidden').addClass('block');

                if (change >= 0) {
                    $('#changeAmount').removeClass('bg-red-50').addClass('bg-green-50');
                    $('#changeDisplay').removeClass('text-red-600').addClass('text-green-600');
                    $('#confirmationModal').prop('disabled', false);
                } else {
                    $('#changeAmount').removeClass('bg-green-50').addClass('bg-red-50');
                    $('#changeDisplay').removeClass('text-green-600').addClass('text-red-600');
                    $('#confirmationModal').prop('disabled', true);
                }
            });

            // Handle submit form dengan AJAX
            $('#paymentForm').submit(function(e) {
                e.preventDefault();

                const formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('Pembayaran berhasil!');
                            // Reset form atau redirect sesuai kebutuhan
                            window.location.reload();
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>

</body>

</html>
