<?php

namespace App\Http\Livewire;

use App\Helper;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    public $search;

    public $category, $categoryName;
    protected $listeners = ['render'];

    public function render()
    {
        //$this->tipoCambioMoneda();
        $products = Product::where('name', 'like', '%' . $this->search . '%')->latest('id')->get();

        $categories = Category::all();
        $this->category = Category::where('slug', $this->categoryName)
            ->orWhere('name', $this->categoryName)
            ->first();

        $registeredIds = session('registered_ids', []);

        return view('livewire.navigation', compact('categories', 'products'));
    }

}
