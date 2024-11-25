<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SellingInvoice;
use Illuminate\Support\Facades\Auth;

class PaymentPage extends Component
{
    use WithFileUploads;

    public $invoiceId; // ID dari invoice yang akan diperbarui
    public $proofOfPayment; // File yang diunggah
    public $recipientBank; // Bank penerima untuk validasi atau informasi tambahan

    public function mount($invoiceId)
    {
        // Ambil data invoice berdasarkan ID
        $invoice = SellingInvoice::where('selling_invoice_id', $invoiceId)
                    ->where('user_id', Auth::id()) // Pastikan hanya user yang memiliki invoice dapat mengakses
                    ->firstOrFail();

                            // Jika recipient_file sudah ada, redirect ke halaman lain
        if ($invoice->recipient_file) {
            return redirect()->route('home'); // Perbaiki penggunaan redirect di sini
        }

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

            // Pastikan user hanya bisa memperbarui invoice miliknya
            if ($invoice->user_id !== Auth::id()) {
                session()->flash('error', 'Unauthorized action.');
                return;
            }

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
        $invoice = SellingInvoice::where('selling_invoice_id', $this->invoiceId)
                    ->where('user_id', Auth::id()) // Pastikan hanya user yang memiliki invoice dapat melihat
                    ->firstOrFail();
    

    
        return view('livewire.payment-page', [
            'invoice' => $invoice,
        ]);
    }
    
}
