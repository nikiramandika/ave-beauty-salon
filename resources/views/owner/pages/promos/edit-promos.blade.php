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
    <style>
        .selectpicker {
            height: auto !important;
            min-height: 40px;
            /* Atur tinggi minimal sesuai kebutuhan */
            width: 100% !important;
            /* Memastikan lebar penuh */
        }

        .bootstrap-select .dropdown-toggle {
            display: flex;
            background-color: #ffffff;
            color: black align-items: center;
            /* Untuk menengahkan teks secara vertikal */
            padding-top: 10px;
            /* Sesuaikan padding atas */
            padding-bottom: 8px;
            /* Sesuaikan padding bawah */
            height: auto !important;
            min-height: 40px;
            width: 100% !important;
            text-align: left;
            /* Teks tetap di kiri */
        }

        .btn .filter-option-inner-inner {
            /* Memberikan jarak dari kiri */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        /* Menyembunyikan panah hanya jika ada kelas .hide-caret */
        .dropdown-toggle::after {
            content: none !important;
        }
    </style>



    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tambahkan ini di bagian <head> atau sebelum </body> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <!-- jQuery, Popper.js, dan Bootstrap JS (jika belum ada) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


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
                            <h3 class="card-header element-title text-uppercase pb-2" style="font-family: 'Montserrat', sans-serif; font-weight: 400; color: #63374d;">Edit Promo</h3>
                            <div class="card-body">
                                <form action="{{ route('promos.update', $promo->promo_id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="promo_name" class="form-label">Promo Name</label>
                                        <input type="text" class="form-control" id="promo_name" name="promo_name"
                                            value="{{ $promo->promo_name }}" required oninput="generateSlug()">
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="promo_slug"
                                            name="promo_slug" value="{{ $promo->promo_slug }}" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="treatments" class="form-label">Select Treatment</label>
                                        <select class="form-control selectpicker" id="treatments" name="treatments[]"
                                            title="Select Treatment" multiple required data-live-search="true"
                                            data-selected-text-format="count > 2" onchange="calculateOriginalPrice()">
                                            @if ($treatments->isEmpty())
                                                <option disabled>No active treatments</option>
                                            @else
                                                @foreach ($treatments as $treatment)
                                                    <option value="{{ $treatment->treatment_id }}"
                                                        data-price="{{ $treatment->price }}"
                                                        {{ in_array($treatment->treatment_id, $promo->treatments->pluck('treatment_id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $treatment->treatment_name }} -
                                                        Rp{{ number_format($treatment->price, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="original_price" class="form-label">Original Price</label>
                                        <input type="number" class="form-control" id="original_price"
                                            name="original_price" value="{{ $promo->original_price }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_price" class="form-label">Promo Price</label>
                                        <input type="number" class="form-control" id="promo_price" name="promo_price"
                                            value="{{ $promo->promo_price }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ $promo->start_date }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ $promo->end_date }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Activity Status</label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option value="1" {{ $promo->is_active == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ $promo->is_active == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_image" class="form-label">Promo Image</label>
                                        <input type="file" class="form-control" id="promo_image"
                                            name="promo_image" accept="image/*">
                                        @if ($promo->description && $promo->description->promo_image)
                                            <img src="{{ asset($promo->description->promo_image) }}"
                                                alt="Current Promo Image" class="mt-2" style="width: 150px;">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Promo Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ $promo->description ? $promo->description->description : '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update Promo</button>
                                        <a href="{{ route('promos.index') }}" class="btn btn-secondary">Back</a>
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
            const promoName = document.getElementById('promo_name').value;
            const slug = promoName
                .toLowerCase() // Convert to lowercase
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/[^\w\-]+/g, '') // Remove invalid characters
                .replace(/\-\-+/g, '-') // Replace multiple hyphens with single hyphen
                .replace(/^-+|-+$/g, ''); // Trim hyphens from start and end

            document.getElementById('promo_slug').value = slug;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker({
                style: 'btn-default',
                width: '100%'
            });
            $(document).ready(function() {
                $('#treatments').selectpicker({
                    selectedTextFormat: 'count > 2',
                    countSelectedText: '{0} items selected',
                    width: '100%'
                }).on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
                    // Cek apakah ada item yang dipilih
                    if ($(this).val().length > 0) {
                        $(this).closest('.bootstrap-select').addClass(
                            'hide-caret'); // Tambahkan kelas jika ada item terpilih
                    } else {
                        $(this).closest('.bootstrap-select').removeClass(
                            'hide-caret'); // Hapus kelas jika tidak ada item terpilih
                    }
                });
            });
        });
    </script>

    <script>
        function calculateOriginalPrice() {
            let total = 0;

            // Mengambil elemen-elemen option yang dipilih dan menjumlahkan harga
            document.querySelectorAll('#treatments option:checked').forEach(option => {
                const price = parseFloat(option.getAttribute('data-price')) ||
                    0; // Gunakan 0 jika data-price tidak valid
                total += price;
                console.log("Adding price:", price); // Debugging untuk memeriksa harga masing-masing option
            });

            // Memasukkan total ke dalam input original_price
            console.log("Total original price:", total); // Debugging untuk memastikan total sesuai
            document.getElementById('original_price').value = total.toFixed(2);
        }
    </script>



</body>

</html>
