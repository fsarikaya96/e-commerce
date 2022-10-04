<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Services\Interfaces\IProductService;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceSort;
    private IProductService $productService;
    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceSort'   => ['except' => '', 'as' => 'price']
    ];

    public function boot(IProductService $IProductService)
    {
        $this->productService = $IProductService;
    }

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->products = $this->productService
            ->getProductsByCondition(['category_id' => $this->category->id, 'status' => 1],
                $this->brandInputs,
                $this->priceSort)->get();

        return view(
            'livewire.frontend.product.index',
            [
                'products' => $this->products,
                'category' => $this->category
            ]
        );
    }
}
