<?php

namespace App\Livewire;

use App\Models\Product;
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

    public function addToCart($product_id)
    {
        CartManagement::addItemToCart($product_id);
        $this->dispatch('cartUpdated'); // Emit event untuk memberi tahu komponen lain
    }


    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}
