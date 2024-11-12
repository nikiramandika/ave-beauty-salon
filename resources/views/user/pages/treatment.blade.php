@extends('user.layouts.treatment')

@section('content')
<section id="related-treatments" class="related-treatments treatment-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="treatment-grid open-up" data-aos="zoom-out">
            @foreach ($treatments as $treatment)
                <div class="treatment-item image-zoom-effect link-effect">
                    <div class="image-holder">
                        <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">
                            <img src="{{ asset($treatment->description->treatment_image ?? 'user/images/default.jpg') }}" alt="{{ $treatment->treatment_name }}" class="treatment-image img-fluid">
                        </a>
                        <div class="treatment-content">
                            <h5 class="text-uppercase fs-5 mt-3">
                                <a href="{{ url('treatment/' . $treatment->treatment_slug) }}">{{ $treatment->treatment_name }}</a>
                            </h5>
                            <a href="#" class="text-decoration-none" data-after="View Details">
                                <span>Rp{{ number_format($treatment->price, 0, ',', '.') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
