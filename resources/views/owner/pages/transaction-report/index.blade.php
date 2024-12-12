<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="owner/dashboard/assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Users</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('user/images/bg-logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="owner/dashboard/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="owner/dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="owner/dashboard/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="owner/dashboard/assets/js/config.js"></script>
    <!-- datatable CSS -->
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
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('owner.layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('owner.layouts.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Bootstrap Table -->
                        <!-- resources/views/owner/pages/users.blade.php -->
                        <!-- resources/views/owner/pages/products.blade.php -->
                        <div class="card">
                            <h3 class="card-header element-title text-uppercase pb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 400; color: #63374d;">Total Revenue</h3>
                            <div class="card-body">
                                <form method="GET" action="{{ route('transaction-report.index') }}">
                                    <label for="time_range">Filter Total Revenue:</label>
                                    <select name="time_range" id="time_range" class="form-control w-auto d-inline-block"
                                        onchange="this.form.submit()">
                                        <option value="daily" {{ request('time_range') == 'daily' ? 'selected' : '' }}>
                                            Daily</option>
                                        <option value="weekly"
                                            {{ request('time_range') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly"
                                            {{ request('time_range') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="yearly"
                                            {{ request('time_range') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                    <input type="hidden" name="invoice_filter"
                                        value="{{ request('invoice_filter', 'daily') }}">
                                    <input type="hidden" name="course_filter"
                                        value="{{ request('course_filter', 'daily') }}">
                                </form>


                                <div class="d-flex align-items-center mt-3">
                                    <i class="bx bx-money" style="font-size: 24px; color: green;"></i>
                                    <!-- Ikon uang -->
                                    <h4 class="mb-0 ms-2" style="font-weight: bold; color: green; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                                        Revenue: <span>Rp{{ number_format($totalAmount, 2) }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center" style="margin-left: -20px;">
                                <h3 class="card-header element-title text-uppercase pb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 400; color: #63374d;">Invoice Summary List</h3>
                                <h6>
                                    Total Invoice Summary:
                                    <span>
                                        <span style="font-size: 14px; color: black;">Rp</span>
                                        <strong
                                            style="font-size: 16px; color: black;">{{ number_format($invoiceTotal, 2) }}</strong>
                                    </span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <!-- Total Invoice -->
                                <div class="d-flex justify-content-between align-items-center mb-0">
                                </div>
                                <div class="mb-3">
                                    <form method="GET" action="{{ route('transaction-report.index') }}">
                                        <label for="invoice_filter">Filter Invoice:</label>
                                        <select name="invoice_filter" id="invoice_filter"
                                            class="form-control w-auto d-inline-block" onchange="this.form.submit()">
                                            <option value="daily"
                                                {{ request('invoice_filter') == 'daily' ? 'selected' : '' }}>Daily
                                            </option>
                                            <option value="weekly"
                                                {{ request('invoice_filter') == 'weekly' ? 'selected' : '' }}>Weekly
                                            </option>
                                            <option value="monthly"
                                                {{ request('invoice_filter') == 'monthly' ? 'selected' : '' }}>Monthly
                                            </option>
                                            <option value="yearly"
                                                {{ request('invoice_filter') == 'yearly' ? 'selected' : '' }}>Yearly
                                            </option>
                                        </select>
                                        <input type="hidden" name="time_range"
                                            value="{{ request('time_range', 'daily') }}">
                                        <input type="hidden" name="course_filter"
                                            value="{{ request('course_filter', 'daily') }}">
                                    </form>

                                </div>


                                <!-- Tabel Invoice Summary -->
                                <div class="table-responsive text-nowrap">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; font-weight: 700;">Invoice Code</th>
                                                <th style="text-align:center; font-weight: 700;">Order Date</th>
                                                <th style="text-align:center; font-weight: 700;">Order Status</th>
                                                <th style="text-align:center; font-weight: 700;">Cashier Name</th>
                                                <th style="text-align:center; font-weight: 700;">Recipient Name</th>
                                                <th style="text-align:center; font-weight: 700;">Recipient Email</th>
                                                <th style="text-align:center; font-weight: 700;">Recipient Phone</th>
                                                <th style="text-align:center; font-weight: 700;">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($invoices as $invoice)
                                                <tr>
                                                    <td style="text-align:center;">{{ $invoice->invoice_code }}</td>
                                                    <td style="text-align:center;">{{ $invoice->order_date }}</td>
                                                    <td style="text-align:center;">
                                                        <span
                                                            style="color: {{ $invoice->order_status == 'Complete' ? 'green' : 'red' }}">
                                                            {{ $invoice->order_status }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align:center;">{{ $invoice->cashier_name ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $invoice->recipient_name ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $invoice->recipient_email ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $invoice->recipient_phone ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ number_format($invoice->total_amount, 2) }}</td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <!-- Tambahan Tabel Course History -->
                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center" style="margin-left: -20px;">
                                <h3 class="card-header element-title text-uppercase pb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 400; color: #63374d;">Course History List</h3>
                                <h6>
                                    Total Course Summary:
                                    <span>
                                        <span style="font-size: 14px; color: grey;">Rp</span>
                                        <strong
                                            style="font-size: 16px; color: black;">{{ number_format($courseTotal, 2) }}</strong>
                                    </span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <!-- Total Invoice -->
                                <div class="mb-2 mt-0">
                                    <form method="GET" action="{{ route('transaction-report.index') }}">
                                        <label for="course_filter">Filter Course History:</label>
                                        <select name="course_filter" id="course_filter"
                                            class="form-control w-auto d-inline-block" onchange="this.form.submit()">
                                            <option value="daily"
                                                {{ request('course_filter') == 'daily' ? 'selected' : '' }}>Daily
                                            </option>
                                            <option value="weekly"
                                                {{ request('course_filter') == 'weekly' ? 'selected' : '' }}>Weekly
                                            </option>
                                            <option value="monthly"
                                                {{ request('course_filter') == 'monthly' ? 'selected' : '' }}>Monthly
                                            </option>
                                            <option value="yearly"
                                                {{ request('course_filter') == 'yearly' ? 'selected' : '' }}>Yearly
                                            </option>
                                        </select>
                                        <input type="hidden" name="time_range"
                                            value="{{ request('time_range', 'daily') }}">
                                        <input type="hidden" name="invoice_filter"
                                            value="{{ request('invoice_filter', 'daily') }}">
                                    </form>

                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table id="example" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; font-weight: 700;">Invoice Code</th>
                                                <th style="text-align:center; font-weight: 700;">Order Date</th>
                                                <th style="text-align:center; font-weight: 700;">Order Status</th>
                                                <th style="text-align:center; font-weight: 700;">Course Name</th>
                                                <th style="text-align:center; font-weight: 700;">Total Sessions</th>
                                                <th style="text-align:center; font-weight: 700;">Sessions Completed</th>
                                                <th style="text-align:center; font-weight: 700;">Course Price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($courseHistories as $history)
                                                <tr>
                                                    <td style="text-align:center;">{{ $history->invoice_code }}</td>
                                                    <td style="text-align:center;">{{ $history->order_date }}</td>
                                                    <td style="text-align:center;">
                                                        <span
                                                            style="color: {{ $history->order_status == 'Complete' ? 'green' : 'red' }}">
                                                            {{ $history->order_status }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align:center;">{{ $history->course_name ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $history->total_sessions ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $history->sessions_completed ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ number_format($history->course_price, 2) }}</td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>




                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl">
                                <div
                                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                    <div class="text-body">
                                        ©
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>
                                        <a href="" class="footer-link"> AveBeautySalon</a>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>

        <script>
            $('#example1').DataTable({
                order: [
                    [1, 'desc']
                ], // Mengurutkan berdasarkan kolom "Tanggal Pesanan" (kolom ke-5, karena indeks dimulai dari 0), urutan asc (ascending)
                columnDefs: [{
                    targets: 1, // Indeks kolom Tanggal Pesanan (dimulai dari 0)
                    type: 'date' // Mengatur DataTables untuk memperlakukan kolom ini sebagai tanggal
                }],
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'pdf',
                                orientation: 'landscape', // Orientasi landscape untuk tampilan lebar
                                pageSize: 'A4', // Ukuran halaman A4
                                customize: function(doc) {
                                    // Menyesuaikan lebar kolom sesuai kebutuhan
                                    doc.content[1].table.widths = ['15%', '15%', '10%', '10%', '10%', '20%',
                                        '10%', '10%'
                                    ];
                                }
                            },
                            'copy', 'excel', 'colvis'
                        ]
                    }
                }
            });
            $('#example').DataTable({
                order: [
                    [1, 'desc']
                ], // Mengurutkan berdasarkan kolom "Tanggal Pesanan" (kolom ke-5, karena indeks dimulai dari 0), urutan asc (ascending)
                columnDefs: [{
                    targets: 1, // Indeks kolom Tanggal Pesanan (dimulai dari 0)
                    type: 'date' // Mengatur DataTables untuk memperlakukan kolom ini sebagai tanggal
                }],
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'pdf',
                                orientation: 'landscape', // Orientasi landscape untuk tampilan lebar
                                pageSize: 'A4', // Ukuran halaman A4
                                customize: function(doc) {
                                    // Menyesuaikan lebar kolom sesuai kebutuhan
                                    doc.content[1].table.widths = ['10%', '10%', '10%', '25%', '15%', '15%',
                                        '15%'
                                    ];
                                }
                            },
                            'copy', 'excel', 'colvis'
                        ]
                    }
                }
            });
        </script>


        <script src="owner/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="owner/dashboard/assets/vendor/libs/popper/popper.js"></script>
        <script src="owner/dashboard/assets/vendor/js/bootstrap.js"></script>
        <script src="owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="owner/dashboard/assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="owner/dashboard/assets/js/main.js"></script>

        <!-- Page JS -->

        <!-- Place this tag before closing body tag for github widget button. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
