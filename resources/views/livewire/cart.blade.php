<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="Keranjang Saya"
    wire:ignore.self>
    <div class="offcanvas-header justify-content-between">
        <h5 class="offcanvas-title" id="Keranjang Saya">My Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
    </div>
    <div class="offcanvas-body" id="cart-container">
        @auth
            <div id="cart-loader" class="text-center d-none">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Memuat...</span>
                </div>
            </div>
            <div id="cart-content" wire:key="cart-items">
                @if ($cartItems->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-id="{{ $item->cart_item_id }}">
                                <div>
                                    <h6 class="my-0">
                                        {{ $item->product->product_name ?? 'Produk tidak ditemukan' }}
                                    </h6>
                                    <small class="text-muted">Produk</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary me-2"
                                        wire:click.prevent="decreaseQuantity({{ $item->cart_item_id }})">-
                                    </button>
                                    <span>{{ $item->quantity }}</span>
                                    <button class="btn btn-sm btn-outline-secondary ms-2"
                                        wire:click.prevent="increaseQuantity({{ $item->cart_item_id }})">+
                                    </button>
                                    <span
                                        class="ms-3 me-3">Rp{{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}</span>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click.prevent="removeFromCart({{ $item->cart_item_id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div id="cart-empty" class="text-center">
                        <p>Your cart is empty</p>
                    </div>
                @endif
            </div>
            <div class="mt-3">
                <a href="{{ route('checkout') }}"
                    class="btn btn-primary w-100 {{ $cartItems->isNotEmpty() ? '' : 'disabled' }}">
                    Checkout
                </a>
            </div>
        @else
            <div class="text-center">
                <a href="/login">Please login to view your cart.</a>
            </div>
        @endauth
    </div>
</div>
