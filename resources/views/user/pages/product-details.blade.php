@extends('user.layouts.product-details')

@section('content')
<section id="product-detail" class="product-detail full-screen">
    <div class="container-fluid">
      <div class="product-content d-flex align-items-center justify-content-center gap-5">
        <div class="product-image">
          <img src="{{ asset('user/images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="product-info">
          <h1 class="product-title">{{ $product->name }}</h1>
          <p class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
          <p class="product-availability" style="color: green; font-weight: bold;">
              Availability: <span>{{ $product->availability }}</span>
            </p>
          <p class="product-description" align="justify">
            {{ $product->description }}
          </p>

          <form action="{{ route('cart.add', $product->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary">Add to Cart</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
