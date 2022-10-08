<?php

namespace App\Http\Livewire\Admin\Product;

use App\Services\Interfaces\IProductService;
use Flasher\Prime\FlasherInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public $product_id;

    private IProductService $productService;
    private FlasherInterface $flasher;
    public function boot(IProductService $IProductService, FlasherInterface $IFlasherInterface)
    {
        $this->productService = $IProductService;
        $this->flasher = $IFlasherInterface;
    }

    public function render()
    {
        $products = $this->productService->getProductsWithPaginate();

        return view('livewire.admin.product.index', ['products' => $products]);
    }

    public function deleteProduct(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $this->productService->delete($this->product_id);
        $this->flasher->addSuccess('Ürün Başarıyla Silindi!');
        $this->dispatchBrowserEvent('close-modal');
    }
}
