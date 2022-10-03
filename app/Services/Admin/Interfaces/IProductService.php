<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Collection;

interface IProductService
{
    /**
     * Get All Products with Paginate Repository
     * @return mixed
     */
    public function getProductWithPaginate():mixed;

    /**
     * Fetch Product by ID
     *
     * @param int $id
     *
     * @return Product
     */
    public function getProductById(int $id): Product;


}
