<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Treatment;

class TreatmentPage extends Component
{
    public $treatments; // Menyimpan data semua treatment

    public function mount()
    {
        // Ambil semua treatment yang aktif dan relasi description
        $this->treatments = Treatment::with('description')
            ->where('is_active', 1)
            ->get();
    }

    public function render()
    {
        return view('livewire.treatment-page', [
            'treatments' => $this->treatments, // Mengirim data ke Blade
        ]);
    }
}
