<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\CartManagement;

class CheckoutPage extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;

    protected $listeners = ['cartUpdated' => 'loadCartData']; // Dengarkan event 'cartUpdated'

    public function mount()
    {
        $this->loadCartData();
    }

    public function loadCartData()
    {
        if (auth()->check()) {
            $this->cartItems = CartManagement::getCartItems();
            $this->cartTotal = $this->cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        } else {
            $this->cartItems = [];
            $this->cartTotal = 0;
        }
    }

    public function render()
    {
        return view('livewire.checkout-page', [
            'cartItems' => $this->cartItems,
            'cartTotal' => $this->cartTotal,
        ]);
    }
}
