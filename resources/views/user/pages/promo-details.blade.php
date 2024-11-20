@extends('user.layouts.promo-details')

@section('content')
    <section id="promo-details" class="promo-detail full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="promo-image">
                    <img src="{{ asset($promo->description->promo_image ?? 'user/images/default.jpg') }}"
                         alt="{{ $promo->promo_name }}" class="img-fluid">
                </div>
                <div class="promo-info">
                    <h1 class="promo-title">{{ $promo->promo_name }}</h1>
                    <div class="price">
                        <span class="original-price">Rp{{ number_format($promo->original_price, 0, ',', '.') }}</span>
                        <span class="promo-price">Rp{{ number_format($promo->promo_price, 0, ',', '.') }}</span>
                    </div>
                    <p class="promo-description" align="justify">
                        {{ $promo->description->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
