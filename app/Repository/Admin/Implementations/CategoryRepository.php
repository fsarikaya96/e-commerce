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
        return Category::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param Category $category
     * Insert Category
     * @return Category
     */
    public function create(Category $category) : Category
    {
        $category->save();
        return $category;
    }

    public function update(Category $category, $category_id): Category
    {
       $category->save();
       return $category;
    }

    public function delete($category_id)
    {
        return Category::find($category_id)->delete();
    }
}
