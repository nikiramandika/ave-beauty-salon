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
    <link rel="icon" type="image/x-icon" href="Logo.png" />

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
                            <h5 class="card-header">Daftar Treatments</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Treatments</h6>
                                    <a href="{{ route('treatments.create') }}" class="btn btn-primary">Create
                                        Treatment</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Nama Treatment</th>
                                                <th>Slug</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                                <th>Durasi</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($treatments as $treatment)
                                                <tr>
                                                    <td>
                                                        @if ($treatment->description && $treatment->description->treatment_image)
                                                            <img src="{{ asset($treatment->description->treatment_image) }}"
                                                                alt="Gambar Treatment"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $treatment->treatment_name }}</td>
                                                    <td>{{ $treatment->treatment_slug }}</td>
                                                    <td>{{ $treatment->price }}</td>
                                                    <td>
                                                        @if ($treatment->description)
                                                            {{ $treatment->description->description }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($treatment->description)
                                                            {{ $treatment->description->duration }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="color: {{ $treatment->is_active ? 'green' : 'red' }}">
                                                            {{ $treatment->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="javascript:void(0);" class="dropdown-item"
                                                                    onclick="viewTreatmentDetails(this)"
                                                                    data-name="{{ $treatment->treatment_name }}"
                                                                    data-slug="{{ $treatment->treatment_slug }}"
                                                                    data-price="{{ $treatment->price }}"
                                                                    data-image="{{ asset($treatment->description->treatment_image ?? 'path/to/default/image.jpg') }}"
                                                                    data-description="{{ $treatment->description->description ?? '-' }}"
                                                                    data-duration="{{ $treatment->description->duration ?? 'N/A' }}"
                                                                    data-status="{{ $treatment->is_active ? 'Active' : 'Inactive' }}">
                                                                    <i class="bx bx-show-alt me-2"></i> Lihat
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="{{ route('treatments.edit', $treatment->treatment_id) }}">
                                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                                </a>
                                                                <!-- Tombol Delete -->
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="confirmDelete('{{ $treatment->treatment_id }}', '{{ $treatment->treatment_name }}')">
                                                                    <i class="bx bx-trash me-2"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data treatment</td>
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
        <!-- / Layout wrapper -->
        <!-- User Detail Modal -->
        <!-- Treatment Detail Modal -->
        <div class="modal fade" id="viewTreatmentModal" tabindex="-1" aria-labelledby="viewTreatmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewTreatmentModalLabel">Detail Treatment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalTreatmentImage" src="" alt="Gambar Treatment" class="img-fluid mb-2">
                        <p><strong>Nama:</strong> <span id="modalTreatmentName"></span></p>
                        <p><strong>Slug:</strong> <span id="modalTreatmentSlug"></span></p>
                        <p><strong>Harga:</strong> <span id="modalTreatmentPrice"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="modalTreatmentDescription"></span></p>
                        <p><strong>Durasi:</strong> <span id="modalTreatmentDuration"></span></p>
                        <p><strong>Status:</strong> <span id="modalTreatmentStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Delete Confirmation Modal for Treatment -->
        <div class="modal fade" id="deleteTreatmentModal" tabindex="-1" aria-labelledby="deleteTreatmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTreatmentModalLabel">Konfirmasi Hapus Treatment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus treatment <strong><span
                                    id="deleteTreatmentName"></span></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteTreatmentForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script>
            function viewTreatmentDetails(button) {
                // Retrieve data from button attributes
                const name = button.getAttribute('data-name');
                const slug = button.getAttribute('data-slug');
                const price = button.getAttribute('data-price');
                const image = button.getAttribute('data-image');
                const description = button.getAttribute('data-description');
                const duration = button.getAttribute('data-duration');
                const status = button.getAttribute('data-status');

                // Set modal content
                document.getElementById('modalTreatmentImage').src = image;
                document.getElementById('modalTreatmentName').textContent = name;
                document.getElementById('modalTreatmentSlug').textContent = slug;
                document.getElementById('modalTreatmentPrice').textContent = price;
                document.getElementById('modalTreatmentDescription').textContent = description;
                document.getElementById('modalTreatmentDuration').textContent = duration;
                document.getElementById('modalTreatmentStatus').textContent = status;

                // Show modal
                new bootstrap.Modal(document.getElementById('viewTreatmentModal')).show();
            }



            function confirmDelete(treatmentId, treatmentName) {
                // Set treatment name in the modal
                document.getElementById('deleteTreatmentName').innerText = treatmentName;

                // Update the form action with the treatment's delete route
                const form = document.getElementById('deleteTreatmentForm');
                form.action = `/treatments/${treatmentId}`; // Sesuaikan path jika perlu

                // Show the modal
                new bootstrap.Modal(document.getElementById('deleteTreatmentModal')).show();
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
