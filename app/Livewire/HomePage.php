<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class HomePage extends Component
{
    public function render()
    {
        // Ambil semua produk yang aktif
        $products = Product::where('is_active', 1)
            ->with(['details', 'description', 'category']) // Sertakan relasi
            ->get();

        // Menentukan produk populer berdasarkan kategori produk pertama
        $popularProducts = collect(); // Default jika tidak ada produk
        if ($products->isNotEmpty()) {
            $popularProducts = Product::where('is_active', 1)
                ->whereHas('category', function ($query) use ($products) {
                    $query->where('category_id', $products->first()->category_id);
                })
                ->with(['details', 'description', 'category'])
                ->limit(8) // Batasi jumlah produk populer
                ->get();
        }

        // Ambil semua kategori
        $categories = Category::all();

        return view('livewire.home-page', [
            'products' => $products,
            'popularProducts' => $popularProducts,
            'categories' => $categories,
        ]);
    }
}
