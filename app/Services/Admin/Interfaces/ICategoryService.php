<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface ICategoryService
{
    /**
     * Get All Categories Service
     * @return mixed
     */
    public function getAllCategories();

    /**
     * @param CategoryRequest $request
     * Insert Category
     *
     * @return Category
     */
    public function create(CategoryRequest $request): Category;

    /**
     * @param int $id
     *
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param CategoryRequest $request
     * @param int $id
     *
     * @return Category
     */
    public function update(CategoryRequest $request, int $id): Category;

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id):bool;

}
