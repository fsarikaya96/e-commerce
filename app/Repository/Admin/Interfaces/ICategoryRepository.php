<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Category;

interface ICategoryRepository
{
    /**
     * Get All Categories Repository
     * @return mixed
     */
    public function getAllCategories();

    /**
     * @param Category $category
     * Insert Category
     *
     * @return Category
     */
    public function create(Category $category): Category;

    /**
     * @param int $id
     *
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
