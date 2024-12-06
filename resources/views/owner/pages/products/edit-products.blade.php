<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('owner/dashboard/assets/') }}" data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Create Category</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('user/images/bg-logo.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <style>
        .slug-input {
            background-color: #f5f5f5;
            /* Light gray background */
            color: #6c757d;
            /* Gray text color */
            cursor: not-allowed;
            /* Indicate that it's not editable */
        }
    </style>

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('owner.layouts.sidebar')

            <div class="layout-page">
                @include('owner.layouts.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <h5 class="card-header">Edit Product</h5>
                            <div class="card-body">
                                <form action="{{ route('products.update', $product->product_id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="{{ $product->product_name }}" required oninput="generateSlug()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="product_slug"
                                            name="product_slug" value="{{ $product->product_slug }}" required readonly>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Kategori</label>
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->category_id }}"
                                                        {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="is_active" class="form-label">Status Aktif</label>
                                            <select class="form-control" id="is_active" name="is_active">
                                                <option value="1" {{ $product->is_active ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>
                                                    Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="product_image" class="form-label">Gambar Produk</label>
                                        <input type="file" class="form-control" id="product_image"
                                            name="product_image" accept="image/*">
                                        @if ($product->description && $product->description->product_image)
                                            <img src="{{ asset($product->description->product_image) }}"
                                                alt="Gambar Produk"
                                                style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label">Deskripsi Produk</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $product->description->description ?? '' }}</textarea>
                                    </div>

                                    <!-- Section for Multiple Sizes -->
                                    <div id="size-section" class="mb-4">
                                        <label class="form-label">Detail Ukuran, Stok, dan Harga</label>
                                        @if ($product->details->count() > 0)
                                            @foreach ($product->details as $detail)
                                                <div class="size-row d-flex align-items-center mb-3">
                                                    <input type="text" class="form-control me-2" name="sizes[]"
                                                        value="{{ $detail->size }}"
                                                        placeholder="Ukuran (contoh: S, M, L)" required>
                                                    <input type="number" class="form-control me-2" name="stocks[]"
                                                        value="{{ $detail->product_stock }}" placeholder="Stok"
                                                        required>
                                                    <input type="number" class="form-control me-2" name="prices[]"
                                                        value="{{ $detail->price }}"
                                                        placeholder="Harga (contoh: 100000)" required>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeSizeRow(this)">
                                                        <i class="fas fa-minus"></i> Hapus
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <!-- Input kosong jika koleksi tidak ada -->
                                            <div class="size-row d-flex align-items-center mb-3">
                                                <input type="text" class="form-control me-2" name="sizes[]"
                                                    placeholder="Ukuran (contoh: S, M, L)" required>
                                                <input type="number" class="form-control me-2" name="stocks[]"
                                                    placeholder="Stok" required>
                                                <input type="number" class="form-control me-2" name="prices[]"
                                                    placeholder="Harga (contoh: 100000)" required>
                                                <button type="button" class="btn btn-success mb-3"
                                                    onclick="addSizeRow()">
                                                    <i class="fas fa-plus"></i> Tambah
                                                </button>
                                            </div>
                                        @endif

                                        <div class="d-flex align-items-center mt-3">
                                            <button type="button" class="btn btn-success" onclick="addSizeRow()">
                                                <i class="fas fa-plus"></i> Tambah Ukuran
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary w-100">Update Produk</button>
                                        <a href="{{ route('products.index') }}"
                                            class="btn btn-secondary w-100 mt-2">Kembali</a>
                                    </div>
                                </form>

                                <script>
                                    function addSizeRow() {
                                        const sizeSection = document.getElementById('size-section');
                                        const newRow = document.createElement('div');
                                        newRow.classList.add('size-row', 'd-flex', 'align-items-center', 'mb-3', 'mt-3');
                                        newRow.innerHTML = `
                                            <input type="text" class="form-control me-2" name="sizes[]" placeholder="Ukuran (contoh: S, M, L)" required>
                                            <input type="number" class="form-control me-2" name="stocks[]" placeholder="Stok" required>
                                            <input type="number" class="form-control me-2" name="prices[]" placeholder="Harga (contoh: 100000)" required>
                                            <button type="button" class="btn btn-danger" onclick="removeSizeRow(this)">
                                                <i class="fas fa-minus"></i> Hapus
                                            </button>
                                        `;
                                        sizeSection.appendChild(newRow);
                                    }

                                    function removeSizeRow(button) {
                                        const row = button.parentElement;
                                        row.remove();
                                    }
                                </script>



                            </div>
                        </div>

                    </div>

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
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/js/main.js') }}"></script>
    <script>
        function generateSlug() {
            const productName = document.getElementById('product_name').value;
            const slug = productName
                .toLowerCase() // Convert to lowercase
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/[^\w\-]+/g, '') // Remove invalid characters
                .replace(/\-\-+/g, '-') // Replace multiple hyphens with single hyphen
                .replace(/^-+|-+$/g, ''); // Trim hyphens from start and end

            document.getElementById('product_slug').value = slug;
        }
    </script>

</body>

</html>
