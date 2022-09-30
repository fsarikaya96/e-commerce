<?php

namespace App\Services\Admin\Implementations;

use App\Repository\Admin\Interfaces\ICategoryRepository;
use App\Services\Admin\Interfaces\ICategoryService;

class CategoryService implements ICategoryService
{
    private ICategoryRepository $categoryRepository;

    /**
     * CategoryRepository constructor injection
     * @param ICategoryRepository $ICategoryRepository
     */
    public function __construct(ICategoryRepository $ICategoryRepository)
    {
        $this->categoryRepository = $ICategoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }
}
