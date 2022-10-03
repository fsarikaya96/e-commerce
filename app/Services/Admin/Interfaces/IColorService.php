<?php

namespace App\Services\Admin\Interfaces;

use App\Models\Color;
use Illuminate\Support\Collection;

interface IColorService
{
    /**
     * @return mixed
     * Get All Colors with Paginate
     */
    public function getColorsWithPaginate(): mixed;

    /**
     * Fetch Colors by Condition
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getColorsByCondition(array $condition): Collection;

    /**
     * Get Color By Product ID
     *
     * @param $productColor
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed;

    /**
     * @param Color $color
     * Insert Color
     *
     * @return Color
     */
    public function create(Color $color): Color;

    /**
     * @param int $id
     * Fetch Color by ID
     *
     * @return Color
     */
    public function getColorById(int $id): Color;


    /**
     * @param Color $color
     * @param int $id
     * Update Color
     *
     * @return Color
     */
    public function update(Color $color, int $id): Color;

    /**
     * @param int $id
     * Delete Color
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
