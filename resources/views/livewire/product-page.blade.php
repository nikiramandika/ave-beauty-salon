<div>
    <section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
        <div class="container mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select id="categoryFilter" class="form-select">
                        <option value="all">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_slug }}"
                                {{ request('category') == $category->category_slug ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="product-grid open-up" data-aos="zoom-out">
                @foreach ($products as $product)
                    <div class="product-item image-zoom-effect link-effect">
                        <div class="image-holder">
                            <a href="{{ url('products/' . $product->product_slug) }}">
                                <div>
                                    <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                        style="width: 250px; height:250px; object-fit:cover;"
                                        alt="{{ $product->product_name }}" class="product-image img-fluid">
                                </div>
                            </a>
                            <div class="product-content">
                                <h5 class="text-uppercase fs-5 mt-3">
                                    <a href="{{ url('products/' . $product->product_slug) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </h5>
                                <a href="#" class="text-decoration-none" data-after="Add to cart">
                                    <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            window.location.href = selectedCategory === 'all' ?
                '{{ url('products') }}' :
                '{{ url('products?category=') }}' + selectedCategory;
        });
    </script>
</div>
