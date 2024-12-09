<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SellingInvoice;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryCourseDetailPage extends Component
{
    use WithFileUploads;
    public $courseHistory; // Properti untuk menyimpan data course history
    public function mount($invoiceCode)
    {
        // Mengambil data dari database berdasarkan invoiceCode
        $this->courseHistory = DB::table('course_history1')
            ->select(
                'course_history1.invoice_code',
                'full_course_name',
                'course_price',
                'total_sessions',
                'registration_status',
                'start_date',
                'end_date',
                'sessions_completed',
                'selling_invoices.order_status',
                'selling_invoices.order_date',
                'selling_invoices.recipient_payment'
            ) // Menambahkan order_date dari tabel selling_invoice
            ->join('selling_invoices', 'course_history1.invoice_code', '=', 'selling_invoices.invoice_code') // Melakukan join dengan tabel selling_invoice
            ->where('course_history1.invoice_code', $invoiceCode)
            ->first(); // Ambil satu data saja berdasarkan invoice_code

        // Cek apakah data ditemukan, jika tidak, bisa diberi nilai default atau lakukan penanganan
        if (!$this->courseHistory) {
            // Misalnya, alihkan ke halaman error atau beri pesan error
            abort(404, 'Invoice not found');
        }
    }

    public function render()
    {
        // Mengembalikan tampilan dan mengirimkan data ke view
        return view('livewire.history-course-detail-page', [
            'courseHistory' => $this->courseHistory, // Pastikan menggunakan properti ini
        ]);
    }


}
