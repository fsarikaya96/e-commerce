<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceSort;


    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceSort'   => ['except' => '', 'as' => 'price']
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
                                 ->when($this->brandInputs, function ($query) {
                                     $query->whereIn('brand', $this->brandInputs);
                                 })
                                 ->when($this->priceSort, function ($query) {

                                     $query->when($this->priceSort == 'high-to-low',function ($queryPrice){
                                            $queryPrice->orderBy('selling_price','DESC');
                                     })->when($this->priceSort == 'low-to-high',function ($queryPrice){
                                            $queryPrice->orderBy('selling_price','ASC');
                                     });
                                 })
                                 ->where('status', 1)
                                 ->get();

        return view(
            'livewire.frontend.product.index',
            [
                'products' => $this->products,
                'category' => $this->category
            ]
        );
    }
}
