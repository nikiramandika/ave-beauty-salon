<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductPage extends Component
{
    public function render(Request $request)
    {
        // Ambil parameter kategori dari URL
        $categorySlug = $request->input('category');

        // Query produk berdasarkan kategori (slug)
        $query = Product::where('is_active', 1)->with(['details', 'description', 'category']);
        if ($categorySlug) {
            $query->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('category_slug', $categorySlug);
            });
        }
        $products = $query->get();

        // Ambil semua kategori
        $categories = Category::all();

        return view('livewire.product-page', compact('products', 'categories'));
    }
}


