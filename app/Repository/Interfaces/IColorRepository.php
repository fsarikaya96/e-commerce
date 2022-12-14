<?php

namespace App\Repository\Interfaces;

use App\Models\Color;
use Illuminate\Support\Collection;

interface IColorRepository
{
    /**
     * @return mixed
     * Get All Colors with Paginate Repository
     */
    public function getColorsWithPaginate(): mixed;

    /**
     * Fetch Colors by Condition Repository
     *
     * @param array $condition
     *
     * @return Collection
     */
    public function getColorsByCondition(array $condition): Collection;

    /**
     * Get Color By Product ID Repository
     *
     * @param $productColor
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed;

    /**
     * @param Color $color
     * Insert Color Repository
     *
     * @return Color
     */

    public function create(Color $color): Color;

    /**
     * @param int $id
     * Fetch Color by ID Repository
     *
     * @return Color
     */
    public function getColorById(int $id): Color;

    /**
     * @param Color $color
     * @param int $id
     * Update Color Repository
     *
     * @return Color
     */
    public function update(Color $color, int $id): Color;

    /**
     * @param Color $color
     * Delete Color Repository
     *
     * @return bool
     */
    public function delete(Color $color): bool;
}
