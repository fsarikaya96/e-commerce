<?php

namespace App\Services\Admin\Implementations;

use App\Models\Product;
use App\Repository\Admin\Implementations\ProductRepository;
use App\Repository\Admin\Interfaces\IProductRepository;
use App\Services\Admin\Interfaces\IProductService;


class ProductService implements IProductService
{
    private ProductRepository $productRepository;

    public function __construct(IProductRepository $IProductRepository)
    {
        $this->productRepository = $IProductRepository;
    }


    public function getProductWithPaginate(): mixed
    {
        return $this->productRepository->getProductWithPaginate();
    }

    public function getProductById(int $id): Product
    {
        return $this->productRepository->getProductById($id);
    }
}
