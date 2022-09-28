<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Index extends Component
{
    public $product_id;

    public function render()
    {
        $products = Product::all();

        return view('livewire.admin.product.index', ['products' => $products]);
    }

    public function deleteProduct(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $product = Product::findOrFail($this->product_id);
        if ($product->productImages()) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        session()->flash('message', 'Ürün Başarıyla Silindi');
        $this->dispatchBrowserEvent('close-modal');
    }
}
