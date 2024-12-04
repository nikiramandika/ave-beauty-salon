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
            ->paginate(10);

        return view('livewire.history-course-page', [
            'courses' => $courses,
        ]);
    }
}
