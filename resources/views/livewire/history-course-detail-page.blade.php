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
                                        <h4 class="mb-1">Order #{{ $invoice->invoice_code }}</h4>
                                        <div class="d-flex align-items-center mb-2 fc-heading">
                                            <small>Order Date:
                                                {{ \Carbon\Carbon::parse($invoice->order_date)->format('l, d-F-y H:i:s') }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="fs-6 badge bg-warning rounded-pill p-2 px-3" style="color: white">
                                            {{ ucfirst($invoice->order_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <table class="table table-borderless mt-2">
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td class="ps-0">
                                                <div class="d-flex mb-2">
                                                    @if (isset($detail->product_name))
                                                        <div class="flex-shrink-0">
                                                            <!-- Display the product image if available -->
                                                            <img src="{{ $detail->product_image ? asset($detail->product_image) : '/noImage.jpeg' }}"
                                                                alt="Product Image" width="75" class="img-fluid">
                                                        </div>
                                                    @endif
                                                    @if (isset($detail->treatment_name))
                                                        <!-- For Treatment Image -->
                                                        <div class="flex-shrink-0">
                                                            <!-- Display the treatment image if available -->
                                                            <img src="{{ $detail->treatment_image ? asset($detail->treatment_image) : '/noImage.jpeg' }}"
                                                                alt="Treatment Image" width="75" class="img-fluid">
                                                        </div>
                                                    @endif
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <h6 class="small mb-0">
                                                            @if (isset($detail->product_name))
                                                                <a href="#"
                                                                    class="text-reset">{{ $detail->product_name }}</a>
                                                            @elseif (isset($detail->treatment_name))
                                                                <a href="#"
                                                                    class="text-reset">{{ $detail->treatment_name }}</a>
                                                            @endif
                                                        </h6>
                                                    </div>

                                                </div>
                                            </td>
                                            <td>x{{ $detail->quantity }}</td>
                                            <td class="text-end pe-0">
                                                Rp{{ number_format($detail->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <!-- Calculate the Subtotal -->
                                    @php
                                        $total = $details->sum(function ($detail) {
                                            return $detail->quantity * $detail->price;
                                        });
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
                                    <a href="" class="btn btn-primary mx-2">View Invoice</a>
                                </div>
                                <div>
                                    <a href="" class="btn btn-primary">Download Invoice</a>
                                </div>
                            </div>
                            <!-- Complete Order Button -->
                            @if ($invoice->order_status === 'Pesanan Dikirim')
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
                                <h4 class="h5 fw-normal fc-heading">Payment Method</h4>
                                <div>
                                    <span class="fs-6 badge bg-success rounded-pill py-2 px-3 ms-2 fs-roboto"
                                        style="color: white">
                                        @if ($invoice->recipient_address == 'Pesanan Offline')
                                            Paid
                                        @elseif($invoice->recipient_file)
                                            Paid
                                        @else
                                            Unpaid
                                        @endif
                                    </span>

                                </div>
                            </div>

                            <p>{{ $invoice->recipient_payment }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
