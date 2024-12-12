<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <link rel="icon" href="{{ asset('user/images/bg-logo.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../path/to/datatables.min.js"></script>
    <!-- datatable CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.css">
    <!-- datatable js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hidden {
            display: none;
        }

        .page-item.active .page-link, .page-item.active .page-link:hover, .page-item.active .page-link:focus,
        .pagination li.active > a:not(.page-link), .pagination li.active > a:not(.page-link):hover,
        .pagination li.active > a:not(.page-link):focus {
            border-color: #f36d9a;
            background-color: #f36d9a;
            color: #fff;
            box-shadow: 0 0.125rem 0.25rem #f6a5c0;
        }
        .pagination-sm .page-item + .page-item .page-link,
        .pagination-sm .pagination li + li > a:not(.page-link) {
            margin-left: 0.25rem;
        }

        .pagination-lg .page-item + .page-item .page-link,
        .pagination-lg .pagination li + li > a:not(.page-link) {
                margin-left: 0.5rem;
        }

        .pagination .page-link {
            border-color: transparent;
        }

        .page-link.btn-primary {
            box-shadow: none !important;
        }

        .pagination-lg .page-link,
        .pagination-lg > li > a:not(.page-link) {
            min-width: calc(2.8759615rem + calc(1px * 2));
            min-height: calc(2.8757925rem + calc(1px * 2));
        }

        .pagination-sm .page-link,
        .pagination-sm > li > a:not(.page-link) {
            min-width: calc(1.7509515rem + calc(1px * 2));
            min-height: calc(1.7501875rem + calc(1px * 2));
        }

        .pagination-sm > .page-item.first .page-link, .pagination-sm > .page-item.last .page-link,
        .pagination-sm > .page-item.next .page-link, .pagination-sm > .page-item.prev .page-link,
        .pagination-sm > .page-item.previous .page-link {
                padding: 0.211rem;
        }

        .pagination {
            --bs-pagination-padding-x: 0.5rem;
            --bs-pagination-padding-y: 0.4809rem;
            --bs-pagination-font-size: 0.9375rem;
            --bs-pagination-color: #384551;
            --bs-pagination-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-border-width: 1px;
            --bs-pagination-border-color: #ced1d5;
            --bs-pagination-border-radius: 50%;
            --bs-pagination-hover-color: #384551;
            --bs-pagination-hover-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-hover-border-color: #ced1d5;
            --bs-pagination-focus-color: #384551;
            --bs-pagination-focus-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-focus-box-shadow: none;
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: #696cff;
            --bs-pagination-active-border-color: #696cff;
            --bs-pagination-disabled-color: #384551;
            --bs-pagination-disabled-bg: rgba(34, 48, 62, 0.06);
            --bs-pagination-disabled-border-color: #ced1d5;
            display: flex;
            padding-left: 0;
            list-style: none;
        }

        .page-link {
            position: relative;
            display: block;
            padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
            font-size: var(--bs-pagination-font-size);
            color: var(--bs-pagination-color);
            background-color: var(--bs-pagination-bg);
            border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .page-link:hover {
            z-index: 2;
            color: var(--bs-pagination-hover-color);
            background-color: var(--bs-pagination-hover-bg);
            border-color: var(--bs-pagination-hover-border-color);
        }
        .page-link:focus {
            z-index: 3;
            color: var(--bs-pagination-focus-color);
            background-color: var(--bs-pagination-focus-bg);
            outline: 0;
            box-shadow: var(--bs-pagination-focus-box-shadow);
        }
        .page-link.active, .active > .page-link {
            z-index: 3;
            color: var(--bs-pagination-active-color);
        }
        .page-link.disabled, .disabled > .page-link {
            color: var(--bs-pagination-disabled-color);
            pointer-events: none;
        }
        .page-item:not(:first-child) .page-link {
            margin-left: 0.375rem;
        }
        .page-item .page-link {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }
        .pagination-lg {
            --bs-pagination-padding-x: 0.9826rem;
            --bs-pagination-padding-y: 0.681rem;
            --bs-pagination-font-size: 1.0625rem;
            --bs-pagination-border-radius: 50%;
        }
        .pagination-sm {
            --bs-pagination-padding-x: 0.269rem;
            --bs-pagination-padding-y: 0.3165rem;
            --bs-pagination-font-size: 0.8125rem;
            --bs-pagination-border-radius: 50%;
        }
  </style>

</head>

<body class="bg-pink-50">
    <!-- Navbar -->
    @include('cashier.components.navbar')

    <!-- Sidebar -->
    @include('cashier.components.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen pt-16 pl-64 transition-all duration-300">
        <div class="container ">

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="myTabContent">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl text-uppercase mb-6" style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">Manage Users and Members</h1>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active !text-pink-600 hover:!text-pink-500 active:!text-pink-600" id="user-tab" data-bs-toggle="tab"
                                    data-bs-target="#user" type="button" role="tab" aria-controls="user"
                                    aria-selected="true">
                                    Users
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link !text-pink-600 hover:!text-pink-500 active:!text-pink-600" id="member-tab" data-bs-toggle="tab" data-bs-target="#member"
                                    type="button" role="tab" aria-controls="member" aria-selected="false">
                                    Members
                                </button>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content mt-4">
                            <!-- Users Table -->
                            <div class="tab-pane fade show active" id="user" role="tabpanel"
                                aria-labelledby="user-tab">
                                <table id="userTable"
                                    class="table table-striped table-hover align-middle shadow-sm rounded-3 overflow-hidden font-montserrat font-light"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">User ID</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">First Name</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Last Name</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Email</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Phone</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center align-middle">{{ $user->id }}</td>
                                                <td class="text-center align-middle">{{ $user->nama_depan }}</td>
                                                <td class="text-center align-middle">{{ $user->nama_belakang }}</td>
                                                <td class="text-center align-middle">{{ $user->email }}</td>
                                                <td class="text-center align-middle">{{ $user->phone }}</td>
                                                <td class="text-center align-middle">
                                                    <!-- Add Member Form -->
                                                    <form id="addMemberForm" action="{{ route('members.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" id="userId"
                                                            value="">
                                                        <button type="button" class="btn btn-sm text-white bg-pink-400 hover:bg-pink-500 border border-pink-400 focus:ring-pink-500 focus:ring-2 rounded-md open-modal"
                                                            data-user-id="{{ $user->id }}">
                                                            Add to Member
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Members Table -->
                            <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                                <table id="memberTable"
                                    class="table table-striped table-hover align-middle shadow-sm rounded-3 overflow-hidden font-montserrat font-light"
                                    style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Membership Number</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">User Name</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Points</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Status</th>
                                            <th class="text-center align-middle text-sm  font-montserrat" style="text-transform: uppercase; font-weight: 700;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td class="text-center align-middle">{{ $member->membership_number }}</td>
                                                <td class="text-center align-middle">{{ $member->user->nama_depan }} {{ $member->user->nama_belakang }}
                                                </td>
                                                <td class="text-center align-middle">{{ $member->points }}</td>
                                                <td class="text-center align-middle">{{ $member->is_active ? 'Active' : 'Inactive' }}</td>
                                                <td class="text-center align-middle">
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-warning btn-sm edit-member "
                                                        data-id="{{ $member->member_id }}"
                                                        data-points="{{ $member->points }}"
                                                        data-status="{{ $member->is_active }}">
                                                        Edit
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('members.destroy', $member->member_id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- Delete Button -->
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm open-delete-modal"
                                                            data-member-id="{{ $member->member_id }}">
                                                            Remove
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal Delete Member -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove this member?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to add this user as a member?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAddMember">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Phone Modal -->
    <!-- Modal Update Phone -->
    <div class="modal fade" id="updatePhoneModal" tabindex="-1" aria-labelledby="updatePhoneModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="updatePhoneForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePhoneModalLabel">Update Phone Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="updatePhoneUserId">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary text-white bg-pink-400 hover:bg-pink-500 border border-pink-400 focus:ring-pink-500 focus:ring-2 rounded-md open-modal" id="savePhoneButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Confirm Phone -->
    <div class="modal fade" id="confirmPhoneModal" tabindex="-1" aria-labelledby="confirmPhoneModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="addMemberForm" action="{{ route('members.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="confirmUserId">
                    <input type="hidden" name="phone" id="confirmPhone">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmPhoneModalLabel">Confirm Phone Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Enter phone number: <strong id="displayPhone"></strong></p>
                        <p>Are you sure you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white bg-pink-400 hover:bg-pink-500 border border-pink-400 focus:ring-pink-500 focus:ring-2 rounded-md open-modal">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Member Modal -->
    <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editMemberForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="memberId" name="member_id">
                        <div class="mb-3">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" class="form-control" id="points" name="points" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>

                            <!-- Jika status aktif, tampilkan sebagai readonly -->
                            <input type="text" class="form-control" id="status" value="Active" readonly
                                style="display: none;">
                            <input type="hidden" name="is_active" value="1" id="is_active">

                            <!-- Jika status tidak aktif, tampilkan dropdown -->
                            <select class="form-select" id="status_select" name="is_active" style="display: none;">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white bg-pink-400 hover:bg-pink-500 border border-pink-400 focus:ring-pink-500 focus:ring-2 rounded-md open-modal">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Script Delete Member Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openDeleteModalButtons = document.querySelectorAll('.open-delete-modal');
            const deleteForm = document.getElementById('deleteForm');

            openDeleteModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const memberId = this.getAttribute('data-member-id'); // Ambil member ID
                    const actionUrl = `/members/${memberId}`; // Sesuaikan URL action form
                    deleteForm.setAttribute('action', actionUrl);

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    modal.show();
                });
            });
        });
    </script>

    <!-- Script untuk menampilkan modal konfirmasi add to member -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');
            const updatePhoneModal = new bootstrap.Modal(document.getElementById('updatePhoneModal'));
            const confirmPhoneModal = new bootstrap.Modal(document.getElementById('confirmPhoneModal'));

            const userIdInput = document.getElementById('updatePhoneUserId');
            const phoneInput = document.getElementById('phone');
            const confirmUserIdInput = document.getElementById('confirmUserId');
            const confirmPhoneInput = document.getElementById('confirmPhone');
            const displayPhoneElement = document.getElementById('displayPhone');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userPhone = this.closest('tr').querySelector('td:nth-child(5)')
                        .textContent.trim();

                    if (!userPhone || userPhone === 'null') {
                        // Phone is empty, open update phone modal
                        userIdInput.value = userId;
                        updatePhoneModal.show();
                    } else {
                        // Phone exists, go straight to confirm modal
                        confirmUserIdInput.value = userId;
                        confirmPhoneInput.value = userPhone;
                        displayPhoneElement.textContent = userPhone;
                        confirmPhoneModal.show();
                    }
                });
            });

            // Handle Save Phone Button
            document.getElementById('savePhoneButton').addEventListener('click', function() {
                const phoneValue = phoneInput.value.trim();
                if (phoneValue) {
                    // Pass phone data to confirm modal
                    confirmUserIdInput.value = userIdInput.value;
                    confirmPhoneInput.value = phoneValue;
                    displayPhoneElement.textContent = phoneValue;

                    // Close update phone modal and show confirm modal
                    updatePhoneModal.hide();
                    confirmPhoneModal.show();
                } else {
                    alert('Please enter a valid phone number.');
                }
            });
        });
    </script>

    <!-- Script untuk menyimpan tab aktif -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil tab terakhir dari localStorage
            const lastTab = localStorage.getItem('activeTab');

            if (lastTab) {
                // Aktifkan tab terakhir jika ditemukan
                const triggerEl = document.querySelector(`[data-bs-target="${lastTab}"]`);
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }

            // Simpan tab aktif ke localStorage setiap kali tab diubah
            document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(button => {
                button.addEventListener('shown.bs.tab', function(event) {
                    const activeTab = event.target.getAttribute('data-bs-target');
                    localStorage.setItem('activeTab', activeTab);
                });
            });
        });
    </script>
    <!-- Script untuk menampilkan modal edit member -->
    <script>
        $(document).ready(function() {
            $('.edit-member').on('click', function() {
                // Ambil data dari tombol
                const memberId = $(this).data('id');
                const points = $(this).data('points');
                const status = $(this).data('status');

                // Isi data ke modal
                $('#memberId').val(memberId);
                $('#points').val(points);

                // Set action form
                const url = `/members/${memberId}`;
                $('#editMemberForm').attr('action', url);

                // Cek status dan sesuaikan tampilan form
                if (status == 1) {
                    // Jika status "Active", sembunyikan dropdown dan tampilkan status readonly
                    $('#status').show(); // Tampilkan input readonly "Active"
                    $('#status_select').hide(); // Sembunyikan dropdown
                    $('#is_active').val(1); // Set hidden field is_active dengan nilai 1
                } else {
                    // Jika status "Inactive", tampilkan dropdown dan sembunyikan status readonly
                    $('#status').hide(); // Sembunyikan input readonly "Active"
                    $('#status_select').show(); // Tampilkan dropdown
                    $('#status_select').val(0); // Set dropdown value menjadi "Inactive"
                }

                // Tampilkan modal
                $('#editMemberModal').modal('show');
            });
        });
    </script>


    <!-- DataTables Script -->
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
            $('#memberTable').DataTable();
        });
    </script>
    <!-- Sidebar Script -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle logic
            if (localStorage.getItem('sidebarOpen') === 'true') {
                $('#sidebar').removeClass('-translate-x-full');
                $('#mainContent').addClass('pl-64').removeClass('pl-0');
            } else {
                $('#sidebar').addClass('-translate-x-full');
                $('#mainContent').addClass('pl-0').removeClass('pl-64');
            }

            $('#sidebarToggle').click(function() {
                const sidebar = $('#sidebar');
                const mainContent = $('#mainContent');

                if (sidebar.hasClass('-translate-x-full')) {
                    sidebar.removeClass('-translate-x-full');
                    mainContent.addClass('pl-64').removeClass('pl-0');
                    localStorage.setItem('sidebarOpen', 'true');
                } else {
                    sidebar.addClass('-translate-x-full');
                    mainContent.addClass('pl-0').removeClass('pl-64');
                    localStorage.setItem('sidebarOpen', 'false');
                }
            });

            // Initialize DataTables
            $('#userTable').DataTable();
            $('#memberTable').DataTable();

            // Tab navigation logic
            $('#myTab button').on('click', function(event) {
                var tab = new bootstrap.Tab(this);
                tab.show();
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
