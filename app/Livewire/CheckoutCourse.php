<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutCourse extends Component
{
    public $firstName, $lastName, $recipientPhone, $address, $state, $country, $zip, $recipientBank, $startDate, $endDate, $course_slug;
    public $course;
    public $course_id;


    public function mount($course_slug)
    {
        $this->course_slug = $course_slug;
    
        // Ambil detail kursus berdasarkan slug
        $this->course = \App\Models\Course::where('course_slug', $course_slug)
            ->where('is_active', 1)
            ->firstOrFail();
    
        // Ambil course_id langsung
        $this->course_id = $this->course->course_id; // Pastikan kolom course_id tersedia di tabel
    }
    

    public function submitPaymentCourse()
    {
        $this->email = auth()->user()->email;
    
        // Validasi Input
        $validatedData = $this->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'recipientPhone' => 'required|string',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zip' => 'required|string',
            'recipientBank' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);
    
        // Data penerima dan alamat digabungkan setelah validasi
        $recipientName = $this->firstName . ' ' . $this->lastName;
        $recipientAddress = $this->address . ', ' . $this->state . ', ' . $this->country . ', ' . $this->zip;
    
        try {
            // Panggil stored procedure tanpa menggunakan transaksi Laravel
            $result = DB::select('CALL invoice_course_process(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @selling_invoice_id)', [
                auth()->id(),            // User ID
                $recipientName,          // Nama penerima
                $this->email,            // Email penerima
                $this->recipientPhone,   // Telepon penerima
                $recipientAddress,       // Alamat penerima
                $this->recipientBank,    // Bank penerima
                null,                    // Bukti pembayaran (belum ada)
                'Bank Transfer',         // Metode pembayaran
                'Pending',               // Status pesanan
                $this->course_id,        // ID kursus
                $this->startDate,        // Start date
                $this->endDate,          // End date (pastikan ini adalah tanggal yang valid)
            ]);
            
        
            // Ambil hasil ID faktur dari output parameter
            $invoiceId = DB::select('SELECT @selling_invoice_id AS selling_invoice_id')[0]->selling_invoice_id ?? null;
        
            logger()->info('Output selling_invoice_id:', ['invoiceId' => $invoiceId]);
        
            if (!$invoiceId) {
                throw new \Exception('Failed to retrieve selling_invoice_id from stored procedure.');
            }
        
            return redirect()->route('payment.upload', ['invoiceId' => $invoiceId]);
        } catch (\Exception $e) {
            logger()->error('Transaction error: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while processing your payment. Please try again later.');
            return back();
        }        
    }
    
    
    
    public function render()
    {
        return view('livewire.checkout-course', [
            'course' => $this->course,
        ]);
    }
}
