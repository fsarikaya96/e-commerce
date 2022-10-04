<?php

namespace App\Services\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Collection;

interface ICategoryService
{
    /**
     * Get All Categories with Paginate Service
     * @return mixed
     */
    public function getCategoriesWithPaginate(): mixed;

    /**
     * Fetch Categories by Condition Service
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getCategoriesByCondition(array $condition): Collection;

    /**
     * @param CategoryRequest $request
     * Insert Category Service
     *
     * @return Category
     */
    public function create(CategoryRequest $request): Category;

    /**
     * @param int $id
     * Fetch category by id Service
     *
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param CategoryRequest $request
     * @param int $id
     * Update Category Service
     *
     * @return Category
     */
    public function update(CategoryRequest $request, int $id): Category;

    /**
     * @param int $id
     * Delete Category Service
     *
     * @return mixed
     */
    public function delete(int $id): bool;

}
