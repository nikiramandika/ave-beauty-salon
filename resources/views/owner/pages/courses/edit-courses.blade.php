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
                            <h5 class="card-header">Edit Course</h5>
                            <div class="card-body">
                                <form action="{{ route('courses.update', $course->course_id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="course_name" class="form-label">Nama Course</label>
                                        <input type="text" class="form-control" id="course_name" name="course_name"
                                            value="{{ old('course_name', $course->course_name) }}" required
                                            oninput="generateSlug()">
                                    </div>

                                    <div class="mb-3">
                                        <label for="course_slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control slug-input" id="course_slug"
                                            name="course_slug" value="{{ old('course_slug', $course->course_slug) }}"
                                            required readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ old('price', $course->price) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sessions" class="form-label">Sessions</label>
                                        <input type="number" class="form-control" id="sessions" name="sessions"
                                            value="{{ old('sessions', $course->sessions) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status Aktif</label>
                                        <select class="form-control" id="is_active" name="is_active">
                                            <option value="1"
                                                {{ old('is_active', $course->is_active) == 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('is_active', $course->is_active) == 0 ? 'selected' : '' }}>
                                                Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="course_image" class="form-label">Gambar Course</label>
                                        <input type="file" class="form-control" id="course_image" name="course_image"
                                            accept="image/*">

                                        @if ($course->description && $course->description->course_image)
                                            <img src="{{ asset($course->description->course_image) }}"
                                                alt="Current Course Image" class="img-fluid mt-2" style="width: 150px;">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="benefits" class="form-label">Benefits</label>
                                        <textarea class="form-control" id="benefits" name="benefits">{{ old('benefits', $course->description->benefits ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="free_items" class="form-label">Free Items</label>
                                        <textarea class="form-control" id="free_items" name="free_items">{{ old('free_items', $course->description->free_items ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description', $course->description->description ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update Course</button>
                                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Kembali</a>
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

</body>

</html>
