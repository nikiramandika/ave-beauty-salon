<div>
    <div class="container">
        <div class="d-flex justify-content-between mt-5 align-items-center">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    All Categories
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('products') }}">All Categories</a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item" href="{{ url('products?category=' . $category->id) }}">
                                {{ $category->category_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="product-grid open-up" data-aos="zoom-out">
                @foreach ($products as $product)
                    <div class="product-item image-zoom-effect link-effect">
                        <div class="image-holder">
                            <a href="{{ url('products/' . $product->product_slug) }}">
                                <div>
                                    <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}"
                                        style="width: 250px; height:250px; object-fit:cover; "
                                        alt="{{ $product->product_name }}" class="product-image img-fluid">
                                </div>
                            </a>
                            <div class="product-content">
                                <h5 class="text-uppercase fs-5 mt-3">
                                    <a
                                        href="{{ url('products/' . $product->product_slug) }}">{{ $product->product_name }}</a>
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
</div>
