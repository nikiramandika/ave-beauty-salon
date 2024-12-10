<div class="container" style="min-height: 50vh">

    <h4 class="mt-5">Your Course History</h4>

    @if ($courses->isEmpty())
        <div class="text-center my-5">
            <p>You don't have any course history yet</p>
            <a href="/course" class="btn btn-primary">View Course</a>
        </div>
    @else
        <!-- Form Pencarian -->
        <form wire:submit.prevent="submitSearch">
            <div class="input-group mb-3 mt-3 position-relative">
                <input type="text" wire:model="search" class="form-control border-0 border-bottom bg-transparent"
                    placeholder="Search by Invoice Code or Product Name..." style="padding-right: 50px!important;">
                <button class="search-submit border-0 position-absolute bg-transparent" type="submit" style=" right: 15px;">
                    <svg class="search" width="24" height="24">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Tabel untuk History Course -->
        <div style="overflow-x: auto;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center m-0 align-middle">
                        <th>Invoice ID</th>
                        <th>Course Name</th>
                        <th>Course Price</th>
                        <th>Total Sessions</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Sessions Completed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($message))
                        <div class="alert alert-warning">
                            {{ $message }}
                        </div>
                    @endif
                    @foreach ($courses as $course)
                        <tr class="text-muted text-center align-middle">
                            <td>{{ $course->invoice_code }}</td>
                            <td>{{ $course->full_course_name }}</td>
                            <td>Rp{{ number_format($course->course_price, 0, ',', '.') }}</td>
                            <td>{{ $course->total_sessions }}</td>
                            <td>{{ ucfirst($course->registration_status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($course->start_date)->format('l, d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($course->end_date)->format('l, d F Y') }}</td>
                            <td>{{ $course->sessions_completed }}</td>
                            <td>
                                <a href="{{ route('detailCourse', ['invoiceCode' => $course->invoice_code]) }}" class="btn btn-link p-0">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
