<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductDetailPage extends Component
{
    public $product;

    public function mount($product_slug)
    {
        // Ambil produk berdasarkan slug dan status aktif
        $this->product = Product::where('product_slug', $product_slug)
            ->where('is_active', 1) // Filter hanya produk yang aktif
            ->with(['description', 'details']) // Load relasi
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product, // Kirim data produk ke view
        ]);
    }
}
