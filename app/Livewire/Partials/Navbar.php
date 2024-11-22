<?php
namespace App\Livewire\Partials;

use App\Models\Category;
use Livewire\Component;

class Navbar extends Component
{
    public $categories = [];
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->categories = Category::limit(7)->get();
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartCount = auth()->check() ? \App\Helpers\CartManagement::getCartItems()->sum('quantity') : 0;
    }

    public function render()
    {
        return view('livewire.partials.navbar', [
            'categories' => $this->categories,
        ]);
    }
}
