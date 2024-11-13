@extends('user.layouts.promo')

@section('content')
<section id="related-promos" class="related-promos promo-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="promo-grid open-up" data-aos="zoom-out">
            @foreach ($promos as $promo)
                <div class="promo-item image-zoom-effect link-effect">
                    <div class="image-holder">
                        <a href="{{ url('promo/' . $promo->promo_slug) }}">
                            <img src="{{ asset($promo->description->promo_image ?? 'user/images/default.jpg') }}" alt="{{ $promo->promo_name }}" class="promo-image img-fluid">
                        </a>
                        <div class="promo-content">
                            <h5 class="text-uppercase fs-5 mt-3">
                                <a href="{{ url('promo/' . $promo->promo_slug) }}">{{ $promo->promo_name }}</a>
                            </h5>
                            <div class="price-container">
                                <a href="#" class="text-decoration-none promo-link" data-after="Rp{{ number_format($promo->promo_price, 0, ',', '.') }}">
                                    <span class="original-price">Rp{{ number_format($promo->original_price, 0, ',', '.') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
