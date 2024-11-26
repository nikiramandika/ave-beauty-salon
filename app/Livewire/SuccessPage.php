<?php
namespace App\Livewire;

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

        // Mencari gambar produk berdasarkan nama yang sudah dibersihkan
        foreach ($this->details as $detail) {
            // Hapus bagian ukuran dari nama produk yang ada di detail
            $cleanedProductName = preg_replace('/\s*\(.*\)$/', '', $detail->product_name); // Hapus (Size: xxx)

            // Cari produk berdasarkan nama yang sudah dibersihkan
            $product = Product::where('product_name', $cleanedProductName)->first();

            // Ambil gambar produk dari product_descriptions jika produk ditemukan
            if ($product) {
                // Menyimpan gambar produk ke detail
                $detail->product_image = $product->description->product_image ?? null;
            } else {
                // Jika tidak ditemukan, set gambar sebagai null
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