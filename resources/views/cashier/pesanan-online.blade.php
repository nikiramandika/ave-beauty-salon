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
            <div class="min-h-screen bg-gray-100 p-6">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold mb-6">Pesanan Online</h1>
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse border border-gray-200 rounded-xl overflow-hidden">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Kode Faktur</th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Penerima</th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Nomor Telepon</th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Alamat</th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Tanggal Pesanan
                                        </th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Status Pesanan
                                        </th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Detail Pesanan
                                        </th>
                                        <th class="text-left p-4 font-semibold text-sm text-gray-600">Bukti Pembayaran
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr class="hover:bg-gray-50">
                                            <!-- Data dari SellingInvoice -->
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->invoice_code }}</td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_name }}</td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_phone }}</td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_address }}</td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->order_date }}</td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                <select
                                                    class="border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                                                    data-previous-value="{{ $invoice->order_status }}"
                                                    onchange="updateOrderStatus(this, '{{ $invoice->selling_invoice_id }}')">

                                                    <option value="Pending"
                                                        {{ $invoice->order_status == 'Pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="Cancelled"
                                                        {{ $invoice->order_status == 'Cancelled' ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                    <option value="On Process"
                                                        {{ $invoice->order_status == 'On Process' ? 'selected' : '' }}>
                                                        On Process</option>
                                                    <option value="Order is being shipped"
                                                        {{ $invoice->order_status == 'Order is being shipped' ? 'selected' : '' }}>
                                                        Order is being shipped</option>
                                                    <option value="Order Completed"
                                                        {{ $invoice->order_status == 'Order Completed' ? 'selected' : '' }}>
                                                        Order Completed</option>
                                                </select>
                                            </td>

                                            <meta name="csrf-token" content="{{ csrf_token() }}">

                                            <!-- Data dari SellingInvoiceDetails -->
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                <ul>
                                                    @foreach ($invoice->details as $detail)
                                                        <li class="mb-2">
                                                            <strong>{{ $detail->product_name ?? $detail->treatment_name }}</strong>
                                                            -
                                                            {{ $detail->quantity }} x
                                                            Rp {{ number_format($detail->price, 2, ',', '.') }}
                                                            = Rp {{ number_format($detail->subtotal, 2, ',', '.') }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                <button
                                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                    onclick="showPaymentProofModal('storage/{{$invoice->recipient_file }}')">
                                                    Lihat Bukti
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Modal Bukti Pembayaran -->
<div id="paymentProofModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-md w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Bukti Pembayaran</h2>
        <div class="mb-6">
            <!-- Tempat untuk menampilkan file -->
            <img id="paymentProofImage" class="w-full rounded-md" src="" alt="Bukti Pembayaran">
        </div>
        <div class="flex justify-end">
            <button id="closePaymentProofButton"
                class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 hover:bg-gray-400">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-md w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi Perubahan</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengubah status menjadi <span id="selectedStatusText"
                class="font-bold text-blue-600"></span>?</p>
        <div class="flex justify-end gap-4">
            <button id="cancelButton"
                class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 hover:bg-gray-400">Batal</button>
            <button id="confirmButton" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Ya,
                Ubah</button>
        </div>
    </div>
</div>
<!-- Modal Notifikasi -->
<div id="notificationModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-md w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Status Diperbarui</h2>
        <p class="text-gray-600 mb-6">Status berhasil diperbarui menjadi <span id="updatedStatusText"
                class="font-bold text-blue-600"></span>.</p>
        <div class="flex justify-end">
            <button id="closeNotificationButton"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Tutup</button>
        </div>
    </div>
</div>

<script>
    function showPaymentProofModal(fileUrl) {
        // Set src untuk image modal
        document.getElementById('paymentProofImage').src = fileUrl;

        // Tampilkan modal
        document.getElementById('paymentProofModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    document.getElementById('closePaymentProofButton').addEventListener('click', function() {
        document.getElementById('paymentProofModal').classList.add('hidden');
    });
</script>

<script>
    let selectedElement = null;
    let selectedInvoiceId = null;

    function updateOrderStatus(selectElement, invoiceId) {
        // Simpan elemen yang dipilih dan ID faktur
        selectedElement = selectElement;
        selectedInvoiceId = invoiceId;

        // Ambil nilai status yang dipilih
        const selectedStatus = selectElement.value;

        // Tampilkan status di dalam modal
        document.getElementById('selectedStatusText').textContent = selectedStatus;

        // Tampilkan modal konfirmasi
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    // Fungsi untuk mengonfirmasi perubahan status
    document.getElementById('confirmButton').addEventListener('click', function() {
        const selectedStatus = selectedElement.value;

        fetch('{{ route('updateOrderStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    invoice_id: selectedInvoiceId,
                    order_status: selectedStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Sembunyikan modal konfirmasi
                    document.getElementById('confirmationModal').classList.add('hidden');

                    // Tampilkan modal notifikasi dengan status baru
                    document.getElementById('updatedStatusText').textContent = selectedStatus;
                    document.getElementById('notificationModal').classList.remove('hidden');
                } else {
                    alert('Terjadi kesalahan saat memperbarui status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status.');
            });
    });

    // Fungsi untuk membatalkan perubahan
    document.getElementById('cancelButton').addEventListener('click', function() {
        // Kembalikan nilai dropdown ke status sebelumnya
        selectedElement.value = selectedElement.dataset.previousValue;

        // Sembunyikan modal konfirmasi
        document.getElementById('confirmationModal').classList.add('hidden');
    });

    // Fungsi untuk menutup modal notifikasi
    document.getElementById('closeNotificationButton').addEventListener('click', function() {
        document.getElementById('notificationModal').classList.add('hidden');
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
    });
</script>
