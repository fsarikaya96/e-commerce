<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface ICategoryService
{
    /**
     * Get All Categories Service
     */
    public function getAllCategories();

    /**
     * Insert Category
     */
    public function create(CategoryRequest $request) : Category;

    /**
     * Update Category
     */
    public function update(CategoryRequest $request,$category_id) : Category;

    /**
     * Delete Category
     */
    public function delete($category_id);

}
