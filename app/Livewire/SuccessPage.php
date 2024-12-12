<?php
namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use App\Models\SellingInvoice;
use App\Models\Product;

class SuccessPage extends Component
{
    public $invoice;
    public $details;
    public $totalPrice;

    public function mount($invoiceId)
    {
        // Ambil data invoice beserta detailnya
        $this->invoice = SellingInvoice::with('details')->findOrFail($invoiceId);

        // Ambil detail dari invoice
        $this->details = $this->invoice->details;

        // Hitung total harga dari semua item di invoice
        $this->totalPrice = $this->details->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });

        // Mencari gambar berdasarkan apakah itu produk atau course
        foreach ($this->details as $detail) {
            if ($detail->product_name) {
                // Jika product_name tidak null, cari gambar produk
                $cleanedProductName = preg_replace('/\s*\(.*\)$/', '', $detail->product_name); // Hapus (Size: xxx)

                // Cari produk berdasarkan nama yang sudah dibersihkan
                $product = Product::where('product_name', $cleanedProductName)->first();

                // Ambil gambar produk dari product_descriptions jika produk ditemukan
                $detail->product_image = $product->description->product_image ?? null;
            } elseif ($detail->course_name) {
                // Jika course_name tidak null, cari gambar course
                $cleanedCourseName = preg_replace('/\s*\(.*\)$/', '', $detail->course_name); // Hapus informasi tambahan

                // Cari course berdasarkan nama yang sudah dibersihkan
                $course = Course::where('course_name', $cleanedCourseName)->first();

                // Ambil gambar course dari course_descriptions jika course ditemukan
                $detail->product_image = $course->description->course_image ?? null;
            } else {
                // Jika tidak ada product_name atau course_name, set gambar sebagai null
                $detail->product_image = null;
            }
        }
    }


    public function render()
    {
        return view('livewire.success-page', [
            'invoice' => $this->invoice,
            'details' => $this->details,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}