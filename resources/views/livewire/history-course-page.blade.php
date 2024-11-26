<div class="container">
    <h1>Your Course History</h1>

    <!-- Form Pencarian -->
    <form wire:submit.prevent="render">
        <div class="input-group mb-3">
            <input type="text" wire:model="search" class="form-control"
                placeholder="Search by Course Name or Invoice ID...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Tabel untuk History Course -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Course Name</th>
                <th>Course Price</th>
                <th>Total Sessions</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Sessions Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->invoice_code }}</td>
                    <td>{{ $course->full_course_name }}</td>
                    <td>Rp{{ number_format($course->course_price, 0, ',', '.') }}</td>
                    <td>{{ $course->total_sessions }}</td>
                    <td>{{ ucfirst($course->registration_status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('l, d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->end_date)->format('l, d F Y') }}</td>
                    <td>{{ $course->sessions_completed }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $courses->links('pagination::bootstrap-4') }}
    </div>
</div>
