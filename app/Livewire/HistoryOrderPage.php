<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SellingInvoice;
use Illuminate\Support\Facades\Auth;

class HistoryOrderPage extends Component
{
    use WithPagination;

    public $search = '';  // Variabel pencarian

    // Ambil data invoice dan detailnya berdasarkan user_id yang sama dengan Auth::id()
    public function submitSearch()
    {
        $this->resetPage(); // Reset pagination saat pencarian dimulai
    }

    public function render()
    {
        // Start with the base query
        $query = SellingInvoice::with('details')
            ->where('user_id', Auth::id());

        // Apply search filter if there's a search term
        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('invoice_code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('details', function ($query) {
                        $query->where('product_name', 'like', '%' . $this->search . '%')
                            ->orWhere('treatment_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Exclude invoices with course_name in selling_invoice_details
        $query->whereDoesntHave('details', function ($query) {
            $query->whereNotNull('course_name');
        });

        // First, add a condition to prioritize invoices where recipient_address is not "Pesanan Offline" 
        // or recipient_file is not null
        $query->orderByRaw("CASE 
        WHEN order_status != 'complete' THEN 0 
        WHEN recipient_address != 'Pesanan Offline' AND recipient_file IS NOT NULL THEN 1
        ELSE 2
    END");


        // Then, apply the order by 'order_date' (descending or ascending as needed)
        $invoices = $query->orderBy('order_date', 'desc') // Change 'desc' to 'asc' for ascending order
            ->paginate(10);

        // Check if there are no invoices and add a message to display
        $message = $invoices->isEmpty() ? "Pesan yang Anda cari tidak ada." : null;

        return view('livewire.history-order-page', [
            'invoices' => $invoices,
            'message' => $message, // Pass the message to the view
        ]);
    }


}
