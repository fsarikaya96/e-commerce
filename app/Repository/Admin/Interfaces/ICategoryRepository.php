<?php

namespace App\Repository\Admin\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

interface ICategoryRepository
{
    /**
     * Get All Categories Repository
     */
    public function getAllCategories();

    /**
     * Insert Category
     */
    public function create(Category $category) : Category;

    /**
     * Update Category
     */
    public function update(Category $category, $category_id) : Category;

    /**
     * Delete Category
     */
    public function delete($category_id);

}
