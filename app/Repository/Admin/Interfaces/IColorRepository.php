<?php

namespace App\Repository\Admin\Interfaces;

use App\Models\Color;

interface IColorRepository
{
    /**
     * @return mixed
     * Get All Colors
     */
    public function getAllColors():mixed;

    /**
     * @param Color $color
     * Insert Color
     * @return Color
     */
    public function create(Color $color):Color;

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
     * @param Color $color
     * Delete Color
     * @return bool
     */
    public function delete(Color $color) : bool;
}
