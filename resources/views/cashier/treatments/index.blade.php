<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('cashier.components.navbar')

    <!-- Sidebar -->
    @include('cashier.components.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen pt-16 pl-64 transition-all duration-300">
        <div class="p-6 flex gap-6">
            <!-- Products Section -->
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Produk</h2>
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <!-- Product Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Product Card 1 -->
                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer">
                            <img src="/api/placeholder/200/150" alt="Product 1" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold">Nasi Goreng</h3>
                                <p class="text-green-600 font-bold">Rp 25.000</p>
                                <p class="text-sm text-gray-500">Stok: 50</p>
                            </div>
                        </div>
                        <!-- Product Card 2 -->
                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer">
                            <img src="/api/placeholder/200/150" alt="Product 2" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold">Mie Goreng</h3>
                                <p class="text-green-600 font-bold">Rp 23.000</p>
                                <p class="text-sm text-gray-500">Stok: 45</p>
                            </div>
                        </div>
                        <!-- Product Card 3 -->
                        <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md cursor-pointer">
                            <img src="/api/placeholder/200/150" alt="Product 3" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <h3 class="font-semibold">Es Teh</h3>
                                <p class="text-green-600 font-bold">Rp 5.000</p>
                                <p class="text-sm text-gray-500">Stok: 100</p>
                            </div>
                        </div>
                        <!-- Add more product cards as needed -->
                    </div>
                </div>
            </div>

            <!-- Cashier Section -->
            <div class="w-96">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-center mb-6">Kasir</h1>

                        <form id="paymentForm" action="{{ route('cashier.process') }}" method="POST">
                            @csrf
                            <!-- Total Belanja -->
                            <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700">Total Belanja</label>
                                <input type="number" name="total_amount" id="totalAmount"
                                    class="mt-1 block w-full text-3xl font-bold text-blue-600 bg-transparent border-none"
                                    value="150000" readonly>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
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
            // Sidebar Toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('-translate-x-full');
                $('#mainContent').toggleClass('pl-0 pl-64');
            });

            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }

            // Handle payment method change
            $('input[name="payment_method"]').change(function() {
                if (this.value === 'cash') {
                    $('#cashInput').show();
                    $('#changeAmount').show();
                } else {
                    $('#cashInput').hide();
                    $('#changeAmount').hide();
                    $('#submitBtn').prop('disabled', false);
                }
            });

            // Handle cash amount input
            $('#cashAmount').on('input', function() {
                const totalAmount = parseInt($('#totalAmount').val());
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

            // Handle form submission
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
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Silahkan coba lagi.');
                    }
                });
            });
        });
    </script>
</body>

</html>