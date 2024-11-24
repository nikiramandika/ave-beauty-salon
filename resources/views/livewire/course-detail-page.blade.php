<div>
    <section id="course-detail" class="course-detail full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="course-image">
                    <img src="{{ asset($course->description->course_image) }}" alt="{{ $course->course_name }}" class="img-fluid">
                </div>
                <div class="course-info">
                    <h1 class="course-title">{{ $course->course_name }}</h1>
                    <p class="course-price">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
                    <p class="course-sessions"><strong>Sessions:</strong> {{ $course->sessions }}</p>
                    <p class="course-benefits"><strong>Benefits:</strong> {{ $course->description->benefits }}</p>
                    <p class="course-free-items"><strong>Free Items:</strong> {{ $course->description->free_items }}</p>
                    <p class="course-description" align="justify">{{ $course->description->description }}</p>
                    <button wire:click="redirectToCheckout" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </section>
</div>
