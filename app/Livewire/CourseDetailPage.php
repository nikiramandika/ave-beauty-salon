<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseDetailPage extends Component
{
    public $course;
    public $start_date;
    public $end_date;

    public function mount($course_slug)
    {
        // Ambil kursus berdasarkan slug dan status aktif
        $this->course = Course::where('course_slug', $course_slug)
            ->where('is_active', 1) // Filter hanya kursus yang aktif
            ->with(['description']) // Load relasi
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404
    }

    public function redirectToCheckout()
    {
        // Redirect ke halaman checkout dengan slug kursus
        return redirect()->route('checkoutCourse', [
            'course_slug' => $this->course->course_slug,
        ]);
    }
    


    public function render()
    {
        return view('livewire.course-detail-page', [
            'course' => $this->course,
        ]);
    }
}
