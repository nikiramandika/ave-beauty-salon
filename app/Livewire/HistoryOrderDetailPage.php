<?php
namespace App\Livewire;

use App\Models\Product;
use App\Models\Refund;
use App\Models\Treatment;
use Livewire\Component;
use App\Models\SellingInvoice;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class HistoryOrderDetailPage extends Component
{
    use WithFileUploads;
    public $invoiceId;  // To hold the invoice ID
    public $invoice;    // To hold the invoice data
    public $refundReason;
    public $refundFile;

    public function requestRefund()
    {
        // Validasi data form
        $validatedData = $this->validate([
            'refundReason' => 'required|string',
            'refundFile' => 'required|file|max:2048', // Batas ukuran file 2MB
        ]);

        // Cek apakah validasi berhasil

        // Menyimpan file dan membuat refund baru
        $path = $this->refundFile->store('refund-files', 'public');  // Menyimpan file di storage

        // Cek apakah file berhasil disimpan

        // Membuat refund baru
        $refund = Refund::create([
            'refund_reason' => $this->refundReason,
            'user_refund_file' => $path,
            'refund_status' => 'Pending',
        ]);

        // Cek apakah refund berhasil dibuat
        $idRefund = $refund->refund_id;
        // Update selling_invoice dengan refund_id
        $this->invoice->refund_id = $idRefund;  // Atau refund ID yang sesuai
        $this->invoice->save();  // Pastikan menggunakan save(), bukan update()


        redirect()->route('detailInvoice', $this->invoiceId);
        // Menampilkan pesan sukses
        session()->flash('success', 'Refund request submitted successfully.');
    }


    // The mount method will receive the invoice ID from the route
    public function mount($invoiceId)
    {
        $this->invoiceId = $invoiceId;  // Assign the parameter to the property

        // Fetch the invoice with details
        $this->invoice = SellingInvoice::with('details', 'refunds') // Load the invoice with its details
            ->where('selling_invoice_id', $this->invoiceId) // Ensure the invoice exists by its ID
            ->where('user_id', Auth::id()) // Ensure the invoice belongs to the correct user
            ->firstOrFail();  // This will fail if the invoice is not found

        // Loop untuk mendapatkan gambar produk
        foreach ($this->invoice->details as $detail) {
            // Clean the product name by removing size info (optional)
            $cleanedProductName = preg_replace('/\s*\(.*\)$/', '', $detail->product_name);

            // Find the product by cleaned name
            $product = Product::where('product_name', $cleanedProductName)->first();

            // If product exists, get the image from the product's description table
            if ($product) {
                $detail->product_image = $product->description->product_image ?? null; // Ensure 'description' is a valid relationship
            } else {
                $detail->product_image = null; // If product not found, set image as null
            }

            // Set treatment_image to null (or handle it separately if needed)
            $detail->treatment_image = null;
        }

        // Loop untuk mendapatkan gambar treatment
        foreach ($this->invoice->details as $detail) {
            // Clean the treatment name by removing size info (optional)
            $cleanedTreatmentName = preg_replace('/\s*\(.*\)$/', '', $detail->treatment_name);

            // Find the treatment by cleaned name
            $treatment = Treatment::where('treatment_name', $cleanedTreatmentName)->first();

            // If treatment exists, get the image from the treatment
            if ($treatment) {
                $detail->treatment_image = $treatment->description->treatment_image ?? null; // Ensure 'description' is a valid field
            } else {
                $detail->treatment_image = null; // If treatment not found, set image as null
            }
        }



    }

    // Method to handle order completion
    public function completeOrder()
    {
        // Change order status to 'Completed'
        if ($this->invoice->order_status !== 'Complete') {
            $this->invoice->update([
                'order_status' => 'Complete'
            ]);
        }

        // Optional: Display a success message or take other actions
        session()->flash('message', 'Order has been completed successfully.');
    }

    public function render()
    {
        return view('livewire.history-order-detail-page', [
            'invoice' => $this->invoice,
        ]);
    }
}
