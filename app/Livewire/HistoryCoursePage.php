<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryCoursePage extends Component
{
    use WithPagination;

    public $search = ''; // Untuk menyimpan input pencarian
    public function submitSearch()
    {
        $this->resetPage(); // Reset pagination saat pencarian dimulai
    }

    public function render()
    {
        $userId = Auth::id();
        // Query ke view `course_history`
        $courses = DB::table('course_history1')
            ->where('user_id', $userId)
            ->when($this->search, function ($query) {
                $query->where('full_course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('invoice_code', 'like', '%' . $this->search . '%');
            })
            ->select('invoice_code', 'full_course_name', 'course_price', 'total_sessions', 'registration_status', 'start_date', 'end_date', 'sessions_completed')
            ->paginate(10);

        // Cek apakah hasil query kosong dan tambahkan pesan jika kosong
        $message = $courses->isEmpty() ? "Pesan yang Anda cari tidak ada." : null;

        return view('livewire.history-course-page', [
            'courses' => $courses,
            'message' => $message, // Kirim pesan ke view
        ]);
    }
}

