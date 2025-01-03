<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="Keranjang Saya"
    wire:ignore.self>
    <div class="offcanvas-header justify-content-between">
        <h5 class="offcanvas-title" id="Keranjang Saya">My Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
    </div>
    <div class="offcanvas-body" id="cart-container">
        @auth
            <div id="cart-loader" class="text-center d-none mb-3">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Memuat...</span>
                </div>
            </div>
            <div id="cart-content" wire:key="cart-items">
                @if ($cartItems->isNotEmpty())
                    <ul class="list-group">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex align-items-center border-bottom py-3">
                                <div style="width: 35%;">
                                    <h6 class="my-0 fw-bold text-truncate" style="max-width: 150px;">
                                        <a class="heading-color" href="{{ url('products/' .  $item->product->product_slug) }}">
                                            {{ $item->product->product_name ?? 'Produk tidak ditemukan' }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $item->productDetail->size ?? '-' }}</small>
                                </div>
                                <div style="width: 25%;" class="d-flex align-items-center">
                                    <button class="btn btn-sm me-2"
                                        wire:click.prevent="decreaseQuantity({{ $item->cart_item_id }})">-</button>
                                    <span class="text-center">{{ $item->quantity }}</span>
                                    <button class="btn btn-sm ms-2"
                                        wire:click.prevent="increaseQuantity({{ $item->cart_item_id }})">+</button>
                                </div>
                                <div style="width: 30%;" class="text-center">
                                    Rp{{ number_format($item->quantity * $item->productDetail->price, 0, ',', '.') }}
                                </div>
                                <div style="width: 10%; text-align:right;">
                                    <button class="btn btn-sm m-0 p-0"
                                        wire:click.prevent="removeFromCart({{ $item->cart_item_id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div id="cart-empty" class="text-center py-5">
                        <p class="fs-4 text-muted">Your cart is empty</p>
                        <a href="/products" class="btn btn-primary mt-4">Start Shopping</a>
                    </div>
                @endif
            </div>
            @if ($cartItems->isNotEmpty())
                <div class="mt-4">
                    <a href="{{ route('checkout') }}"
                        class="btn btn-primary w-100 {{ $cartItems->isNotEmpty() ? '' : 'disabled' }}">
                        Checkout
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <p>Please <a href="/login" class="text-decoration-none">login</a> to view your cart.</p>
            </div>
        @endauth
    </div>
</div>
