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
     * Fetch Categories by Condition
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getCategoriesByCondition(array $condition):Collection;

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
