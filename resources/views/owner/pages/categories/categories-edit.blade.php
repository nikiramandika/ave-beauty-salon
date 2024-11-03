<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('owner/dashboard/assets/') }}" data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Update Category</title>
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
                            <h5 class="card-header">Update Category</h5>
                            <div class="card-body">
                                <form action="{{ route('categories.update', $category->category_id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="category_name"
                                            name="category_name"
                                            value="{{ old('category_name', $category->category_name) }}" required
                                            oninput="generateSlug()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="category_slug"
                                            name="category_slug"
                                            value="{{ old('category_slug', $category->category_slug) }}" required
                                            readonly>
                                    </div>

                                    <img class="mt-3" src="{{ asset($category->category_image) }}"
                                        alt="{{ $category->category_name }}" style="width: 100px;">
                                    <div class="my-3">
                                        <label for="category_image" class="form-label">Gambar Kategori</label>
                                        <input type="file" class="form-control" id="category_image"
                                            name="category_image" accept="image/*">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function generateSlug() {
            const nameInput = document.getElementById('category_name');
            const slugInput = document.getElementById('category_slug');
            const slug = nameInput.value.trim().toLowerCase()
                .replace(/[\s\W-]+/g, '-');
            slugInput.value = slug;
        }
    </script>

    <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/js/main.js') }}"></script>
</body>

</html>
