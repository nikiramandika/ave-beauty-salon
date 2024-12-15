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
                            <h3 class="card-header element-title text-uppercase pb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 400; color: #63374d;">Promos List</h3>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Promos</h5>
                                    <a href="{{ route('promos.create') }}" class="btn btn-primary">Create Promo</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center; font-weight: 700;">Image</th>
                                                <th style="text-align:center; font-weight: 700;">Promo Name</th>
                                                <th style="text-align:center; font-weight: 700;">Slug</th>
                                                <th style="text-align:center; font-weight: 700;">Original Price</th>
                                                <th style="text-align:center; font-weight: 700;">Promo Price</th>
                                                <th style="text-align:center; font-weight: 700;">Descriprion</th>
                                                <th style="text-align:center; font-weight: 700;">Status</th>
                                                <th style="text-align:center; font-weight: 700;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($promos as $promo)
                                                <tr>
                                                    <td style="text-align:center;">
                                                        @if ($promo->description && $promo->description->promo_image)
                                                            <img src="{{ asset($promo->description->promo_image) }}"
                                                                alt="Gambar Promo"
                                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center;">{{ $promo->promo_name }}</td>
                                                    <td style="text-align:center;">{{ $promo->promo_slug }}</td>
                                                    <td style="text-align:center;">Rp{{ number_format($promo->original_price, 0, ',', '.') }}</td>
                                                    <td style="text-align:center;">Rp{{ number_format($promo->promo_price, 0, ',', '.') }}</td>
                                                    <td style="min-width: 500px; word-wrap: break-word; white-space: normal; text-align:justify;">{{ $promo->description->description ?? '-' }}</td>
                                                    <td style="text-align:center;">
                                                        <span style="color: {{ $promo->is_active ? 'green' : 'red' }}">
                                                            {{ $promo->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <div class="dropdown px-5">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="javascript:void(0);" class="dropdown-item"
                                                                    onclick="viewPromoDetails(this)"
                                                                    data-name="{{ $promo->promo_name }}"
                                                                    data-slug="{{ $promo->promo_slug }}"
                                                                    data-original-price="{{ $promo->original_price }}"
                                                                    data-promo-price="{{ $promo->promo_price }}"
                                                                    data-image="{{ asset($promo->description->promo_image ?? 'path/to/default/image.jpg') }}"
                                                                    data-description="{{ $promo->description->description ?? '-' }}"
                                                                    data-status="{{ $promo->is_active ? 'Active' : 'Inactive' }}">
                                                                    <i class="bx bx-show-alt me-2"></i> View
                                                                </a>
                                                                <a href="{{ route('promos.edit', $promo->promo_id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                                </a>
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="confirmDelete('{{ $promo->promo_id }}', '{{ $promo->promo_name }}')">
                                                                    <i class="bx bx-trash me-2"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
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
        <!-- / Layout wrapper -->
        <!-- Promo Detail Modal -->
        <div class="modal fade" id="viewPromoModal" tabindex="-1" aria-labelledby="viewPromoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="viewPromoModalLabel">Promo Detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalPromoImage" src="" alt="Gambar Promo" class="img-fluid mb-2">
                        <p><strong>Promo Name:</strong> <span id="modalPromoName"></span></p>
                        <p><strong>Slug:</strong> <span id="modalPromoSlug"></span></p>
                        <p><strong>Original Price:</strong> <span id="modalPromoOriginalPrice"></span></p>
                        <p><strong>Promo Price:</strong> <span id="modalPromoPrice"></span></p>
                        <p><strong>Description:</strong> <span id="modalPromoDescription"></span></p>
                        <p><strong>Status:</strong> <span id="modalPromoStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Delete Confirmation Modal for Promo -->
        <div class="modal fade" id="deletePromoModal" tabindex="-1" aria-labelledby="deletePromoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePromoModalLabel">Delete Promo Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <strong><span id="deletePromoName"></span></strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form id="deletePromoForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
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

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script>
            function viewPromoDetails(element) {
                const name = element.getAttribute('data-name');
                const slug = element.getAttribute('data-slug');
                const originalPrice = element.getAttribute('data-original-price');
                const promoPrice = element.getAttribute('data-promo-price');
                const image = element.getAttribute('data-image');
                const description = element.getAttribute('data-description');
                const status = element.getAttribute('data-status');

                // Isi konten modal dengan data promo
                document.getElementById('modalPromoName').textContent = name;
                document.getElementById('modalPromoSlug').textContent = slug;
                document.getElementById('modalPromoOriginalPrice').textContent =
                    `Rp${parseInt(originalPrice).toLocaleString()}`;
                document.getElementById('modalPromoPrice').textContent = `Rp${parseInt(promoPrice).toLocaleString()}`;
                document.getElementById('modalPromoImage').src = image;
                document.getElementById('modalPromoDescription').textContent = description;
                document.getElementById('modalPromoStatus').textContent = status;

                // Tampilkan modal
                new bootstrap.Modal(document.getElementById('viewPromoModal')).show();
            }





            function confirmDelete(promoId, promoName) {
                // Set nama promo di dalam modal
                document.getElementById('deletePromoName').innerText = promoName;

                // Update action pada form dengan rute delete untuk promo
                const form = document.getElementById('deletePromoForm');
                form.action = `/promos/${promoId}`; // Sesuaikan path jika perlu

                // Tampilkan modal
                new bootstrap.Modal(document.getElementById('deletePromoModal')).show();
            }
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
