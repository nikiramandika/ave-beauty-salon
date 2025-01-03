<!DOCTYPE html>
<html lang="id">

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

        .page-item.active .page-link,
        .page-item.active .page-link:hover,
        .page-item.active .page-link:focus,
        .pagination li.active>a:not(.page-link),
        .pagination li.active>a:not(.page-link):hover,
        .pagination li.active>a:not(.page-link):focus {
            border-color: #f36d9a;
            background-color: #f36d9a;
            color: #fff;
            box-shadow: 0 0.125rem 0.25rem #f6a5c0;
        }

        .pagination-sm .page-item+.page-item .page-link,
        .pagination-sm .pagination li+li>a:not(.page-link) {
            margin-left: 0.25rem;
        }

        .pagination-lg .page-item+.page-item .page-link,
        .pagination-lg .pagination li+li>a:not(.page-link) {
            margin-left: 0.5rem;
        }

        .pagination .page-link {
            border-color: transparent;
        }

        .page-link.btn-primary {
            box-shadow: none !important;
        }

        .pagination-lg .page-link,
        .pagination-lg>li>a:not(.page-link) {
            min-width: calc(2.8759615rem + calc(1px * 2));
            min-height: calc(2.8757925rem + calc(1px * 2));
        }

        .pagination-sm .page-link,
        .pagination-sm>li>a:not(.page-link) {
            min-width: calc(1.7509515rem + calc(1px * 2));
            min-height: calc(1.7501875rem + calc(1px * 2));
        }

        .pagination-sm>.page-item.first .page-link,
        .pagination-sm>.page-item.last .page-link,
        .pagination-sm>.page-item.next .page-link,
        .pagination-sm>.page-item.prev .page-link,
        .pagination-sm>.page-item.previous .page-link {
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

        .page-link.active,
        .active>.page-link {
            z-index: 3;
            color: var(--bs-pagination-active-color);
        }

        .page-link.disabled,
        .disabled>.page-link {
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-pink-50">
    <!-- Navbar -->
    @include('cashier.components.navbar')

    <!-- Sidebar -->
    @include('cashier.components.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="min-h-screen pt-16 pl-64 transition-all duration-300">

        <div class="min-h-screen bg-pink-50 p-6">
            <div class="container mx-auto p-6">
                <h1 class="text-2xl text-uppercase mb-6"
                    style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">Online Order</h1>
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="overflow-x-auto">
                        <table id="example" class="table table-striped w-full table-fixed font-montserrat font-light">
                            <thead class="bg-gray-50">
                                <tr class="align-middle text-center">
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Invoice Code</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Recipient Name</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Phone Number</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-64"
                                        style="text-transform: uppercase; font-weight: 700;">Address</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Order Date</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Status</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Action</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Payment Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    @if ($invoice->order_status != 'Cancelled')
                                        <!-- Hanya tampilkan selain Cancelled -->
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->invoice_code }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->recipient_name }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->recipient_phone }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->recipient_address }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->order_date }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                {{ $invoice->order_status }}
                                            </td>
                                            <td
                                                class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                                <div>
                                                    @if ($invoice->order_status == 'Pending')
                                                        <button
                                                            class="bg-orange-400 text-white px-4 py-2 mb-2 rounded-md hover:bg-orange-500 w-full"
                                                            onclick="changeOrderStatus('{{ $invoice->selling_invoice_id }}', 'On Process')">
                                                            On Process
                                                        </button>
                                                        <button
                                                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 w-full"
                                                            onclick="openCancelModal('{{ $invoice->selling_invoice_id }}')">
                                                            Cancelled
                                                        </button>
                                                    @elseif ($invoice->order_status == 'On Process')
                                                        <button
                                                            class="bg-green-500 text-white px-4 py-2 mb-2 rounded-md hover:bg-green-700 w-full"
                                                            onclick="changeOrderStatus('{{ $invoice->selling_invoice_id }}', 'Order Shipped')">
                                                            Order Shipped
                                                        </button>
                                                        <button
                                                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 w-full"
                                                            onclick="openCancelModal('{{ $invoice->selling_invoice_id }}')">
                                                            Cancelled
                                                        </button>
                                                    @elseif ($invoice->order_status == 'Order Shipped')
                                                        <span class="text-gray-500">Waiting for order to be
                                                            received</span>
                                                    @elseif ($invoice->order_status == 'Complete')
                                                        <span class="text-gray-500">Order Received</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                <button
                                                    class="bg-pink-400 text-white px-4 py-2 rounded-md hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2"
                                                    onclick="showPaymentProofModal('storage/{{ $invoice->recipient_file }}', '{{ $invoice->recipient_bank }}', {{ $invoice->total_price }})">
                                                    View Receipt
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <!-- Tabel Baru untuk Pesanan Cancelled -->
                <h1 class="text-2xl font-bold mb-6">Pesanan Cancelled</h1>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table id="cancelledTable" class="table table-striped">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Kode Faktur</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nama Penerima</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Nomor Telepon</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Alamat</th>
                                    <th class="text-left p-4 font-semibold text-sm text-gray-600">Tanggal Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    @if ($invoice->order_status == 'Cancelled')
                                        <!-- Hanya tampilkan Cancelled -->
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->invoice_code }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_name }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_phone }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->recipient_address }}
                                            </td>
                                            <td class="p-4 border-b border-gray-200 text-sm text-gray-700">
                                                {{ $invoice->order_date }}
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>

            <div class="container mx-auto p-6">
                <h1 class="text-2xl text-uppercase mb-6"
                    style="font-family: 'Montserrat', sans-serif; font-weight: 500; color: #63374d;">Online Order Refund
                </h1>
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table id="example1" class="table table-striped w-full table-fixed font-montserrat font-light">
                            <thead class="bg-gray-50 align-middle">
                                <tr>
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Invoice Code</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Recipient Name</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Phone Number</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-64"
                                        style="text-transform: uppercase; font-weight: 700;">Address</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Order Date</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Refund Status</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-48"
                                        style="text-transform: uppercase; font-weight: 700;">Refund Reason</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">User Refund File</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Admin Refund File</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-32"
                                        style="text-transform: uppercase; font-weight: 700;">Action</th>
                                    <th class="text-center align-middle text-sm  font-montserrat w-40"
                                        style="text-transform: uppercase; font-weight: 700;">Admin Refund File Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refunds as $refund)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->invoice_code }}</td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->recipient_name }}</td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->recipient_phone }}</td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->recipient_address }}</td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->order_date }}</td>

                                        <!-- Data Refund -->
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->refunds->refund_status ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            {{ $refund->refunds->refund_reason ?? 'N/A' }}
                                        </td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            @if ($refund->refunds && $refund->refunds->user_refund_file)
                                                <a href="{{ asset('storage/' . $refund->refunds->user_refund_file) }}"
                                                    class="text-pink-600 underline" target="_blank">View File</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            @if ($refund->refunds->admin_refund_file)
                                                <a href="{{ asset('storage/' . $refund->refunds->admin_refund_file) }}"
                                                    class="text-pink-600 underline" target="_blank">View File</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            <div>
                                                @if ($refund->refunds->refund_status == 'Pending')
                                                    <button
                                                        class="bg-blue-600 text-white px-4 py-2 mb-2 rounded-md hover:bg-blue-700 w-full"
                                                        onclick="changeRefundStatus('{{ $refund->refund_id }}', 'Refund on Process')">
                                                        Accepted
                                                    </button>
                                                    <button
                                                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 w-full"
                                                        onclick="changeRefundStatus('{{ $refund->refund_id }}', 'Cancelled')">
                                                        Cancelled
                                                    </button>
                                                @elseif ($refund->refunds->refund_status == 'Refund on Process')
                                                    <button
                                                        class="bg-green-500 text-white px-4 py-2 mb-2 rounded-md hover:bg-green-700 w-full"
                                                        onclick="changeRefundStatus('{{ $refund->refund_id }}', 'Refund Success')">
                                                        Refund Success
                                                    </button>
                                                    <button
                                                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 w-full"
                                                        onclick="changeRefundStatus('{{ $refund->refund_id }}', 'Cancelled')">
                                                        Cancelled
                                                    </button>
                                                @elseif ($refund->refunds->refund_status == 'Refund Success')
                                                    <span class="text-gray-500">Refund Success</span>
                                                @elseif ($refund->refunds->refund_status == 'Cancelled')
                                                    <span class="text-gray-500">Cancelled</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td
                                            class="p-4 border-b border-gray-200 text-sm text-gray-700 text-center align-middle">
                                            @if ($refund->refunds->refund_status == 'Refund on Process')
                                                <form
                                                    action="{{ route('refunds.upload', $refund->refunds->refund_id) }}"
                                                    method="POST" enctype="multipart/form-data" class="mt-2">
                                                    @csrf
                                                    <input type="file" name="admin_refund_file"
                                                        class="block w-full text-sm text-gray-600 border-gray-300 rounded-md">
                                                    <button type="submit"
                                                        class="bg-green-500 text-white px-4 py-2 rounded-md mt-2 hover:bg-green-700">
                                                        Upload Receipt
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">No Action</span>
                                            @endif
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

</body>
<!-- Modal Bukti Pembayaran -->

<!-- Modal untuk Alasan dan Bukti Pengembalian -->
<div id="cancelModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h3 class="text-xl mb-4">Cancellation Reason and Refund Proof</h3>

        <!-- Form -->
        <form action="{{ route('updateOrderStatus') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="invoiceId" name="invoice_id">
            <input type="hidden" name="order_status" value="Refund">

            <div class="mb-4">
                <label for="refundReason" class="block text-sm font-medium text-gray-700">Cancellation Reason</label>
                <textarea id="refundReason" name="refundReason" rows="4" class="w-full border-gray-300 rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label for="refundFile" class="block text-sm font-medium text-gray-700">Refund Proof</label>
                <input type="file" id="refundFile" name="refundFile" class="w-full border-gray-300 rounded-md"
                    required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-pink-400 text-white px-4 py-2 rounded-md hover:bg-pink-500">Send
                    Refund</button>
                <button type="button" onclick="closeCancelModal()"
                    class="ml-2 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Close</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal Bukti Pembayaran -->
<div id="paymentProofModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl shadow-md w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Payment Receipt</h2>
        <div class="mb-6">
            <div class="mb-2">
                <span class="font-bold">Bank Transfer: </span><span class="font-italic" id="paymentProofBank"></span>
            </div>
            <div class="mb-2">
                <span class="font-bold">Total Price: </span><span id="paymentProofTotal"></span>
            </div>
            <!-- Tempat untuk menampilkan file -->
            <img id="paymentProofImage" class="w-full rounded-md" src="" alt="Bukti Pembayaran">
        </div>
        <div class="flex justify-end">
            <button id="closePaymentProofButton"
                class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 hover:bg-gray-400">Close</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center"
    style="z-index: 100000;">
    <div class="bg-white rounded-md shadow-lg p-6">
        <p class="mb-4 text-gray-700">Are you sure you want to change the status to <span id="selectedStatusText"
                class="font-bold"></span>?</p>
        <div class="flex justify-end">
            <button id="confirmButton"
                class="bg-pink-400 text-white px-4 py-2 rounded-md mr-2 hover:bg-pink-500">Confirm</button>
            <button id="cancelButton" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
        </div>
    </div>
</div>

<!-- Modal Notifikasi -->
<div id="notificationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center"
    style="z-index: 100000;">
    <div class="bg-white rounded-md shadow-lg p-6">
        <p class="text-gray-700">Status successfully changed to <span id="updatedStatusText"
                class="font-bold"></span>.</p>
        <div class="flex justify-end">
            <button id="closeNotificationButton"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Close</button>
        </div>
    </div>
</div>
<script>
    function openCancelModal(invoiceId) {
        // Set ID faktur di form
        document.getElementById('invoiceId').value = invoiceId;

        // Tampilkan modal cancel
        document.getElementById('cancelModal').classList.remove('hidden');
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
    }
</script>
<!-- DataTable -->
<script>
    $('#example').DataTable({
        order: [
            [4, 'desc']
        ], // Mengurutkan berdasarkan kolom "Tanggal Pesanan" (kolom ke-5, karena indeks dimulai dari 0), urutan asc (ascending)
        columnDefs: [{
            targets: 4, // Indeks kolom Tanggal Pesanan (dimulai dari 0)
            type: 'date' // Mengatur DataTables untuk memperlakukan kolom ini sebagai tanggal
        },
        {
            targets: 7, // Indeks kolom ke-7
            width: "200px" // Menetapkan lebar kolom menjadi 200px (sesuai kebutuhan)
        }
    ],
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });

    $('#example1').DataTable({
        order: [
            [4, 'desc'] // Mengurutkan berdasarkan kolom "Tanggal Pesanan"
        ],
        columnDefs: [{
                targets: 4, // Indeks kolom Tanggal Pesanan
                type: 'date' // Mengatur kolom ini sebagai tipe tanggal
            },
            {
                targets: 9, // Indeks kolom ke-7
                width: "200px" // Menetapkan lebar kolom menjadi 200px (sesuai kebutuhan)
            }
        ],
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });
</script>

<!-- Modal Bukti Pembayaran -->
<script>
    function showPaymentProofModal(fileUrl, bankName, totalPrice) {
        console.log('Modal function triggered'); // Tambahkan ini

        // Set src untuk image modal
        document.getElementById('paymentProofImage').src = fileUrl;
        // Set text untuk bank modal
        document.getElementById('paymentProofBank').textContent = bankName;
        document.getElementById('paymentProofTotal').textContent =
            `Rp ${new Intl.NumberFormat('id-ID').format(totalPrice)}`;

        // Tampilkan modal
        document.getElementById('paymentProofModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    document.getElementById('closePaymentProofButton').addEventListener('click', function() {
        document.getElementById('paymentProofModal').classList.add('hidden');
    });
</script>

<!-- Ubah Status order -->
<script>
    let selectedElement = null;
    let selectedInvoiceId = null;

    function changeOrderStatus(invoiceId, status) {
        // Tampilkan modal konfirmasi
        document.getElementById('selectedStatusText').textContent = status;
        document.getElementById('confirmationModal').classList.remove('hidden');

        // Tambahkan event listener pada tombol konfirmasi
        document.getElementById('confirmButton').onclick = function() {
            // Kirim permintaan ke server untuk memperbarui status
            fetch('{{ route('updateOrderStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        invoice_id: invoiceId,
                        order_status: status,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Perbarui tampilan UI (reload halaman atau ubah status di tabel)
                        location.reload();
                    } else {
                        alert('Gagal memperbarui status.');
                    }
                })
                .catch(error => {
                    // console.error('Error:', error);
                    // alert('Terjadi kesalahan saat memperbarui status.');
                    // Perbarui tampilan UI (reload halaman atau ubah status di tabel)
                    location.reload();
                });

            // Tutup modal konfirmasi
            document.getElementById('confirmationModal').classList.add('hidden');
        };

        // Batalkan perubahan status
        document.getElementById('cancelButton').onclick = function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        };
    }


    // Fungsi untuk mengonfirmasi perubahan status
    document.getElementById('confirmButton').addEventListener('click', function() {
        const selectedStatus = selectedElement.value;

        fetch('{{ route('updateOrderStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    invoice_id: selectedInvoiceId,
                    order_status: selectedStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Sembunyikan modal konfirmasi
                    document.getElementById('confirmationModal').classList.add('hidden');

                    // Tampilkan modal notifikasi dengan status baru
                    document.getElementById('updatedStatusText').textContent = selectedStatus;
                    document.getElementById('notificationModal').classList.remove('hidden');
                } else {
                    alert('Terjadi kesalahan saat memperbarui status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status.');
            });
    });

    // Fungsi untuk membatalkan perubahan
    document.getElementById('cancelButton').addEventListener('click', function() {
        // Kembalikan nilai dropdown ke status sebelumnya
        selectedElement.value = selectedElement.dataset.previousValue;

        // Sembunyikan modal konfirmasi
        document.getElementById('confirmationModal').classList.add('hidden');
    });

    // Fungsi untuk menutup modal notifikasi
    document.getElementById('closeNotificationButton').addEventListener('click', function() {
        document.getElementById('notificationModal').classList.add('hidden');
    });
</script>


<!-- Sidebar-->
<script>
    $(document).ready(function() {
        // Periksa status sidebar di localStorage
        if (localStorage.getItem('sidebarOpen') === 'true') {
            $('#sidebar').removeClass('-translate-x-full');
            $('#mainContent').addClass('pl-64').removeClass('pl-0');
        } else {
            $('#sidebar').addClass('-translate-x-full');
            $('#mainContent').addClass('pl-0').removeClass('pl-64');
        }

        // Sidebar Toggle
        $('#sidebarToggle').click(function() {
            const sidebar = $('#sidebar');
            const mainContent = $('#mainContent');

            if (sidebar.hasClass('-translate-x-full')) {
                sidebar.removeClass('-translate-x-full');
                mainContent.addClass('pl-64').removeClass('pl-0');
                localStorage.setItem('sidebarOpen', 'true'); // Simpan status terbuka
            } else {
                sidebar.addClass('-translate-x-full');
                mainContent.addClass('pl-0').removeClass('pl-64');
                localStorage.setItem('sidebarOpen', 'false'); // Simpan status tertutup
            }
        });
    });
</script>


<script>
    function updateColor(selectElement) {
        const colorMap = {
            'Pending': 'bg-yellow-100 text-yellow-700',
            'Cancelled': 'bg-red-100 text-red-700',
            'On Process': 'bg-blue-100 text-blue-700',
            'Order Completed': 'bg-green-100 text-green-500'
        };

        // Hapus semua kelas warna sebelumnya
        selectElement.classList.remove(...Object.values(colorMap).map(c => c.split(' ')[0]));

        // Tambahkan warna baru berdasarkan nilai yang dipilih
        const selectedValue = selectElement.value;
        const colorClass = colorMap[selectedValue];
        if (colorClass) {
            selectElement.classList.add(...colorClass.split(' '));
        }
    }

    // Terapkan warna saat halaman dimuat
    document.querySelectorAll('select').forEach(select => updateColor(select));

    function changeRefundStatus(refundId, status) {
        // Tampilkan modal konfirmasi
        document.getElementById('selectedStatusText').textContent = status;
        document.getElementById('confirmationModal').classList.remove('hidden');

        // Tambahkan event listener pada tombol konfirmasi
        document.getElementById('confirmButton').onclick = function() {
            // Kirim permintaan ke server untuk memperbarui status refund
            fetch('{{ route('updateRefundStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        refund_id: refundId,
                        refund_status: status,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Perbarui tampilan UI (reload halaman atau ubah status di tabel)
                        location.reload();
                    } else {
                        // Tampilkan pesan error yang lebih spesifik
                        alert('Gagal memperbarui status refund: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status refund.');
                });

            // Tutup modal konfirmasi
            document.getElementById('confirmationModal').classList.add('hidden');
        };

        // Batalkan perubahan status
        document.getElementById('cancelButton').onclick = function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        };
    }
</script>
