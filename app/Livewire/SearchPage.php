<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Treatment;
use Illuminate\Support\Collection;

class SearchPage extends Component
{
    public $query = ''; // Default query adalah string kosong
    public Collection $products; // Data produk
    public Collection $treatments; // Data treatment

    protected $queryString = ['query']; // Binding ke parameter URL

    public function mount()
    {
        // Defaultkan koleksi kosong
        $this->products = collect([]);
        $this->treatments = collect([]);

        if ($this->query) {
            // Ambil data produk dan treatment berdasarkan query
            $this->products = Product::where('is_active', 1)
                ->where('product_name', 'like', '%' . $this->query . '%')
                ->orWhereHas('description', function ($q) {
                    $q->where('product_name', 'like', '%' . $this->query . '%');
                })
                ->get();

            $this->treatments = Treatment::where('is_active', 1)
                ->where('treatment_name', 'like', '%' . $this->query . '%')
                ->orWhereHas('description', function ($q) {
                    $q->where('treatment_name', 'like', '%' . $this->query . '%');
                })
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.search-page');
    }
}
