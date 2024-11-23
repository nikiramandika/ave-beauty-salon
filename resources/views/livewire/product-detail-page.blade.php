<div>
    <section id="details" class="details full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="product-image">
                    <img src="{{ asset($product->description->product_image) }}" alt="{{ $product->product_name }}"
                        class="img-fluid">
                </div>
                <div class="product-info">
                    <h1 class="product-title">{{ $product->product_name }}</h1>
                    <p class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="product-availability" style="color: green; font-weight: bold;">
                        Stock: <span>{{ $product->details->product_stock }}</span>
                    </p>
                    <p class="product-size" style="font-weight: bold;">
                        Size: <span>{{ $product->details->size }}</span>
                    </p>
                    <p class="product-description" align="justify">
                        {{ $product->description->description }}
                    </p>
                    <div>
                        <button
                            id="addToCartButton"
                            wire:click="addToCart('{{ $product->product_id }}', 1)"
                            class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeCartButton = document.querySelector('[data-bs-dismiss="offcanvas"]');
        const addToCartButton = document.getElementById('addToCartButton');
        const backdrop = document.createElement('div');
        backdrop.className = 'manual-backdrop';
        backdrop.id = 'manualBackdrop';
        document.body.appendChild(backdrop);

        addToCartButton.addEventListener('click', function () {
            backdrop.classList.add('show');
        });

        closeCartButton.addEventListener('click', function () {
            const backdropElement = document.getElementById('manualBackdrop');
            if (backdropElement) {
                backdropElement.remove();
            }
        });
    });
</script>
