<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Promo;

class PromoPage extends Component
{
    public $promos; // Menyimpan data semua promo

    public function mount()
    {
        // Ambil semua promo yang aktif dan relasi description
        $this->promos = Promo::with('description')
            ->where('is_active', 1)
            ->get();
    }
    public function render()
    {
        return view('livewire.promo-page', [
            'promos' => $this->promos, // Mengirim data ke Blade
        ]);
    }
}
