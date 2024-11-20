<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ShopPage extends Component
{
    public function render()
    {
        // Ambil semua produk yang aktif
        $products = Product::where('is_active', 1)
            ->with(['details', 'description', 'category'])
            ->get();

        // Menentukan kategori produk yang terkait untuk menampilkan produk terkait
        // Misalnya, mengambil produk dengan kategori yang sama atau produk lain yang aktif
        $relatedProducts = Product::where('is_active', 1)
            ->whereHas('category', function ($query) use ($products) {
                // Mengambil kategori produk pertama dari daftar produk yang ada
                $query->where('category_id', $products->first()->category_id);
            })
            ->with(['details', 'description', 'category'])
            ->limit(4)  // Batasi jumlah produk terkait, misalnya 4
            ->get();

        return view('livewire.shop-page', compact('products', 'relatedProducts'));
    }
}
