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
                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex align-items-center border-bottom py-3">
                                <div style="width: 40%;">
                                    <h6 class="my-0 fw-bold text-truncate" style="max-width: 150px;">
                                        {{ $item->product->product_name ?? 'Produk tidak ditemukan' }}
                                    </h6>
                                    <small class="text-muted">Ukuran: {{ $item->productDetail->size ?? '-' }}</small>
                                </div>
                                <div style="width: 20%;" class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary me-2"
                                        wire:click.prevent="decreaseQuantity({{ $item->cart_item_id }})">-</button>
                                    <span class="text-center">{{ $item->quantity }}</span>
                                    <button class="btn btn-sm btn-outline-secondary ms-2"
                                        wire:click.prevent="increaseQuantity({{ $item->cart_item_id }})">+</button>
                                </div>
                                <div style="width: 30%;" class="text-center">
                                    Rp{{ number_format($item->quantity * $item->productDetail->price, 0, ',', '.') }}
                                </div>
                                <div style="width: 10%;" class="text-center">
                                    <button class="btn btn-sm btn-danger"
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
                        <a href="/" class="btn btn-outline-primary">Start Shopping</a>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <a href="{{ route('checkout') }}"
                    class="btn btn-primary w-100 {{ $cartItems->isNotEmpty() ? '' : 'disabled' }}">
                    Checkout
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <p>Please <a href="/login" class="text-decoration-none">login</a> to view your cart.</p>
            </div>
        @endauth
    </div>
</div>
