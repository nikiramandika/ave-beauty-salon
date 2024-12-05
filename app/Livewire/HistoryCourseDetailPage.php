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

    public $invoiceCode;
    public $invoice;
    public $refundReason;
    public $refundFile;
    public $invoiceDetails;
    public $courseDetails;


    // Menangani pengajuan refund
    public function requestRefund()
    {
        $validatedData = $this->validate([
            'refundReason' => 'required|string',
            'refundFile' => 'required|file|max:2048',
        ]);

        $path = $this->refundFile->store('refund-files', 'public');

        $refund = $this->invoice->refunds()->create([
            'refund_reason' => $this->refundReason,
            'user_refund_file' => $path,
            'refund_status' => 'Pending',
        ]);

        $this->invoice->update(['refund_id' => $refund->id]);

        session()->flash('success', 'Refund request submitted successfully.');
        return redirect()->route('detailCourse', $this->invoiceCode);
    }

    // Menangani perubahan status order menjadi Complete
    public function completeOrder()
    {
        if ($this->invoice->order_status !== 'Complete') {
            $this->invoice->update(['order_status' => 'Complete']);
        }

        session()->flash('message', 'Order has been completed successfully.');
    }

    public function mount($invoiceCode)
    {
        $courseHistory = DB::table('course_history1')
        ->where('invoice_code', $invoiceCode)
        ->first();

        if ($courseHistory) {
        $invoice = DB::table('selling_invoices')
            ->where('invoice_code', $invoiceCode)
            ->first();

        if ($invoice) {
            $sellingInvoiceId = $invoice->selling_invoice_id;

            $invoiceDetails = DB::table('selling_invoice_details')
                ->where('invoice_id', $sellingInvoiceId)
                ->get();

            $this->invoiceDetails = $invoiceDetails;
            $this->invoice = $invoice;

            // Ambil detail course menggunakan course_id
            $courseDetails = DB::table('courses')
                ->where('course_id', $courseHistory->course_id) // Ubah dari `id` menjadi `course_id`
                ->first();

            if ($courseDetails) {
                $this->courseDetails = $courseDetails;
            } else {
                session()->flash('error', 'Course details not found.');
                return redirect()->route('course-history');
            }
        } else {
            session()->flash('error', 'Invoice data not found.');
            return redirect()->route('course-history');
        }
        } else {
        session()->flash('error', 'Course history not found.');
        return redirect()->route('course-history');
        }
    }

    public function render()
    {
        return view('livewire.history-course-detail-page', [
        'invoice' => $this->invoice,
        'details' => $this->invoiceDetails,
        ]);
    }
}
