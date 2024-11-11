@extends('user.layouts.product')

@section('content')
<section id="related-products" class="related-products product-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="product-grid open-up" data-aos="zoom-out">
            @foreach ($products as $product)
                <div class="product-item image-zoom-effect link-effect">
                    <div class="image-holder">
                        <a href="{{ url('products/' . $product->product_slug) }}">
                            <img src="{{ asset($product->description->product_image ?? 'user/images/default.jpg') }}" alt="{{ $product->product_name }}" class="product-image img-fluid">
                        </a>
                        <div class="product-content">
                            <h5 class="text-uppercase fs-5 mt-3">
                                <a href="{{ url('products/' . $product->product_slug) }}">{{ $product->product_name }}</a>
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
@endsection
