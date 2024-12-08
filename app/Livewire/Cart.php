<?php

namespace App\Livewire;

use Illuminate\Database\QueryException;
use Livewire\Component;
use App\Helpers\CartManagement;

class Cart extends Component
{
    public $cartItems = [];
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'loadCartItems'];

    public function mount()
    {
        $this->loadCartItems();
    }

    public function loadCartItems()
    {
        if (auth()->check()) {
            $this->cartItems = CartManagement::getCartItems();
            $this->cartCount = collect($this->cartItems)->sum('quantity');
        } else {
            $this->cartItems = [];
            $this->cartCount = 0;
        }
    }

    public function increaseQuantity($cart_item_id)
    {
        if (auth()->check()) {
            try {
                // Mencoba untuk meningkatkan jumlah item dalam cart
                CartManagement::incrementItemQuantityByCartItemId($cart_item_id);

                // Jika berhasil, kirimkan event untuk memperbarui cart
                $this->dispatch('cartUpdated');
                $this->loadCartItems();
            } catch (QueryException $e) {
                // Menangkap exception yang dilempar oleh trigger
                if (strpos($e->getMessage(), 'Quantity exceeds available stock') !== false) {
                    // Kirim pesan error jika quantity melebihi stok
                    session()->flash('error', 'Quantity exceeds available stock.');
                } else {
                    // Tangani error lainnya
                    session()->flash('error', 'Something went wrong, please try again.');
                }
            }
        }
    }

    public function decreaseQuantity($cart_item_id)
    {
        if (auth()->check()) {
            CartManagement::decrementItemQuantityByCartItemId($cart_item_id);
            $this->dispatch('cartUpdated');
            $this->loadCartItems();
        }
    }

    public function removeFromCart($cart_item_id)
    {
        if (auth()->check()) {
            CartManagement::removeItemFromCartByCartItemId($cart_item_id);
            $this->dispatch('cartUpdated');
            $this->loadCartItems();
        }
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
