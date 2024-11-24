<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SellingInvoice;

class PaymentPage extends Component
{
    use WithFileUploads;

    public $invoiceId; // ID dari invoice yang akan diperbarui
    public $proofOfPayment; // File yang diunggah
    public $recipientBank; // Bank penerima untuk validasi atau informasi tambahan

    public function mount($invoiceId)
    {
        // Ambil data invoice berdasarkan ID
        $invoice = SellingInvoice::findOrFail($invoiceId);

        $this->invoiceId = $invoice->selling_invoice_id;
        $this->recipientBank = $invoice->recipient_bank;
    }
    public function uploadProofOfPayment()
    {
        // Validasi file
        $this->validate([
            'proofOfPayment' => 'required|image|max:2048', // Maksimal 2MB, harus berupa gambar
        ]);

        try {
            // Simpan file di folder public/proof_of_payments
            $filePath = $this->proofOfPayment->store('proof_of_payments', 'public');

            // Update kolom recipient_file di database
            $invoice = SellingInvoice::findOrFail($this->invoiceId);
            $invoice->update([
                'recipient_file' => $filePath,
            ]);

            // Berikan notifikasi sukses
            session()->flash('success', 'Proof of payment uploaded successfully!');

            // Emit event untuk redirect setelah 3 detik
            $this->dispatch('redirectAfterDelay');
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            session()->flash('error', 'An error occurred while uploading the proof of payment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $invoice = SellingInvoice::findOrFail($this->invoiceId);

        // Jika recipient_file sudah ada, redirect ke halaman lain
        if ($invoice->recipient_file) {
         redirect()->route('home')->with('error', 'Proof of payment has already been uploaded.');
        }

        return view('livewire.payment-page', [
            'invoice' => $invoice,
        ]);
    }

}
