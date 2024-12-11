<div>
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="py-5">
                    <div class="card">
                        <div class="px-5">
                            <div class="px-2 pt-5 pb-3 d-flex justify-content-between">
                                <h4 class="">Thanks for your Order, {{ $invoice->recipient_name }}!</h4>
                                <p>
                                    <span
                                        class="text-white px-3 py-2 badge rounded-pill 
                                        {{ $invoice->order_status === 'Pending' ? 'bg-warning' : 'bg-success' }}">
                                        {{ ucfirst($invoice->order_status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="px-3 d-flex justify-content-between">
                                <h2 class="h5 mb-0">
                                    <a href="#" class="text-muted"></a> Order #{{ $invoice->invoice_code }}
                                </h2>
                                <a href="{{ route('historyOrder') }}" class="btn-link" style="height: fit-content">View Order</a>
                                
                            </div>

                            <div class="card-body pt-5">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-bold mb-0">Products Ordered</p>
                                </div>
                                @if ($details->count())
                                    @foreach ($details as $detail)
                                        <div class="card shadow-0 border mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <!-- Menampilkan gambar produk dari product_descriptions -->
                                                        @if ($detail->product_image)
                                                            <img src="{{ asset($detail->product_image) }}"
                                                                class="img-fluid rounded" alt="Product" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                                                        @else
                                                            <img src="{{ asset('user/images/image_not_available.png') }}" class="img-fluid"
                                                                alt="Product">
                                                            <!-- Placeholder jika tidak ada gambar -->
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0">{{ $detail->product_name }}</p>
                                                    </div>
                                                    <div
                                                        class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0 small">
                                                            Rp{{ number_format((float) $detail->price, 0, ',', '.') }}</p>
                                                    </div>
                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0 small"> {{ $detail->quantity }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0 small">
                                                            Rp{{ number_format((float) ($detail->quantity * $detail->price), 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No products found for this order.</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <!-- Customer Notes -->
                                <div class="card-body">
                                    <p class="lead fw-bold mb-0">Shipping Information</p>
                                    <address class="text-muted">
                                        {{ $invoice->recipient_name }}<br>
                                        {{ $invoice->recipient_address }}<br>
                                        <a title="Phone">Phone:</a> {{ $invoice->recipient_phone }}
                                    </address>
                                </div>
                            </div>

                            <div class="px-3 mb-5">
                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">Order Details</p>
                                </div>
                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0">Subtotal</p>
                                    <p class="text-muted mb-0">
                                        Rp{{ number_format((float) $details->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0">Shipping Fee</p>
                                    <p class="text-muted mb-0">
                                        Rp{{ number_format(10000, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 px-5 py-5"
                        style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                            Total Paid: <span class="px-3 h2 mb-0 ms-2">
                                Rp{{ number_format((float) $details->sum(fn($d) => $d->quantity * $d->price ) + 10000, 0, ',', '.') }}
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
