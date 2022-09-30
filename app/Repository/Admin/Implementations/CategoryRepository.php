<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Category;
use App\Repository\Admin\Interfaces\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    /**
     * Get All Categories
     */
    public function getAllCategories()
    {
        return Category::orderBy('id','DESC')->paginate(10);
    }
}
