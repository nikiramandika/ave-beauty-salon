<?php
namespace App\Livewire\Partials;

use App\Models\Category;
use App\Helpers\CartManagement;
use Livewire\Component;

class Navbar extends Component
{
    public $categories = [];
    public $cartItems = [];
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'loadCartItems'];

    public function mount()
    {
        $this->categories = Category::limit(7)->get();
        $this->loadCartItems();
    }

    public function loadCartItems()
    {
        if (auth()->check()) {
            $this->cartItems = CartManagement::getCartItems();
            $this->cartCount = $this->cartItems->sum('quantity');
        } else {
            $this->cartItems = [];
            $this->cartCount = 0;
        }
    }


    public function increaseQuantity($cart_item_id)
    {
        if (auth()->check()) {
            CartManagement::incrementItemQuantityByCartItemId($cart_item_id);
            $this->loadCartItems();
            $this->dispatch('keepOffcanvasOpen');
            $this->dispatch('keepBackdrop'); // Memastikan backdrop tetap aktif
        }
    }

    public function decreaseQuantity($cart_item_id)
    {
        if (auth()->check()) {
            CartManagement::decrementItemQuantityByCartItemId($cart_item_id);
            $this->loadCartItems();
            $this->dispatch('keepOffcanvasOpen');
            $this->dispatch('keepBackdrop'); // Memastikan backdrop tetap aktif

        }
    }

    public function removeFromCart($cart_item_id)
    {
        if (auth()->check()) {
            CartManagement::removeItemFromCartByCartItemId($cart_item_id);
            $this->loadCartItems();
            $this->dispatch('keepOffcanvasOpen');
            $this->dispatch('keepBackdrop'); // Memastikan backdrop tetap aktif

        }
    }

    public function render()
    {
        return view('livewire.partials.navbar', [
            'categories' => $this->categories,
            'cartItems' => $this->cartItems,
        ]);
    }
}
