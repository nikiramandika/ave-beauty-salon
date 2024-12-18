<div>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .list-group-item {
            padding: 0 !important;
        }

        .list-group-item:hover {
            background-color: transparent;
            cursor: auto !important;
        }
    </style>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="container">
        <main>
            <div class="py-4 text-center">
                <h3>Checkout</h3>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span>Your cart</span>
                        <span class="badge bg-dark rounded-pill">{{ count($cartItems) }}</span>
                    </h4>
                    <ul class="list-group mb-3 pt-3">
                        @forelse ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $item->product->product_name ?? 'Unknown Product' }}</h6>
                                    <small class="text-body-secondary">
                                        Ukuran: {{ $item->productDetail->size ?? 'N/A' }} <br>
                                        Qty: {{ $item->quantity }}
                                    </small>
                                </div>
                                <span class="text-body-secondary">
                                    Rp{{ number_format($item->quantity * ($item->productDetail->price ?? 0), 0, ',', '.') }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="text-center w-100">
                                    <small class="text-body-secondary">Your cart is empty</small>
                                </div>
                            </li>
                        @endforelse
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-success font-bold">Shipping</h6> <!-- Warna Shipping berbeda -->
                                <small class="text-body-secondary">Available within Medan</small>
                            </div>
                            <span class="text-body-secondary">Rp10.000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (Rp)</span>
                            <strong>Rp{{ number_format($cartTotal + 10000, 0, ',', '.') }}</strong>
                        </li>
                    </ul>

                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form wire:submit.prevent="submitPayment" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" wire:model="firstName"
                                    placeholder="" required>
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" wire:model="lastName"
                                    placeholder="" required>
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model="email"
                                    placeholder="{{ auth()->user()->email }}" value="{{ auth()->user()->email }}"
                                    readonly>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-12">
                                <label for="recipientPhone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="recipientPhone"
                                    wire:model="recipientPhone" placeholder="e.g., 08123456789" required
                                    pattern="[0-9]{10,13}" minlength="10" maxlength="13">
                                @error('recipientPhone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" wire:model="address"
                                    placeholder="1234 Main St" required>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" wire:model="country" required>
                                    <option value="">Choose...</option>
                                    <option>Indonesia</option>
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select" id="state" wire:model="state" required>
                                    <option value="">Choose...</option>
                                    <option>Medan</option>
                                </select>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Zip -->
                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="zip" wire:model="zip"
                                    placeholder="" required>
                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Payment Method: Bank Transfer -->
                        <h4 class="mb-3">Payment</h4>
                        <div class="mt-3 mb-5">
                            <div class="form-check ps-4">
                                <input id="bankTransfer" name="paymentMethod" type="radio"
                                    class="form-check-input" value="Bank Transfer" wire:model="paymentMethod" checked
                                    required>
                                <label class="form-check-label px-0" for="bankTransfer">Bank Transfer</label>
                                @error('paymentMethod')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bank Selection -->
                        <div class="col-12">
                            <label for="bank" class="form-label">Choose Your Bank</label>
                            <select class="form-select" id="bank" wire:model="recipientBank" required>
                                <option value="">Select a bank...</option>
                                <option value="BCA">BCA (82739129xxxx)</option>
                                <option value="Mandiri">Mandiri (1029374382xxxx)</option>
                                <option value="BNI">BNI (332763840xxx)</option>
                                <option value="BRI">BRI(3793747672xxx)</option>
                            </select>
                            @error('recipientBank')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-100 btn btn-primary btn-lg my-4">Submit Payment</button>
                    </form>

                </div>
            </div>
        </main>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/js/checkout.js') }}"></script>

</div>
