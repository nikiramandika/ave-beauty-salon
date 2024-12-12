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
        .page-item.active .page-link, .page-item.active .page-link:hover, .page-item.active .page-link:focus,
        .pagination li.active > a:not(.page-link), .pagination li.active > a:not(.page-link):hover,
        .pagination li.active > a:not(.page-link):focus {
            border-color: #f36d9a;
            background-color: #f36d9a;
            color: #fff;
            box-shadow: 0 0.125rem 0.25rem #f6a5c0;
        }
        .pagination-sm .page-item + .page-item .page-link,
        .pagination-sm .pagination li + li > a:not(.page-link) {
            margin-left: 0.25rem;
        }

        .pagination-lg .page-item + .page-item .page-link,
        .pagination-lg .pagination li + li > a:not(.page-link) {
                margin-left: 0.5rem;
        }

        .pagination .page-link {
            border-color: transparent;
        }

        .page-link.btn-primary {
            box-shadow: none !important;
        }

        .pagination-lg .page-link,
        .pagination-lg > li > a:not(.page-link) {
            min-width: calc(2.8759615rem + calc(1px * 2));
            min-height: calc(2.8757925rem + calc(1px * 2));
        }

        .pagination-sm .page-link,
        .pagination-sm > li > a:not(.page-link) {
            min-width: calc(1.7509515rem + calc(1px * 2));
            min-height: calc(1.7501875rem + calc(1px * 2));
        }

        .pagination-sm > .page-item.first .page-link, .pagination-sm > .page-item.last .page-link,
        .pagination-sm > .page-item.next .page-link, .pagination-sm > .page-item.prev .page-link,
        .pagination-sm > .page-item.previous .page-link {
                padding: 0.211rem;
        }

        .pagination {
            --bs-pagination-padding-x: 0.5rem;
            --bs-pagination-padding-y: 0.4809rem;
            --bs-pagination-font-size: 0.9375rem;
            --bs-pagination-color: #384551;
            --bs-pagination-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-border-width: 1px;
            --bs-pagination-border-color: #ced1d5;
            --bs-pagination-border-radius: 50%;
            --bs-pagination-hover-color: #384551;
            --bs-pagination-hover-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-hover-border-color: #ced1d5;
            --bs-pagination-focus-color: #384551;
            --bs-pagination-focus-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-focus-box-shadow: none;
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: #696cff;
            --bs-pagination-active-border-color: #696cff;
            --bs-pagination-disabled-color: #384551;
            --bs-pagination-disabled-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-disabled-border-color: #ced1d5;
            display: flex;
            padding-left: 0;
            list-style: none;
        }

        .page-link {
            position: relative;
            display: block;
            padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
            font-size: var(--bs-pagination-font-size);
            color: var(--bs-pagination-color);
            background-color: var(--bs-pagination-bg);
            border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .page-link:hover {
            z-index: 2;
            color: var(--bs-pagination-hover-color);
            background-color: var(--bs-pagination-hover-bg);
            border-color: var(--bs-pagination-hover-border-color);
        }
        .page-link:focus {
            z-index: 3;
            color: var(--bs-pagination-focus-color);
            background-color: var(--bs-pagination-focus-bg);
            outline: 0;
            box-shadow: var(--bs-pagination-focus-box-shadow);
        }
        .page-link.active, .active > .page-link {
            z-index: 3;
            color: var(--bs-pagination-active-color);
        }
        .page-link.disabled, .disabled > .page-link {
            color: var(--bs-pagination-disabled-color);
            pointer-events: none;
        }
        .page-item:not(:first-child) .page-link {
            margin-left: 0.375rem;
        }
        .page-item .page-link {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }
        .pagination-lg {
            --bs-pagination-padding-x: 0.9826rem;
            --bs-pagination-padding-y: 0.681rem;
            --bs-pagination-font-size: 1.0625rem;
            --bs-pagination-border-radius: 50%;
        }
        .pagination-sm {
            --bs-pagination-padding-x: 0.269rem;
            --bs-pagination-padding-y: 0.3165rem;
            --bs-pagination-font-size: 0.8125rem;
            --bs-pagination-border-radius: 50%;
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

        <div class="min-h-screen bg-pink-50 p-6">

            <div class="container mx-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <!-- Bagian Kiri: Laporan Kasir -->
                    <h1 class="text-2xl text-uppercase" style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">
                        Cashier Report - {{ \Carbon\Carbon::today('Asia/Jakarta')->toFormattedDateString() }}
                    </h1>

                    <!-- Bagian Kanan: Total Pendapatan -->
                    <div class="text-right">
                        <span class="text-lg text-uppercase" style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">
                            Total Revenue Today:
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
                        <strong class="text-lg text-uppercase" style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">Total Offline Order Revenue Today: </strong>
                        <span class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($offlineOrders->sum('total_amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="example" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center align-middlefont-semibold text-sm text-gray-600">Invoice Code</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Recipient Name</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Cashier Name</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Phone Number</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Order Date</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Status</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Product/Treatment Name
                                    </th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offlineOrders as $order)
                                    @if ($order->recipient_address == 'Pesanan Offline' && $order->order_status == 'Complete')
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->invoice_code }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->recipient_name }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->cashier_name ?? '-' }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->recipient_phone }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->order_date }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->order_status }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                @foreach ($order->details as $detail)
                                                    <p>{{ $detail->product_name ?: $detail->treatment_name }}</p>
                                                @endforeach
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
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
                        <strong class="text-lg text-uppercase" style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">Total Online Order Revenue Today:</strong>
                        <span class="text-lg font-semibold text-green-600">
                            Rp {{ number_format($onlineOrders->where('order_status', '==', 'Complete')->sum('total_amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="example1" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Invoice Code</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Recipient Name</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Cashier Name</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Phone Number</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Adress</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Order Date</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Status</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Product Name</th>
                                    <th class="text-center align-middle font-semibold text-sm text-gray-600">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($onlineOrders as $order)
                                    @if ($order->order_status == 'Complete')
                                        <!-- Hanya tampilkan selain Cancelled -->
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->invoice_code }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->recipient_name }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->cashier_name ?? '-' }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->recipient_phone }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->recipient_address }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->order_date }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $order->order_status }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                @foreach ($order->details as $detail)
                                                    <p>{{ $detail->product_name }}</p>
                                                @endforeach
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
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
