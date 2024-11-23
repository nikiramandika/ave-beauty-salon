<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../path/to/datatables.min.js"></script>
    <!-- datatable CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.css">
    <!-- datatable js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>
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

        <div class="min-h-screen bg-gray-100 p-6">
            <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-6">Pesanan Online</h1>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table id="example" class="table table-striped">
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
                                                onchange="updateOrderStatus(this, '{{ $invoice->selling_invoice_id }}'); updateColor(this);">

                                                <option value="Pending"
                                                    {{ $invoice->order_status == 'Pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="Cancelled"
                                                    {{ $invoice->order_status == 'Cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>
                                                <option value="On Process"
                                                    {{ $invoice->order_status == 'On Process' ? 'selected' : '' }}>
                                                    On Process
                                                </option>
                                                <option value="Order Completed"
                                                    {{ $invoice->order_status == 'Order Completed' ? 'selected' : '' }}>
                                                    Order Completed
                                                </option>
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
                                                onclick="showPaymentProofModal('storage/{{ $invoice->recipient_file }}', '{{ $invoice->recipient_bank }}')">
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
            <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-6">Pesanan Online Refund</h1>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table id="example1" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Kode Faktur</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Penerima</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nomor Telepon</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Alamat</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Tanggal Pesanan</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Status Refund</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Alasan Refund</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">File User Refund</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">File Admin Refund</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refunds as $refund)
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->invoice_code }}</td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->recipient_name }}</td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->recipient_phone }}</td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->recipient_address }}</td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->order_date }}</td>

                                        <!-- Data Refund -->
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->refund->refund_status ?? 'N/A' }}
                                        </td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            {{ $refund->refund->refund_reason ?? 'N/A' }}
                                        </td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            @if ($refund->refund && $refund->refund->user_refund_file)
                                                <a href="{{ asset('storage/' . $refund->refund->user_refund_file) }}"
                                                    class="text-blue-600 underline" target="_blank">Lihat File</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                            @if ($refund->refund && $refund->refund->user_refund_file)
                                                <a href="{{ asset('storage/' . $refund->refund->user_refund_file) }}"
                                                    class="text-blue-600 underline" target="_blank">Lihat File</a>
                                            @else
                                                N/A
                                            @endif

                                            <!-- Form Upload File untuk Admin -->
                                            <form action="{{ route('refunds.upload', $refund->refunds->refund_id) }}"
                                                method="POST" enctype="multipart/form-data" class="mt-2">
                                                @csrf
                                                <input type="file" name="admin_refund_file"
                                                    class="block w-full text-sm text-gray-600 border-gray-300 rounded-md">
                                                <button type="submit"
                                                    class="bg-green-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-green-700">
                                                    Upload Bukti
                                                </button>
                                            </form>
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

</body>
<!-- Modal Bukti Pembayaran -->
<div id="paymentProofModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-md w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Bukti Pembayaran</h2>
        <div class="mb-6">
            <div class="mb-2">
                <span class="font-bold">Bank Transfer: </span><span class="font-italic" id="paymentProofBank"></span>
            </div>
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

<!-- DataTable -->
<script>
    $('#example').DataTable({
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });
    $('#example1').DataTable({
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });
</script>

<!-- Modal Bukti Pembayaran -->
<script>
    function showPaymentProofModal(fileUrl, bankName) {
        // Set src untuk image modal
        document.getElementById('paymentProofImage').src = fileUrl;
        // Set text untuk bank modal
        document.getElementById('paymentProofBank').textContent = bankName;

        // Tampilkan modal
        document.getElementById('paymentProofModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    document.getElementById('closePaymentProofButton').addEventListener('click', function() {
        document.getElementById('paymentProofModal').classList.add('hidden');
    });
</script>

<!-- Ubah Status order -->
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


<!-- Sidebar-->
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


<script>
    function updateColor(selectElement) {
        const colorMap = {
            'Pending': 'bg-yellow-100 text-yellow-700',
            'Cancelled': 'bg-red-100 text-red-700',
            'On Process': 'bg-blue-100 text-blue-700',
            'Order Completed': 'bg-green-100 text-green-700'
        };

        // Hapus semua kelas warna sebelumnya
        selectElement.classList.remove(...Object.values(colorMap).map(c => c.split(' ')[0]));

        // Tambahkan warna baru berdasarkan nilai yang dipilih
        const selectedValue = selectElement.value;
        const colorClass = colorMap[selectedValue];
        if (colorClass) {
            selectElement.classList.add(...colorClass.split(' '));
        }
    }

    // Terapkan warna saat halaman dimuat
    document.querySelectorAll('select').forEach(select => updateColor(select));
</script>