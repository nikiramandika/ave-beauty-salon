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
                            <h5 class="card-header">Daftar Products</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Products</h6>
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">Create
                                        Products</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Nama Produk</th>
                                                <th>Slug</th>
                                                <th>Harga</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Detail (Stok, Ukuran)</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($products as $product)
                                                <tr>
                                                    <td>
                                                        @if ($product->description && $product->description->product_image)
                                                            <img src="{{ asset($product->description->product_image) }}"
                                                                alt="Gambar Produk"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->product_slug }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ optional($product->category)->category_name ?? 'No Category' }}
                                                    </td>
                                                    <td>
                                                        @if ($product->description)
                                                            {{ $product->description->description }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($product->details)
                                                            Stok: {{ $product->details->product_stock }} <br>
                                                            Ukuran: {{ $product->details->size }} <br>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="color: {{ $product->is_active ? 'green' : 'red' }}">
                                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
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
                                                                <a href="javascript:void(0);"
                                                                    class="dropdown-item"
                                                                    onclick="viewProductDetails(this)"
                                                                    data-name="{{ $product->product_name }}"
                                                                    data-slug="{{ $product->product_slug }}"
                                                                    data-price="{{ $product->price }}"
                                                                    data-category="{{ optional($product->category)->category_name ?? 'No Category' }}"
                                                                    data-image="{{ asset($product->description->product_image ?? 'path/to/default/image.jpg') }}"
                                                                    data-description="{{ $product->description->description ?? '-' }}"
                                                                    data-stock="{{ $product->details->product_stock ?? 'N/A' }}"
                                                                    data-size="{{ $product->details->size ?? 'N/A' }}"
                                                                    data-status="{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}">
                                                                    <i class="bx bx-show-alt me-2"></i> Lihat
                                                                </a>


                                                                <a class="dropdown-item"
                                                                    href="{{ route('products.edit', $product->product_id) }}">
                                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                                </a>
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="confirmDelete('{{ $product->product_id }}', '{{ $product->product_name }}')">
                                                                    <i class="bx bx-trash me-2"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data produk</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>


                            </div>

                            <!--/ Basic Bootstrap Table -->

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
        <!-- Product Detail Modal -->
        <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewProductModalLabel">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalProductImage" src="" alt="Gambar Produk" class="img-fluid mb-2">
                        <p><strong>Nama:</strong> <span id="modalProductName"></span></p>
                        <p><strong>Slug:</strong> <span id="modalProductSlug"></span></p>
                        <p><strong>Harga:</strong> <span id="modalProductPrice"></span></p>
                        <p><strong>Kategori:</strong> <span id="modalProductCategory"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="modalProductDescription"></span></p>
                        <p><strong>Stok:</strong> <span id="modalProductStock"></span></p>
                        <p><strong>Ukuran:</strong> <span id="modalProductSize"></span></p>
                        <p><strong>Status:</strong> <span id="modalProductStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteProductModalLabel">Konfirmasi Hapus Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus produk <strong><span
                                    id="deleteProductName"></span></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteProductForm" method="POST">
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
            function viewProductDetails(button) {
                // Ambil data dari atribut button
                const name = button.getAttribute('data-name');
                const slug = button.getAttribute('data-slug');
                const price = button.getAttribute('data-price');
                const category = button.getAttribute('data-category');
                const image = button.getAttribute('data-image');
                const description = button.getAttribute('data-description');
                const stock = button.getAttribute('data-stock');
                const size = button.getAttribute('data-size');
                const status = button.getAttribute('data-status');

                // Set isi modal
                document.getElementById('modalProductImage').src = image;
                document.getElementById('modalProductName').textContent = name;
                document.getElementById('modalProductSlug').textContent = slug;
                document.getElementById('modalProductPrice').textContent = price;
                document.getElementById('modalProductCategory').textContent = category;
                document.getElementById('modalProductDescription').textContent = description;
                document.getElementById('modalProductStock').textContent = stock;
                document.getElementById('modalProductSize').textContent = size;
                document.getElementById('modalProductStatus').textContent = status;

                // Tampilkan modal
                new bootstrap.Modal(document.getElementById('viewProductModal')).show();
            }



            function confirmDelete(productId, productName) {
                // Set product name in the modal
                document.getElementById('deleteProductName').innerText = productName;

                // Update the form action with the product's delete route
                const form = document.getElementById('deleteProductForm');
                form.action = `/products/${productId}`; // Sesuaikan path jika perlu

                // Show the modal
                new bootstrap.Modal(document.getElementById('deleteProductModal')).show();
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
