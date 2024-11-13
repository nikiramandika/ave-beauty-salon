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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                            <h5 class="card-header">Create Promo</h5>
                            <div class="card-body">
                                <form action="{{ route('promos.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="promo_name" class="form-label">Nama Promo</label>
                                        <input type="text" class="form-control" id="promo_name" name="promo_name"
                                            required oninput="generateSlug()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="promo_slug"
                                            name="promo_slug" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="treatments" class="form-label">Pilih Treatment</label>
                                        <select class="form-control selectpicker" id="treatments" name="treatments[]"
                                            multiple required data-live-search="true">
                                            @foreach ($treatments as $treatment)
                                                <option value="{{ $treatment->treatment_id }}"
                                                    data-price="{{ $treatment->price }}">
                                                    {{ $treatment->treatment_name }} -
                                                    Rp{{ number_format($treatment->price, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="original_price" class="form-label">Harga Asli</label>
                                        <input type="number" class="form-control" id="original_price"
                                            name="original_price" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_price" class="form-label">Harga Promo</label>
                                        <input type="number" class="form-control" id="promo_price" name="promo_price"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Tanggal Berakhir</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status Aktif</label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_image" class="form-label">Gambar Promo</label>
                                        <input type="file" class="form-control" id="promo_image"
                                            name="promo_image" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi Promo</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Simpan Promo</button>
                                        <a href="{{ route('promos.index') }}" class="btn btn-secondary">Kembali</a>
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
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

            // Event listener ketika treatment dipilih
            $('#treatments').on('changed.bs.select', function() {
                let selectedTreatments = $(this).val();

                // Jika tidak ada treatment yang dipilih, reset harga original
                if (selectedTreatments.length === 0) {
                    $('#original_price').val(0);
                    return;
                }

                // Mengirim request ke server untuk menghitung total harga
                $.ajax({
                    url: '{{ route('promos.calculatePrice') }}', // Ganti dengan route yang sesuai
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        treatments: selectedTreatments
                    },
                    success: function(response) {
                        // Mengisi original_price dengan hasil yang diterima dari server
                        $('#original_price').val(response.total_price);
                    }
                });
            });
        });
    </script>


</body>

</html>
