@extends('user.layouts.main')

@section('content')
    <section class="p-2 p-md-4 p-xl-4">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="py-5">
                    <div class="card">
                        <div class="px-5">
                            <div class="px-2 py-5">
                                <h4 class="mb-0">Thanks for your Order, name!</h4>
                            </div>
                            <div class="px-3 d-flex justify-content-between">
                                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #16123222</h2>
                                <p class=""><span class="px-2 badge rounded-pill bg-warning">Pending</span></p>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-bold mb-0">Products ordered</p>
                                </div>
                                <div class="card shadow-0 border mb-4">
                                    <div class="card-body">

                                        {{-- dari sini --}}
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/13.webp"
                                                    class="img-fluid" alt="Phone">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">Samsung Galaxy</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">White</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Capacity: 64GB</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Qty: 1</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">$499</p>
                                            </div>
                                        </div>
                                        {{-- sampe sini --}}



                                    </div>
                                </div>
                            </div>

                            <div class="">

                                <!-- Customer Notes -->
                                <div class="mb-4">
                                    <div class="card-body">
                                        <p class="lead fw-bold mb-0">Shipping Information</p>
                                        <address>
                                            John Doe<br>
                                            1355 Market St, Suite 900<br>
                                            San Francisco, CA 94103<br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                    </div>
                                </div>

                            </div>

                            <div class="px-3">
                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">Order Details</p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0 ">Subtotal</p>
                                    <p class="text-muted mb-0">$19.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Discount</p>
                                    <p class="text-muted mb-0">123</p>
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                    <p class="text-muted mb-0">Shipping</p>
                                    <p class="text-muted mb-0">Free</p>
                                </div>

                            </div>
                        </div>





                    </div>

                    <div class="card-footer border-0 px-5 py-5"
                        style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                            paid: <span class="px-3 h2 mb-0 ms-2">$1040</span></h5>
                    </div>



                </div>
            </div>
        </div>



        </div>
    </section>
@endsection
