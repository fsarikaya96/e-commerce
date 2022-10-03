<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Collection;

interface ICategoryService
{
    /**
     * Get All Categories with Paginate Repository
     * @return mixed
     */
    public function getCategoriesWithPaginate(): mixed;

    /**
     * Get All Categories
     * @return Collection
     */
    public function getAllCategories():Collection;

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
