<?php

namespace App\Services\Admin\Interfaces;

use App\Models\Color;

interface IColorService
{
    /**
     * Get All Colors
     * @return mixed
     */
    public function getAllColors(): mixed;

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
     * @return Color
     */
    public function getColorById(int $id):Color;


    /**
     * @param Color $color
     * @param int $id
     * Update Color
     * @return Color
     */
    public function update(Color $color, int $id) :Color;

    /**
     * @param int $id
     * Delete Color
     *
     * @return bool
     */
    public function delete(int $id) : bool;
}
