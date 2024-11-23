<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Component;
use App\Helpers\CartManagement;

class ProductDetailPage extends Component
{
    public $product;

    public function mount($product_slug)
    {
        $this->product = Product::where('product_slug', $product_slug)
            ->where('is_active', 1)
            ->with(['description', 'details'])
            ->firstOrFail();
    }

    public function addToCart($product_id, $detail_id)
    {
        // Gunakan CartManagement untuk menambahkan item ke keranjang
        CartManagement::addItemToCart($product_id, 1, $detail_id);

        // Emit event untuk memperbarui keranjang
        $this->dispatch('cartUpdated');
    }




    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}
