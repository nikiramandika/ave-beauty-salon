<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('owner/dashboard/assets/') }}" data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Users</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('Logo.png') }}" />

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

    <!-- Template customizer & Theme config files --><!-- Tambahkan jQuery di atas script Anda -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('owner/dashboard/assets/js/config.js') }}"></script>
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

                        <div class="card mt-4">
                            <h5 class="card-header">Detail Course Registration</h5>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Invoice Code</th> <!-- Menambahkan kolom untuk Invoice Code -->
                                                <th>Nama Course</th>
                                                <th>Nama Pengguna</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Sessions Completed</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>{{ $invoiceCode ?? '-' }}</td> <!-- Menampilkan invoice_code -->

                                                <!-- Nama Course -->
                                                <td>{{ $courseRegistration->course->course_name ?? '-' }}</td>

                                                <!-- Nama Pengguna -->
                                                <td>{{ $courseRegistration->user->nama_depan ?? '-' }}
                                                    {{ $courseRegistration->user->nama_belakang ?? '-' }}</td>

                                                <!-- Start Date -->
                                                <td>{{ $courseRegistration->start_date ?? '-' }}</td>

                                                <!-- End Date -->
                                                <td>{{ $courseRegistration->end_date ?? '-' }}</td>

                                                <!-- Sessions Completed -->
                                                <td>{{ $courseRegistration->sessions_completed ?? 0 }}</td>

                                                <!-- Status -->
                                                <td>
                                                    <span
                                                        class="badge {{ $courseRegistration->status == 'Registered' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($courseRegistration->status) }}
                                                    </span>
                                                </td>

                                                <!-- Invoice Code -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($invoice->order_status == 'Complete')
                            <!-- Tombol untuk Absensi +1 -->
                            <button type="button" class="btn btn-primary mt-4 mb-2"
                                id="updateSessionButtonPlus">Absensi +1</button>

                            <!-- Tombol untuk Absensi -1 -->
                            <button type="button" class="btn btn-warning mt-4 mb-2"
                                id="updateSessionButtonMinus">Absensi -1</button>
                        @endif

                        <div class="card mt-4">
                            <h5 class="card-header">Invoice Course Registration</h5>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Penerima</th>
                                                    <th>Email Penerima</th>
                                                    <th>Telepon Penerima</th>
                                                    <th>Alamat Penerima</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Gambar Bukti Pembayaran</th>
                                                    <!-- Menambahkan kolom untuk Gambar -->
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr>

                                                    <!-- Nama Penerima -->
                                                    <td>{{ $invoice->recipient_name ?? '-' }}</td>

                                                    <!-- Email Penerima -->
                                                    <td>{{ $invoice->recipient_email ?? '-' }}</td>

                                                    <!-- Telepon Penerima -->
                                                    <td>{{ $invoice->recipient_phone ?? '-' }}</td>

                                                    <!-- Alamat Penerima -->
                                                    <td>{{ $invoice->recipient_address ?? '-' }}</td>

                                                    <!-- Status Pembayaran -->
                                                    <td>
                                                        <span
                                                            class="badge {{ $invoice->order_status == 'Pending' ? 'bg-warning' : ($invoice->order_status == 'Complete' ? 'bg-success' : 'bg-danger') }}">
                                                            {{ ucfirst($invoice->order_status) }}
                                                        </span>
                                                    </td>

                                                    <!-- Gambar Bukti Pembayaran (Modal) -->
                                                    <td>
                                                        @if ($invoice->recipient_file)
                                                            <!-- Tombol untuk membuka modal -->
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#paymentProofModal">
                                                                Lihat Bukti Pembayaran
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="paymentProofModal"
                                                                tabindex="-1" aria-labelledby="paymentProofModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="paymentProofModalLabel">Bukti
                                                                                Pembayaran</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="{{ asset('/storage/' . $invoice->recipient_file) }}"
                                                                                alt="Bukti Pembayaran"
                                                                                class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex">
                                    <a class="btn btn-primary mt-4 mb-2 text-white"
                                    >View Invoice</a>
                                <a class="btn btn-warning mt-4 mb-2 text-white"
                                   >Download Invoice</a>
                                </div>
                            </div>
                        </div>


                @if ($invoice->order_status == 'Pending')
                    <!-- Tombol "Accepted" -->
                    <button type="button" class="btn btn-success mt-5" data-bs-toggle="modal"
                        data-bs-target="#acceptOrderModal">
                        Terima Pesanan
                    </button>
                @endif



                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- Modal Konfirmasi Terima Pesanan -->
    <div class="modal fade" id="acceptOrderModal" tabindex="-1" aria-labelledby="acceptOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptOrderModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menerima pesanan ini dan mengubah status menjadi
                    <strong>Complete</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="acceptOrderForm"
                        action="{{ route('invoice.updateStatus', $invoice->selling_invoice_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Complete">
                        <button type="submit" class="btn btn-primary">Ya, Terima Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        $('#updateSessionButtonPlus').click(function() {
            $.ajax({
                url: '/course-registration/' + {{ $courseRegistration->registration_id }} +
                    '/update-session-plus',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        alert("Sesi berhasil ditambahkan!");
                        location.reload(); // Reload halaman untuk memperbarui data
                    } else {
                        alert(response.error);
                    }
                }
            });
        });

        $('#updateSessionButtonMinus').click(function() {
            $.ajax({
                url: '/course-registration/' + {{ $courseRegistration->registration_id }} +
                    '/update-session-minus',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        alert("Sesi berhasil dikurangi!");
                        location.reload(); // Reload halaman untuk memperbarui data
                    } else {
                        alert(response.error);
                    }
                }
            });
        });
    </script>


    <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('owner/dashboard/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
