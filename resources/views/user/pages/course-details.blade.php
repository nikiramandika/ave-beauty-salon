@extends('user.layouts.course-details')

@section('content')
    <section id="course-detail" class="course-detail full-screen">
        <div class="container-fluid">
            <div class="content d-flex align-items-center justify-content-center gap-5">
                <div class="course-image">
                    <img src="{{ asset($course->description->course_image) }}" alt="{{ $course->course_name }}" class="img-fluid">
                </div>
                <div class="course-info">
                    <h1 class="course-title">{{ $course->course_name }}</h1>
                    <p class="course-price">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
                    <p class="course-sessions">
                        <strong>Sessions:</strong> {{ $course->sessions }}
                    </p>
                    <p class="course-benefits">
                        <strong>Benefits:</strong> {{ $course->benefits }}
                    </p>
                    <p class="course-free-items">
                        <strong>Free Items:</strong> {{ $course->free_item }}
                    </p>
                    <p class="course-description" align="justify">
                        {{ $course->description->description }}
                    </p>

                    <form action="{{ route('course-registrations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
