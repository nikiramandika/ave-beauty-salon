<?php

namespace App\Livewire;

use App\Models\Treatment;
use Livewire\Component;

class TreatmentDetailPage extends Component
{
    public $treatment;

    public function mount($treatment_slug)
    {
        // Ambil produk berdasarkan slug dan status aktif
        $this->treatment = Treatment::where('treatment_slug', $treatment_slug)
            ->where('is_active', 1) // Filter hanya produk yang aktif
            ->with(['description']) // Load relasi
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404
    }

    public function render()
    {
        return view('livewire.treatment-detail-page', [
            'treatment' => $this->treatment, // Kirim data produk ke view
        ]);
    }
}
