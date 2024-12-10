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
                            <h4 class="card-header">Courses List</h4>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Courses</h5>
                                    <a href="{{ route('courses.create') }}" class="btn btn-primary">Create Course</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Image</th>
                                                <th style="text-align:center;">Course Name</th>
                                                <th style="text-align:center;">Slug</th>
                                                <th style="text-align:center;">Price</th>
                                                <th style="text-align:center;">Desctiption</th>
                                                <th style="text-align:center;">Sessions</th>
                                                <th style="text-align:center;">Benefits</th>
                                                <th style="text-align:center;">Status</th>
                                                <th style="text-align:center;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($courseDescriptions as $description)
                                                <tr>
                                                    <td style="text-align:center;">
                                                        @if ($description->course_image)
                                                            <img src="{{ asset($description->course_image) }}"
                                                                alt="Course Image"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center;">{{ $description->course->course_name ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $description->course->course_slug ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $description->course->price ?? '-' }}</td>
                                                    <td style="min-width: 500px; word-wrap: break-word; white-space: normal; text-align:justify;">{{ $description->description ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $description->course->sessions ?? '-' }}</td>
                                                    <td style="text-align:center;">{{ $description->benefits ?? '-' }}</td>
                                                    <td style="text-align:center;">
                                                        <span
                                                            style="color: {{ $description->course && $description->course->is_active ? 'green' : 'red' }}">
                                                            {{ $description->course && $description->course->is_active ? 'Active' : 'Inactive' }}
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
                                                                    onclick="viewCourseDetails(this)"
                                                                    data-name="{{ $description->course->course_name ?? '-' }}"
                                                                    data-slug="{{ $description->course->course_slug ?? '-' }}"
                                                                    data-price="{{ $description->course->price ?? '-' }}"
                                                                    data-image="{{ asset($description->course_image ?? 'path/to/default/image.jpg') }}"
                                                                    data-description="{{ $description->description ?? '-' }}"
                                                                    data-sessions="{{ $description->course->sessions ?? '-' }}"
                                                                    data-benefits="{{ $description->benefits ?? '-' }}"
                                                                    data-status="{{ $description->course && $description->course->is_active ? 'Active' : 'Inactive' }}">
                                                                    <i class="bx bx-show-alt me-2"></i> View
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="{{ route('courses.edit', $description->course->course_id ?? '') }}">
                                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                                </a>
                                                                <button type="button" class="dropdown-item"
                                                                    onclick="confirmDelete('{{ $description->course->course_id ?? '' }}', '{{ $description->course->course_name ?? '-' }}')">
                                                                    <i class="bx bx-trash me-2"></i> Delete
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data course</td>
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
        <!-- course Detail Modal -->
        <div class="modal fade" id="viewCourseModal" tabindex="-1" aria-labelledby="viewCourseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="viewCourseModalLabel">Course Detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalCourseImage" src="" alt="Course Image" class="img-fluid mb-2">
                        <p><strong>Name:</strong> <span id="modalCourseName"></span></p>
                        <p><strong>Slug:</strong> <span id="modalCourseSlug"></span></p>
                        <p><strong>Price:</strong> <span id="modalCoursePrice"></span></p>
                        <p><strong>Description:</strong> <span id="modalCourseDescription"></span></p>
                        <p><strong>Sessions:</strong> <span id="modalCourseSessions"></span></p>
                        <p><strong>Benefits:</strong> <span id="modalCourseBenefits"></span></p>
                        <p><strong>Status:</strong> <span id="modalCourseStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Delete Confirmation Modal for Course -->
        <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCourseModalLabel">Delete Course Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong><span
                                    id="deleteCourseName"></span></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteCourseForm" method="POST">
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
            function viewCourseDetails(button) {
                // Retrieve data from button attributes
                const name = button.getAttribute('data-name');
                const slug = button.getAttribute('data-slug');
                const price = button.getAttribute('data-price');
                const image = button.getAttribute('data-image');
                const description = button.getAttribute('data-description');
                const sessions = button.getAttribute('data-sessions');
                const benefits = button.getAttribute('data-benefits');
                const status = button.getAttribute('data-status');

                // Set modal content
                document.getElementById('modalCourseImage').src = image;
                document.getElementById('modalCourseName').textContent = name;
                document.getElementById('modalCourseSlug').textContent = slug;
                document.getElementById('modalCoursePrice').textContent = price;
                document.getElementById('modalCourseDescription').textContent = description;
                document.getElementById('modalCourseSessions').textContent = sessions;
                document.getElementById('modalCourseBenefits').textContent = benefits;
                document.getElementById('modalCourseStatus').textContent = status;

                // Show modal
                new bootstrap.Modal(document.getElementById('viewCourseModal')).show();
            }




            function confirmDelete(courseId, courseName) {
                // Set course name in the modal
                document.getElementById('deleteCourseName').innerText = courseName;

                // Update the form action with the course's delete route
                const form = document.getElementById('deleteCourseForm');
                form.action = `/courses/${courseId}`; // Adjust path if necessary

                // Show the modal
                new bootstrap.Modal(document.getElementById('deleteCourseModal')).show();
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
