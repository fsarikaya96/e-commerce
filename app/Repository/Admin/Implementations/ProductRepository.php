<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Repository\Admin\Interfaces\IProductRepository;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductWithPaginate(): mixed
    {
        return Product::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param int $id
     * Fetch Product by ID
     *
     * @return Product
     */
    public function getProductById(int $id): Product
    {
        return Product::findOrFail($id);
    }

}
