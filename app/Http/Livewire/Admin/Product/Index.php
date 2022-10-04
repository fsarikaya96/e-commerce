<?php

namespace App\Http\Livewire\Admin\Product;

use App\Services\Interfaces\IProductService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public $product_id;

    private IProductService $productService;

    public function boot(IProductService $IProductService)
    {
        $this->productService = $IProductService;
    }

    public function render()
    {
        $products = $this->productService->getProductWithPaginate();

        return view('livewire.admin.product.index', ['products' => $products]);
    }

    public function deleteProduct(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $this->productService->delete($this->product_id);
        session()->flash('livewire_message', 'Ürün Başarıyla Silindi');
        $this->dispatchBrowserEvent('close-modal');
    }
}
