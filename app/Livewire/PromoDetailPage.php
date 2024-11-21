<?php

namespace App\Livewire;

use App\Models\Promo;
use Livewire\Component;

class PromoDetailPage extends Component
{
    public $promo;
    public $treatments;

    public function mount($promo_slug)
    {
        // Ambil promo berdasarkan slug dan muat treatments
        $this->promo = Promo::where('promo_slug', $promo_slug)
            ->where('is_active', 1) // Filter hanya promo yang aktif
            ->with(['description', 'treatments']) // Muat relasi treatments
            ->firstOrFail();
    }



    public function render()
    {
        return view('livewire.promo-detail-page', [
            'promo' => $this->promo,
            'treatments' => $this->treatments, // Kirim data treatments ke view
        ]);
    }
}
