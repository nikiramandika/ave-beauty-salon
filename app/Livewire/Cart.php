<?php

namespace App\Livewire;

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
            CartManagement::incrementItemQuantityByCartItemId($cart_item_id);
            $this->dispatch('cartUpdated');
            $this->loadCartItems();
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
