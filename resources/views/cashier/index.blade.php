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
                                <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer"
                                    data-id="{{ $product->product_id }}" data-name="{{ $product->product_name }}"
                                    data-price="{{ $product->price }}" data-type="product" onclick="addToCart(this)">
                                    <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $product->product_name }}" class="w-full h-32 object-cover">
                                    <div class="p-3">
                                        <h3 class="font-semibold">{{ $product->product_name }}</h3>
                                        <p class="text-green-600 font-bold">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">Stock: {{ $product->details->product_stock }}
                                        </p>
                                    </div>
                                </div>
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
                                    data-price="{{ $treatment->price }}" onclick="addToCart(this)">
                                    <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}"
                                        alt="{{ $treatment->treatment_name }}" class="w-full h-32 object-cover">
                                    <div class="p-3">
                                        <h3 class="font-semibold">{{ $treatment->treatment_name }}</h3>
                                        <p class="text-green-600 font-bold">Rp
                                            {{ number_format($treatment->price, 0, ',', '.') }}</p>
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
                                        <input type="radio" name="payment_method" id="cashless" value="cashless"
                                            class="form-radio h-4 w-4 text-blue-600">
                                        <label for="cashless" class="ml-2">Non-Tunai</label>
                                    </div>
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
                                <label for="userSelect" class="block text-sm font-medium text-gray-700">Pilih
                                    Pelanggan</label>
                                <select id="userSelect" class="w-full select2">
                                    <option value="">Pilih Pelanggan...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" data-phone="{{ $user->phone ?? '-' }}"
                                            data-email="{{ $user->email ?? '-' }}">
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



                            <!-- Tombol Submit -->
                            <button type="submit" id="submitBtn"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
                                disabled>
                                Proses Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
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

                // Set nilai pada input dan tampilkan
                $('#phoneNumber').val(phone);
                $('#emailAddress').val(email);
                $('#userDetails').removeClass('hidden');
            }

            // Event listener untuk perubahan dropdown
            $('#userSelect').on('change', function() {
                const selectedOption = $(this).find(':selected'); // Opsi yang dipilih
                const userId = $(this).val(); // ID pengguna yang dipilih
                const phone = selectedOption.data('phone') || '-';
                const email = selectedOption.data('email') || '-';

                if (userId) {
                    // Simpan ID pengguna ke localStorage
                    localStorage.setItem('selectedUserId', userId);

                    // Set nilai pada input dan tampilkan
                    $('#phoneNumber').val(phone);
                    $('#emailAddress').val(email);
                    $('#userDetails').removeClass('hidden');

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
        const submitBtn = document.getElementById('submitBtn');
        const cartListContainer = document.getElementById('cartList');

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
            const productId = productElement.dataset.id;
            const productName = productElement.dataset.name;
            const productPrice = parseInt(productElement.dataset.price);
            const productType = productElement.dataset.type;

            const existingProductIndex = cart.findIndex(
                (item) => item.id == productId && item.type === productType
            );

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    type: productType,
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
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            console.log('Total sebelum format:', total);

            // Format untuk tampilan
            const formattedTotal = formatRupiah(total);
            console.log('Total setelah format:', formattedTotal);

            // Set tampilan dengan format Rupiah
            const totalAmountDisplay = document.getElementById('totalAmountDisplay');
            totalAmountDisplay.value = formattedTotal;

            // Set nilai mentah untuk pengiriman form
            const totalAmount = document.getElementById('totalAmount');
            totalAmount.value = total; // Hanya angka
            submitBtn.disabled = cart.length === 0; // Nonaktifkan tombol jika keranjang kosong
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
                    $('#submitBtn').prop('disabled', cart.length === 0);
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
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#changeAmount').removeClass('bg-green-50').addClass('bg-red-50');
                    $('#changeDisplay').removeClass('text-green-600').addClass('text-red-600');
                    $('#submitBtn').prop('disabled', true);
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
