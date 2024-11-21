<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseDetailPage extends Component
{
    public $course;

    public function mount($course_slug)
    {
        // Ambil produk berdasarkan slug dan status aktif
        $this->course = Course::where('course_slug', $course_slug)
            ->where('is_active', 1) // Filter hanya produk yang aktif
            ->with(['description']) // Load relasi
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404
    }

    public function render()
    {
        return view('livewire.course-detail-page', [
            'course' => $this->course, // Kirim data produk ke view
        ]);
    }
}
