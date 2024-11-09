<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TableProducts extends Component
{
    use WithPagination;

    public $isOpen = false, $ruteCreate = false;
    public $productState, $productCategory, $amount = 5;
    public $search, $product;
    public $images = [];
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'product.name' => 'required',
        'product.slug' => 'required',
        'product.stock' => 'required',
        'product.state' => 'required',
        'product.category_id' => 'required',
    ];

    public function render()
    {
        $this->product['user_id'] = auth()->user()->id;

        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->when($this->productState, fn($query) => $query->where('state', $this->productState))
            ->when($this->productCategory, fn($query) => $query->where('category_id', $this->productCategory))
            ->latest('id')
            ->paginate($this->amount);

        if (App::getLocale() == 'en') {
            $translator = new GoogleTranslate();
            $translator->setSource('es')->setTarget('en');

            foreach ($products as $product) {
                $this->translateProduct($product, $translator);
            }
        }
        $categories = Category::all();
        return view('admin.pages.table-products', compact('products', 'categories'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset('product');
    }

    public function store()
    {
        $this->validate();

        if (App::getLocale() == 'en') {
            $translator = new GoogleTranslate();
            $translator->setSource('en')->setTarget('es');
            $this->product['name'] = $translator->translate($this->product['name']);
            $this->product['slug'] = Str::slug($translator->translate($this->product['name']));
        }

        if (!isset($this->product['id'])) {
            $product = Product::create($this->product);
            $this->emit('alert', 'Registro creado satisfactoriamente');
        } else {
            $product = Product::find($this->product['id']);
            $this->invalidateProductCache($product);
            $product->update($this->product);
            $this->emit('alert', 'Registro actualizado satisfactoriamente');
        }
        $this->reset(['isOpen', 'product']);
        $this->emitTo('Products', 'render');
    }

    public function updatedProductName()
    {
        $this->product['slug'] = Str::slug($this->product['name']);
    }

    public function edit($product)
    {
        $this->product = array_slice($product, 0, 7);
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function delete($id)
    {
        Product::find($id)->delete();
    }

    private function invalidateProductCache($product)
    {
        Cache::forget('product_name_' . $product->id);
        Cache::forget('product_slug_' . $product->id);
        Cache::forget('product_category_' . $product->id);
    }

    private function translateProduct($product, $translator)
    {
        $product->name = $this->getTranslatedValue('product_name_' . $product->id, $translator, $product->name);
        $product->slug = $this->getTranslatedValue('product_slug_' . $product->id, $translator, Str::slug($product->name));
        $product->category = $this->getTranslatedValue('product_category_' . $product->id, $translator, $product->category);
    }

    private function getTranslatedValue($cacheKey, $translator, $value)
    {
        return Cache::rememberForever($cacheKey, function () use ($translator, $value) {
            return $translator->translate($value);
        });
    }
}
