@extends('user.layouts.main')

@section('content')
    <section id="details" class="details full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="product-image">
                    <img src="{{ asset($product->description->product_image) }}"
                        alt="{{ $product->product_name }}" class="img-fluid">
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

                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
