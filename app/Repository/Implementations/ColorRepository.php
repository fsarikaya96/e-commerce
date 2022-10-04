<?php

namespace App\Repository\Implementations;

use App\Models\Color;
use App\Repository\Interfaces\IColorRepository;
use Illuminate\Support\Collection;

class ColorRepository implements IColorRepository
{
    /**
     * Get All Colors with Paginate Repository
     * @return mixed
     */
    public function getColorsWithPaginate(): mixed
    {
        return Color::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param array $condition
     * Fetch Colors by Condition Repository
     *
     * @return Collection
     */
    public function getColorsByCondition(array $condition): Collection
    {
        return Color::where($condition)->get();
    }

    /**
     * @param $productColor
     * Get Color By Product ID Repository
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed
    {
        return Color::whereNotIn('id', $productColor)->get();
    }

    /**
     * @param Color $color
     * Insert Color Repository
     *
     * @return Color
     */
    public function create(Color $color): Color
    {
        $color->status = $color->status ? 1 : 0;

        $color->save();

        return $color;
    }

    /**
     * @param int $id
     * Fetch Color by ID Repository
     *
     * @return Color
     */
    public function getColorById(int $id): Color
    {
        return Color::findOrfail($id);
    }

    /**
     * @param Color $color
     * @param int $id
     * Update Color Repository
     *
     * @return Color
     */
    public function update(Color $color, int $id): Color
    {
        $color->save();

        return $color;
    }

    /**
     * @param Color $color
     * Delete Color Repository
     *
     * @return bool
     */
    public function delete(Color $color): bool
    {
        return $color->delete();
    }
}
