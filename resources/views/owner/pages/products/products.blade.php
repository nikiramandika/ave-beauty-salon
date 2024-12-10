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
                            <h4 class="card-header">Products List</h4>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Products</h5>
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">Create
                                        Products</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Image</th>
                                                <th style="text-align:center;">Product Name</th>
                                                <th style="text-align:center;">Slug</th>
                                                <th style="text-align:center;">Category</th>
                                                <th style="text-align:center;">Description</th>
                                                <th style="text-align:center;">Product Detail</th>
                                                <th style="text-align:center;">Status</th>
                                                <th style="text-align:center;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($products as $product)
                                                <tr>
                                                    <!-- Gambar -->
                                                    <td>
                                                        @if ($product->description && $product->description->product_image)
                                                            <img src="{{ asset($product->description->product_image) }}"
                                                                alt="Gambar Produk"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <!-- Nama Produk -->
                                                    <td style="text-align:center;">{{ $product->product_name }}</td>

                                                    <!-- Slug -->
                                                    <td style="text-align:center;">{{ $product->product_slug }}</td>

                                                    <!-- Kategori -->
                                                    <td style="text-align:center;">{{ optional($product->category)->category_name ?? 'No Category' }}
                                                    </td>

                                                    <!-- Deskripsi -->
                                                    <td style="min-width: 500px; word-wrap: break-word; white-space: normal; text-align:justify;">
                                                        {{ $product->description->description ?? '-' }}
                                                    </td>

                                                    <!-- Detail Produk (Ukuran, Stok, Harga) -->
                                                    <td style="text-align:center;">
                                                        @if ($product->details->count() > 0)
                                                            @foreach ($product->details->take(2) as $detail)
                                                                <!-- Tampilkan hanya 2 data pertama -->
                                                                <div>
                                                                    <strong>Size:</strong> {{ $detail->size }} <br>
                                                                    <strong>Stock:</strong> {{ $detail->product_stock }}
                                                                    <br>
                                                                    <strong>Price:</strong>
                                                                    {{ number_format($detail->price, 2) }} <br>
                                                                    <hr>
                                                                </div>
                                                            @endforeach

                                                            <!-- Jika ada lebih dari 2, tampilkan tombol See More -->
                                                            @if ($product->details->count() > 2)
                                                                <button type="button" class="btn btn-link p-0"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#detailsModal-{{ $product->product_id }}">
                                                                    See More
                                                                </button>
                                                            @endif
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <!-- Status -->
                                                    <td style="text-align:center;">
                                                        <span
                                                            style="color: {{ $product->is_active ? 'green' : 'red' }}">
                                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>

                                                    <!-- Aksi -->
                                                    <td style="text-align:center;">
                                                        <div class="dropdown px-5">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <!-- Lihat -->
                                                                <a href="javascript:void(0);" class="dropdown-item"
                                                                    onclick="viewProductDetails(this)"
                                                                    data-name="{{ $product->product_name }}"
                                                                    data-slug="{{ $product->product_slug }}"
                                                                    data-category="{{ optional($product->category)->category_name ?? 'No Category' }}"
                                                                    data-image="{{ asset($product->description->product_image ?? 'path/to/default/image.jpg') }}"
                                                                    data-description="{{ $product->description->description ?? '-' }}"
                                                                    data-details='@json($product->details)'
                                                                    data-status="{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}">
                                                                    <i class="bx bx-show-alt me-2"></i> View
                                                                </a>

                                                                <!-- Edit -->
                                                                <a class="dropdown-item"
                                                                    href="{{ route('products.edit', $product->product_id) }}">
                                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                                </a>

                                                                <!-- Hapus -->
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
                                                    <td colspan="8" class="text-center">No product data</td>
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
                        <h4 class="modal-title" id="viewProductModalLabel">Product Detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalProductImage" src="" alt="Gambar Produk" class="img-fluid mb-2">
                        <p><strong>Name:</strong> <span id="modalProductName"></span></p>
                        <p><strong>Slug:</strong> <span id="modalProductSlug"></span></p>
                        <p><strong>Price:</strong> <span id="modalProductPrice"></span></p>
                        <p><strong>Category:</strong> <span id="modalProductCategory"></span></p>
                        <p><strong>Description:</strong> <span id="modalProductDescription"></span></p>
                        <p><strong>Stock:</strong> <span id="modalProductStock"></span></p>
                        <p><strong>Size:</strong> <span id="modalProductSize"></span></p>
                        <p><strong>Status:</strong> <span id="modalProductStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <h5 class="modal-title" id="deleteProductModalLabel">Delete Product Config</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <strong><span
                                    id="deleteProductName"></span></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteProductForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @isset($product)
            <!-- Modal untuk Detail Produk -->
            <div class="modal fade" id="detailsModal-{{ $product->product_id }}" tabindex="-1"
                aria-labelledby="detailsModalLabel-{{ $product->product_id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel-{{ $product->product_id }}">Detail Produk -
                                {{ $product->product_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($product->details as $detail)
                                <div>
                                    <strong>Size:</strong> {{ $detail->size }} <br>
                                    <strong>Stock:</strong> {{ $detail->product_stock }} <br>
                                    <strong>Price:</strong> {{ number_format($detail->price, 2) }} <br>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endisset



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
