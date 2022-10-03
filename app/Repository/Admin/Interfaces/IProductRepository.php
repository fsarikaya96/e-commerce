<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface IProductRepository
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
    public function getProductById(int $id):Product;



}
