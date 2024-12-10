<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="owner/dashboard/assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ave Beauty Salon - Members</title>
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

    <!-- Helpers -->
    <script src="owner/dashboard/assets/vendor/js/helpers.js"></script>
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
                        <div class="card">
                            <h5 class="card-header">Daftar Anggota</h5>
                            <div class="table-responsive text-nowrap">
                                <table id="example1" class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Membership Number</th>
                                            <th>Poin</th>
                                            <th>Tanggal Bergabung</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($members as $member)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span>{{ $member->user->nama_depan }}
                                                            {{ $member->user->nama_belakang }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $member->membership_number }}</td>
                                                <td>{{ $member->points }}</td>
                                                <td>{{ $member->joined_date->format('d M Y') }}</td>
                                                <td>
                                                    @if ($member->is_active)
                                                        <span class="badge bg-label-primary me-1">Active</span>
                                                    @else
                                                        <span class="badge bg-label-warning me-1">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown px-5">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="javascript:void(0);" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#memberDetailModal"
                                                                onclick="viewMemberDetail('{{ $member->user->nama_depan }} {{ $member->user->nama_belakang }}', '{{ $member->membership_number }}', '{{ $member->points }}', '{{ $member->joined_date }}', '{{ $member->is_active ? 'Active' : 'Inactive' }}')">
                                                                <i class="bx bx-show-alt me-2"></i> View
                                                            </a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('members.edit', $member->member_id) }}">
                                                                <i class="bx bx-edit-alt me-2"></i> Edit
                                                            </a>
                                                            <button type="button" class="dropdown-item"
                                                                onclick="confirmDelete('{{ $member->member_id }}', '{{ $member->user->nama_depan }} {{ $member->user->nama_belakang }}')">
                                                                <i class="bx bx-trash me-2"></i> Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data anggota</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $members->links() }}
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

    <!-- Member Detail Modal -->
    <div class="modal fade" id="memberDetailModal" tabindex="-1" aria-labelledby="memberDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberDetailModalLabel">Detail Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="modalMemberName"></span></p>
                    <p><strong>Membership Number:</strong> <span id="modalMembershipNumber"></span></p>
                    <p><strong>Poin:</strong> <span id="modalMemberPoints"></span></p>
                    <p><strong>Tanggal Bergabung:</strong> <span id="modalJoinedDate"></span></p>
                    <p><strong>Status:</strong> <span id="modalMemberStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus anggota <strong><span id="deleteMemberName"></span></strong>?
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="deleteMemberForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
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
    <script>
        function viewMemberDetail(name, membershipNumber, points, joinedDate, status) {
            document.getElementById('modalMemberName').innerText = name;
            document.getElementById('modalMembershipNumber').innerText = membershipNumber;
            document.getElementById('modalMemberPoints').innerText = points;
            document.getElementById('modalJoinedDate').innerText = joinedDate;
            document.getElementById('modalMemberStatus').innerText = status;
        }

        function confirmDelete(memberId, memberName) {
            document.getElementById('deleteMemberName').innerText = memberName;
            document.getElementById('deleteMemberForm').action = `/members/${memberId}`;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        }
    </script>

    <!-- Vendors JS -->
    <script src="owner/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="owner/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="owner/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="owner/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="owner/dashboard/assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="owner/dashboard/assets/js/main.js"></script>
</body>

</html>
