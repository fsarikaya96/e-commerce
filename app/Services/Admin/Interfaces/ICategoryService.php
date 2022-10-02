<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface ICategoryService
{
    /**
     * Get All Categories
     * @return mixed
     */
    public function getAllCategories(): mixed;

    /**
     * @param CategoryRequest $request
     * Insert Category
     *
     * @return Category
     */
    public function create(CategoryRequest $request): Category;

    /**
     * @param int $id
     * Fetch category by id
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param CategoryRequest $request
     * @param int $id
     * Update Category
     * @return Category
     */
    public function update(CategoryRequest $request, int $id): Category;

    /**
     * @param int $id
     * Delete Category
     * @return mixed
     */
    public function delete(int $id):bool;

}
