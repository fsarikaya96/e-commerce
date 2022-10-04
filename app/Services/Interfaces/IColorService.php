<?php

namespace App\Services\Interfaces;

use App\Models\Color;
use Illuminate\Support\Collection;

interface IColorService
{
    /**
     * @return mixed
     * Get All Colors with Paginate Service
     */
    public function getColorsWithPaginate(): mixed;

    /**
     * Fetch Colors by Condition Service
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getColorsByCondition(array $condition): Collection;

    /**
     * Get Color By Product ID Service
     *
     * @param $productColor
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed;

    /**
     * @param Color $color
     * Insert Color Service
     *
     * @return Color
     */
    public function create(Color $color): Color;

    /**
     * @param int $id
     * Fetch Color by ID Service
     *
     * @return Color
     */
    public function getColorById(int $id): Color;


    /**
     * @param Color $color
     * @param int $id
     * Update Color Service
     *
     * @return Color
     */
    public function update(Color $color, int $id): Color;

    /**
     * @param int $id
     * Delete Color Service
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
