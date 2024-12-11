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
        // Query untuk mendapatkan data dari tabel `course_history1` dan `selling_invoices`
        $courses = DB::table('course_history1')
            ->join('selling_invoices', 'course_history1.invoice_code', '=', 'selling_invoices.invoice_code') // Join dengan selling_invoices
            ->where('course_history1.user_id', $userId)
            ->when($this->search, function ($query) {
                $query->where('course_history1.full_course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('course_history1.invoice_code', 'like', '%' . $this->search . '%');
            })
            ->select(
                'course_history1.invoice_code',
                'course_history1.full_course_name',
                'course_history1.course_price',
                'course_history1.total_sessions',
                'course_history1.registration_status',
                'course_history1.start_date',
                'course_history1.end_date',
                'course_history1.sessions_completed',
                'selling_invoices.selling_invoice_id', // Menambahkan selling_invoice_id ke select
                'selling_invoices.recipient_address', // Menambahkan selling_invoice_id ke select
                'selling_invoices.recipient_file' // Menambahkan selling_invoice_id ke select
            )
            ->paginate(10);

        // Cek apakah hasil query kosong dan tambahkan pesan jika kosong
        $message = $courses->isEmpty() ? "Pesan yang Anda cari tidak ada." : null;

        return view('livewire.history-course-page', [
            'courses' => $courses,
            'message' => $message, // Kirim pesan ke view
        ]);
    }

}

