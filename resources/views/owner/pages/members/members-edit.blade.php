<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('owner/dashboard/assets/') }}" data-template="vertical-menu-template-free"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Edit Member</title>
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

    <!-- Additional Custom CSS -->
    <link rel="stylesheet" href="{{ asset('owner/dashboard/assets/css/custom-styles.css') }}" />
    <!-- Your custom styles -->

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('owner/dashboard/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/js/config.js') }}"></script>

    <!-- Additional JavaScript Files -->
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script> <!-- jQuery -->
    <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script> <!-- Bootstrap JS -->
    <script src="{{ asset('owner/dashboard/assets/js/custom-scripts.js') }}"></script> <!-- Your custom scripts -->
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
                            <h5 class="card-header">Edit Anggota</h5>
                            <div class="card-body">
                                <form action="{{ route('members.update', $member->member_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Nama Depan</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ $member->user->nama_depan }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Nama Belakang</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ $member->user->nama_belakang }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="membership_number" class="form-label">Membership Number</label>
                                        <input type="text" class="form-control" id="membership_number"
                                            name="membership_number" value="{{ $member->membership_number }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="points" class="form-label">Poin</label>
                                        <input type="number" class="form-control" id="points" name="points"
                                            value="{{ $member->points }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="joined_date" class="form-label">Tanggal Bergabung</label>
                                        <input type="date" class="form-control" id="joined_date" name="joined_date"
                                            value="{{ $member->joined_date->format('Y-m-d') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select class="form-select" id="is_active" name="is_active" required>
                                            <option value="1" {{ $member->is_active ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ !$member->is_active ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update Anggota</button>
                                        <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
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

    <script src="{{ asset('owner/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('owner/dashboard/assets/js/main.js') }}"></script>

</body>

</html>
