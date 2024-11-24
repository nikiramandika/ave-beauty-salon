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
                            <h5 class="card-header">Create Treatment</h5>
                            <div class="card-body">
                                <form action="{{ route('treatments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="treatment_name" class="form-label">Nama Treatment</label>
                                        <input type="text" class="form-control" id="treatment_name" name="treatment_name" required oninput="generateSlug()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="treatment_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="treatment_slug" name="treatment_slug" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Harga</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="price_option" id="fixed_price" value="fixed" checked onclick="togglePriceInput()">
                                                <label class="form-check-label" for="fixed_price">
                                                    Harga Tetap
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="price_option" id="variable_price" value="variable" onclick="togglePriceInput()">
                                                <label class="form-check-label" for="variable_price">
                                                    Harga Variatif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="price_input_container">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga">
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status Aktif</label>
                                        <select class="form-select" id="is_active" name="is_active">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="treatment_image" class="form-label">Gambar Treatment</label>
                                        <input type="file" class="form-control" id="treatment_image" name="treatment_image" accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi Treatment</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Durasi (menit)</label>
                                        <input type="number" class="form-control" id="duration" name="duration" placeholder="Masukkan durasi dalam menit" required>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-primary">Simpan Treatment</button>
                                        <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                                
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
        function togglePriceInput() {
            const fixedPriceRadio = document.getElementById('fixed_price');
            const priceInputContainer = document.getElementById('price_input_container');
    
            if (fixedPriceRadio.checked) {
                // Show price input
                priceInputContainer.style.display = 'block';
                document.getElementById('price').required = true;
            } else {
                // Hide price input and clear value
                priceInputContainer.style.display = 'none';
                document.getElementById('price').value = '';
                document.getElementById('price').required = false;
            }
        }
    
        // Initialize the form state
        togglePriceInput();
    </script>
    <script>
        function generateSlug() {
            const treatmentName = document.getElementById('treatment_name').value;
            const slug = treatmentName
                .toLowerCase() // Convert to lowercase
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/[^\w\-]+/g, '') // Remove invalid characters
                .replace(/\-\-+/g, '-') // Replace multiple hyphens with single hyphen
                .replace(/^-+|-+$/g, ''); // Trim hyphens from start and end

            document.getElementById('treatment_slug').value = slug;
        }
    </script>

</body>

</html>
