<?php
namespace App\Livewire;

use DB;
use Livewire\Component;
use App\Models\Category;
use App\Models\Treatment;

class HomePage extends Component
{
    public function render()
    {

        // Ambil semua kategori
        $categories = Category::all();

        // Ambil semua treatment dengan relasi description
        $treatments = Treatment::with('description')
            ->where('is_active', 1)
            ->get();

        // Return view dengan data kategori dan treatment
        return view('livewire.home-page', [
            'categories' => $categories,
            'treatments' => $treatments,
        ]);
    }
}
