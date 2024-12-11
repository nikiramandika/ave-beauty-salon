<div>
    <style>
        tbody td {
            color: rgba(33, 37, 41, 0.8) !important;
            font-size: 16px;
        }

        thead {
            white-space: nowrap;
        }
    </style>

    <div class="container pt-2" style="min-height: 50vh">

        <h4 class="mt-5">Your Order History</h4>

        @if ($invoices->isEmpty())
            <!-- Form Pencarian -->
            <form wire:submit.prevent="submitSearch">
                <div class="input-group mb-3 mt-3 position-relative">
                    <input type="text" wire:model="search" class="form-control border-0 border-bottom bg-transparent"
                        placeholder="Search by Invoice Code or Product Name..." style="padding-right: 50px!important;">
                    <button class="search-submit border-0 position-absolute bg-transparent" type="submit"
                        style=" right: 15px;">
                        <svg class="search" width="24" height="24">
                            <use xlink:href="#search"></use>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="text-center my-5">
                <p>You don't have any order history yet</p>
                <a href="/products" class="btn btn-primary">Shop Product</a>
            </div>
        @else
            <!-- Form Pencarian -->
            <form wire:submit.prevent="submitSearch">
                <div class="input-group mb-3 mt-3 position-relative">
                    <input type="text" wire:model="search" class="form-control border-0 border-bottom bg-transparent"
                        placeholder="Search by Invoice Code or Product Name..." style="padding-right: 50px!important;">
                    <button class="search-submit border-0 position-absolute bg-transparent" type="submit"
                        style=" right: 15px;">
                        <svg class="search" width="24" height="24">
                            <use xlink:href="#search"></use>
                        </svg>
                    </button>
                </div>
            </form>
            <!-- Tabel yang Dikelola Livewire -->
            <div style="overflow-x: auto;" class="pt-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center m-0 align-middle">
                            <th>Invoice Code</th>
                            <th>Order Date</th>
                            <th>Recipient</th>
                            <th>Products Ordered</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($message))
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @endif
                        <!-- Display "Pay Now" rows first -->
                        @foreach ($invoices as $invoice)
                            <tr class="text-muted">
                                <td>{{ $invoice->invoice_code }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->order_date)->format('l, d-F-y H:i:s') }}</td>
                                <td>{{ $invoice->recipient_name }}</td>
                                <td>
                                    @foreach ($invoice->details as $detail)
                                        @if (isset($detail->product_name))
                                            <p>{{ $detail->product_name }} ({{ $detail->quantity }} x
                                                Rp{{ number_format($detail->price, 0, ',', '.') }})</p>
                                        @elseif (isset($detail->treatment_name))
                                            @foreach ($invoice->details as $detail)
                                                <p>{{ $detail->treatment_name }} ({{ $detail->quantity }} x
                                                    Rp{{ number_format($detail->price, 0, ',', '.') }})</p>
                                            @endforeach
                                        @endif
                                    @endforeach

                                </td>
                                <td>
                                    @php
                                        $total = $invoice->details->sum(function ($detail) {
                                            return $detail->quantity * $detail->price;
                                        });
                                    @endphp
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </td>
                                <td>{{ ucfirst($invoice->order_status) }}</td>
                                <td style="text-align: center">
                                    @if ($invoice->recipient_address !== 'Pesanan Offline' && empty($invoice->recipient_file))
                                        <a href="{{ route('payment.upload', $invoice->selling_invoice_id) }}"
                                            class="btn btn-success">Pay Now</a>
                                    @else
                                        <a href="{{ route('detailInvoice', $invoice->selling_invoice_id) }}"
                                            class="btn btn-link p-0">View</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Livewire -->
            <div class="d-flex justify-content-center">
                {{ $invoices->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
