<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Color;
use App\Repository\Admin\Interfaces\IColorRepository;

class ColorRepository implements IColorRepository
{
    /**
     * Get All Colors
     * @return mixed
     */
    public function getAllColors(): mixed
    {
        return Color::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param Color $color
     * Insert Color
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
     * Fetch Color by ID
     * @return Color
     */
    public function getColorById(int $id): Color
    {
        return Color::findOrfail($id);
    }

    /**
     * @param Color $color
     * @param int $id
     * Update Color
     * @return Color
     */
    public function update(Color $color, int $id): Color
    {
        $color->save();

        return $color;
    }

    /**
     * @param Color $color
     * Delete Color
     *
     * @return bool
     */
    public function delete(Color $color): bool
    {
        return $color->delete();
    }
}
