<section id="related-courses" class="related-courses course-carousel py-5 position-relative overflow-hidden">
    <div class="container">
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" data-aos="zoom-out">
            @foreach ($courses as $course)
                <div class="course-item image-zoom-effect link-effect">
                    <div class="image-holder">
                        <div class="img-cont">
                            <a href="{{ url('course/' . $course->course_slug) }}">
                                <img src="{{ asset($course->description->course_image ?? 'user/images/default.jpg') }}"
                                    alt="{{ $course->course_name }}"class="bd-placeholder-img card-img-top product-image img-fluid" onerror="this.onerror=null; this.src='{{ asset('user/images/image_not_available.png') }}';">
                            </a>
                        </div>
                        
                        <div class="course-content">
                            <h5 class="fs-5 mt-3">
                                <a href="{{ url('course/' . $course->course_slug) }}">{{ $course->course_name }}</a>
                            </h5>
                            <a href="{{ url('course/' . $course->course_slug) }}" class="text-decoration-none" data-after="Register Course">
                                <span>Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
