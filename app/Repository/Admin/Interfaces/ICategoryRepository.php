<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Category;
use Illuminate\Support\Collection;

interface ICategoryRepository
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
     * @param Category $category
     * Insert Category
     *
     * @return Category
     */
    public function create(Category $category): Category;

    /**
     * @param int $id
     * Fetch Category by ID
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param Category $category
     * @param int $id
     *
     * @return Category
     */
    public function update(Category $category, int $id): Category;

    /**
     * @param Category $category
     * Delete Category
     *
     * @return mixed
     */
    public function delete(Category $category):bool;

}
