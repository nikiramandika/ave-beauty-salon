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
        try {
            // Menambahkan item ke keranjang
            CartManagement::addItemToCart($product_id, 1, $detail_id);

            // Emit event untuk memperbarui status keranjang
            $this->dispatch('cartUpdated');

            // Kirim pesan sukses
            session()->flash('success', 'Product added to cart successfully.');

            // Emit event sukses
            $this->dispatch('addToCartSuccess');
        } catch (\Exception $e) {
            // Tangani error jika ada masalah
            if (strpos($e->getMessage(), 'Quantity exceeds available stock') !== false) {
                session()->flash('error', 'Quantity exceeds available stock.');
            } else {
                session()->flash('error', 'Something went wrong, please try again.');
            }

            // Emit event error
            $this->dispatch('addToCartError');
        }
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}
