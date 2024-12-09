<div>
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container pt-5">

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Order Details -->
                    <div class="card mb-4 p-6">
                        <div class="card-body p-4 mt-6">
                            <div class="card-header p-0" style="background-color: transparent;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1">Order #{{ $courseHistory->invoice_code }}</h4>
                                        <div class="d-flex align-items-center mb-2 fc-heading">
                                            <small>Order Date:
                                                {{ \Carbon\Carbon::parse($courseHistory->order_date)->format('l, d-F-y H:i:s') }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="fs-6 badge bg-warning rounded-pill p-2 px-3" style="color: white">
                                            {{ ucfirst($courseHistory->order_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Details -->
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex mb-2">
                                                    Course : {{ $courseHistory->full_course_name }}
                                            </div>
                                        </td>
                                        <td>x{{ $courseHistory->total_sessions }}</td>
                                        <td class="text-end pe-0">
                                            Rp{{ number_format($courseHistory->course_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <!-- Calculate the Total -->
                                    @php
                                        $total = $courseHistory->course_price;
                                    @endphp

                                    <tr class="fw-bold">
                                        <td colspan="2" class="ps-0">TOTAL</td>
                                        <td class="text-end p-0">
                                            Rp{{ number_format($total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="d-flex justify-content-end">
                                <div>
                                    <a href='{{ route('invoice.view', $courseHistory->invoice_code) }}''
                                        class="btn btn-primary mx-2">View Invoice</a>
                                </div>
                                <div>
                                    <a href="{{ route('invoice.download', $courseHistory->invoice_code) }}"
                                      target="_blank"  class="btn btn-primary">Download Invoice</a>
                                </div>
                            </div>
                            <!-- Complete Order Button -->
                            @if ($courseHistory->registration_status === 'Pesanan Dikirim')
                                <div class="d-flex justify-content-end mt-2">
                                    <div>
                                        <button type="button"
                                            class="fs-6 btn btn-success rounded-pill py-2 px-3 ms-2 fs-roboto"
                                            style="font-weight: bold;" data-bs-toggle="modal"
                                            data-bs-target="#completeOrderModal">
                                            Complete Order
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-3">Payment Method</h4>
                                <div>
                                    <span class="fs-6 badge bg-success rounded-pill py-2 px-3 ms-2 fs-roboto"
                                        style="color: white">
                                        @if ($courseHistory->registration_status == 'Pesanan Offline')
                                            Paid
                                        @elseif($courseHistory->end_date)
                                            Paid
                                        @else
                                            Unpaid
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <p>{{ $courseHistory->recipient_payment }}</p>
                            <hr>
                            <h4 class="mb-3">Course Detail</h4>

                            <p><strong>Status Registration:</strong>
                                {{ ucfirst($courseHistory->registration_status) }}
                            </p>
                            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($courseHistory->start_date)->format('d F Y') }}</p>
                            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($courseHistory->end_date)->format('d F Y') }}</p>
                            <p><strong>Total Session:</strong> {{ $courseHistory->total_sessions }}</p>
                            <p><strong>Session Completed:</strong> {{ $courseHistory->sessions_completed }}</p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
