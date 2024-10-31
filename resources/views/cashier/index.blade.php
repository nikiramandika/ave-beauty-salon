<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kasir</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9y7RAz72KRguvVTQXMheb_NIKCPPmNts3Uw&s" type="image/png">
    @vite(['resources/css/app.css'])
    <style>
        .sidebar-closed {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar-open {
            transform: translateX(0);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<!-- component -->

<body class="bg-gray-100">
    <div class="flex h-screen">
        @include('cashier.components.sidebar')
        <!-- Konten Tengah - Produk -->
        <div class="flex-1 p-6 overflow-auto">
            <h2 class="text-2xl font-bold mb-4">Produk</h2>
            <div class="grid grid-cols-3 gap-4">
                <!-- Produk 1 -->
                <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="https://images-static.nykaa.com/media/catalog/product/6/d/6d9b3158901526406722_1.jpg?tr=w-500"
                        alt="Produk 1" class="w-full h-50 w-50object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 1</h3>
                    <p class="text-gray-600">Rp 50.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
                <!-- Produk 2 -->
                <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="https://www.inaura.co.id/wp-content/uploads/2016/03/Magia-Plex-no-4-jpg.webp"
                        alt="Produk 2" class="w-full h-50 w-50 object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 2</h3>
                    <p class="text-gray-600">Rp 75.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
                <!-- Produk 3 -->
                {{-- <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="/api/placeholder/200/200" alt="Produk 3" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 3</h3>
                    <p class="text-gray-600">Rp 100.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="/api/placeholder/200/200" alt="Produk 3" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 3</h3>
                    <p class="text-gray-600">Rp 100.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="/api/placeholder/200/200" alt="Produk 3" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 3</h3>
                    <p class="text-gray-600">Rp 100.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="bg-white p-4 rounded-3xl shadow">
                    <img src="/api/placeholder/200/200" alt="Produk 3" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="font-bold">Produk 3</h3>
                    <p class="text-gray-600">Rp 100.000</p>
                    <button class="mt-2 w-full bg-blue-500 text-white py-2 rounded-xl hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div> --}}
            </div>
        </div>

        <!-- Sidebar Kanan - Keranjang -->
        <div class="w-96 bg-white shadow-lg rounded-tl-3xl rounded-bl-3xl">
            <div class="p-4 h-full flex flex-col">
                <h2 class="text-xl font-bold mb-4">Keranjang</h2>

                <!-- Daftar Item -->
                <div class="flex-1 overflow-auto">
                    <!-- Item Keranjang -->
                    <div class="border-b py-2">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold">Produk 1</h4>
                                <p class="text-gray-600">Rp 50.000 x 1</p>
                            </div>
                            <button class="text-red-500 hover:text-red-700">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Total dan Pembayaran -->
                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between mb-2">
                        <span class="font-bold">Total:</span>
                        <span class="font-bold">Rp 50.000</span>
                    </div>

                    <!-- Input Pembayaran -->
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm text-gray-600">Uang Tunai</label>
                            <input type="number" class="w-full  p-2 rounded-xl mt-1"
                                placeholder="Masukkan jumlah uang">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600">Kembalian</label>
                            <input type="text" class="w-full border p-2 rounded-xl bg-gray-200 mt-1 mb-4" readonly
                                value="Rp 0">
                        </div>
                        <button class="w-full bg-green-500 text-white py-3 rounded-xl hover:bg-green-600 font-bold">
                            BAYAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
