<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <link rel="icon" href="{{ asset('user/images/bg-logo.png') }}" type="image/x-icon">
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
        /* body::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: transparent;
        }

        body::-webkit-scrollbar {
            width: 12px;
            background-color: transparent;
        }

        body::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: rgb(31 41 55);
        } */
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

        <div class="min-h-screen bg-gray-100 p-6">
            
            <div class="container mx-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <!-- Bagian Kiri: Laporan Kasir -->
                    <h1 class="text-2xl font-bold">
                        Laporan Kasir - {{ \Carbon\Carbon::today('Asia/Jakarta')->toFormattedDateString() }}
                    </h1>
    
                    <!-- Bagian Kanan: Total Pendapatan -->
                    <div class="text-right">
                        <span class="text-lg font-bold">
                            Total Pendapatan Hari Ini:
                        </span>
                        <span class="text-xl font-semibold text-green-600">
                            Rp
                            {{ number_format($totalToday, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <!-- Total Pendapatan -->
                    <div class="mb-2">
                        <strong class="text-lg">Total Pendapatan Pesanan Offline Hari Ini:</strong>
                        <span class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($offlineOrders->sum('total_amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="example" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Kode Faktur</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Penerima</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Kasir</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nomor Telepon</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Tanggal Pesanan</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Status</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Produk/Treatment
                                    </th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offlineOrders as $order)
                                    @if ($order->recipient_address == 'Pesanan Offline' && $order->order_status == 'Complete')
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->invoice_code }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->recipient_name }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->cashier_name ?? '-' }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->recipient_phone }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->order_date }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->order_status }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                @foreach ($order->details as $detail)
                                                    <p>{{ $detail->product_name ?: $detail->treatment_name }}</p>
                                                @endforeach
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>


            <div class="container mx-auto p-6">
                {{-- <h1 class="text-2xl font-bold mb-6">Laporan Pesanan Online</h1> --}}
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <!-- Total Pendapatan -->
                    <div class="mb-2">
                        <strong class="text-lg">Total Pendapatan Pesanan Online Hari Ini:</strong>
                        <span class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($onlineOrders->where('order_status', '==', 'Complete')->sum('total_amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="example1" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Kode Faktur</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Penerima</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Kasir</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nomor Telepon</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Alamat</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Tanggal Pesanan</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Status</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Produk</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($onlineOrders as $order)
                                    @if ($order->order_status == 'Complete')
                                        <!-- Hanya tampilkan selain Cancelled -->
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->invoice_code }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->recipient_name }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->cashier_name ?? '-' }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->recipient_phone }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->recipient_address }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->order_date }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $order->order_status }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                @foreach ($order->details as $detail)
                                                    <p>{{ $detail->product_name }}</p>
                                                @endforeach
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

<script>
    $('#example').DataTable({
        layout: {
            topStart: {
                buttons: [{
                        extend: 'pdf',
                        orientation: 'landscape', // Orientasi landscape untuk tampilan lebar
                        pageSize: 'A4', // Ukuran halaman A4
                        customize: function(doc) {
                            // Menyesuaikan lebar kolom sesuai kebutuhan
                            doc.content[1].table.widths = ['10%', '10%', '10%', '10%', '10%', '10%', '30%', '10%'
                            ];
                        }
                    },
                    'copy', 'excel', 'colvis'
                ]
            }
        }
    });
    $('#example1').DataTable({
        layout: {
            topStart: {
                buttons: [{
                        extend: 'pdf',
                        orientation: 'landscape', // Orientasi landscape untuk tampilan lebar
                        pageSize: 'A4', // Ukuran halaman A4
                        customize: function(doc) {
                            // Menyesuaikan lebar kolom sesuai kebutuhan
                            doc.content[1].table.widths = ['10%', '10%', '10%', '10%', '10%', '10%',
                                '10%',
                                '15%', '15%'
                            ];
                        }
                    },
                    'copy', 'excel', 'colvis'
                ]
            }
        }
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
