<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CoursePage extends Component
{
    public $courses; // Menyimpan data semua course

    public function mount()
    {
        // Ambil semua course yang aktif dan relasi description
        $this->courses = Course::with('description')
            ->where('is_active', 1)
            ->get();
    }

    public function render()
    {
        return view('livewire.course-page', [
            'courses' => $this->courses, // Mengirim data ke Blade
        ]);
    }
}
