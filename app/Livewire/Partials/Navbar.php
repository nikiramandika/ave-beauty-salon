<?php

namespace App\Livewire\Partials;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        // Ambil semua kategori
        $categories = Category::limit(7)->get();

        // Ambil semua treatment dengan relasi description
        $treatments = Treatment::with('description')
            ->where('is_active', 1)
            ->get();

        // Return view dengan data kategori dan treatment
        return view('livewire.partials.navbar', [
            'categories' => $categories,
            'treatments' => $treatments,
        ]);
    }
}
