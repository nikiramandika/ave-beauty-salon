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

    <link rel="stylesheet" href="{{ asset('owner/dashboard/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('owner/dashboard/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('owner/dashboard/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('owner/dashboard/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('owner/dashboard/assets/vendor/js/helpers.js') }}"></script>
    <!-- Template customizer & Theme config files -->
    <script src="{{ asset('owner/dashboard/assets/js/config.js') }}"></script>

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


                        <div class="card mt-4">
                            <div class="card-body">
                                <!-- Header Member Logs -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Member Logs</h6>
                                </div>

                                <!-- Tabel Member Logs -->
                                <div class="table-responsive text-nowrap">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Log Time</th>
                                                <th>User</th>
                                                <th>Membership Number</th>
                                                <th>Cashier</th>
                                                <th>Action Type</th>
                                                <th>Old Points</th>
                                                <th>New Points</th>
                                                <th>Is Active</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($logs as $log)
                                                <tr>
                                                    <td>{{ $log->log_time }}</td>
                                                    <td>{{ $log->user_first_name }} {{ $log->user_last_name }}</td> <!-- Nama User -->
                                                    <td>{{ $log->membership_number }}</td>
                                                    <td>{{ $log->cashier_first_name }} {{ $log->cashier_last_name }}</td> <!-- Nama Kasir -->
                                                    <td>
                                                        <span
                                                            style="color: {{ $log->action_type == 'add' ? 'green' : ($log->action_type == 'remove' ? 'red' : 'blue') }}">
                                                            {{ ucfirst($log->action_type) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $log->old_points ?? '-' }}</td>
                                                    <td>{{ $log->new_points ?? '-' }}</td>
                                                    <td>
                                                        <span style="color: {{ $log->is_active ? 'green' : 'red' }}">
                                                            {{ $log->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">No logs available</td>
                                                </tr>
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
            });
        </script>

        <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('owner/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('owner/dashboard/assets/vendor/js/menu.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('owner/dashboard/assets/js/main.js') }}"></script>

        <!-- GitHub Widget Button -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>