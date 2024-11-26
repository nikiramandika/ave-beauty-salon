<div class="container">
    <h1>Your Order History</h1>

    <!-- Form Pencarian -->
    <form wire:submit.prevent="submitSearch">
        <div class="input-group mb-3">
            <input type="text" wire:model="search" class="form-control"
                placeholder="Search by Invoice Code or Product Name...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Tabel yang Dikelola Livewire -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
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
            <!-- Display "Pay Now" rows first -->
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->order_date)->format('l, d-F-y H:i:s') }}</td>
                    <td>{{ $invoice->recipient_name }}</td>
                    <td>
                        @foreach ($invoice->details as $detail)
                            <p>{{ $detail->product_name }} ({{ $detail->quantity }} x
                                Rp{{ number_format($detail->price, 0, ',', '.') }})</p>
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
                    <td>
                        @if ($invoice->address !== 'Pesanan Offline' && empty($invoice->recipient_file))
                            <a href="{{ route('payment.upload', $invoice->selling_invoice_id) }}"
                                class="btn btn-success">Pay Now</a>
                        @else
                            {{-- {{ route('invoice.show', $invoice->id) }} --}}
                            <a href="" class="btn btn-info">View</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Livewire -->
    <div class="d-flex justify-content-center">
        {{ $invoices->links('pagination::bootstrap-4') }}
    </div>

</div>
