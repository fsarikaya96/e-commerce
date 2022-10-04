<?php

namespace App\Repository\Interfaces;

use App\Models\Slider;

interface ISliderRepository
{
    /**
     * Get All Sliders with Paginate Repository
     * @return mixed
     */
    public function getSlidersWithPaginate(): mixed;


    /**
     * @param int $id
     * Fetch Slider by ID Repository
     *
     * @return Slider
     */
    public function getSliderById(int $id): Slider;

    /**
     * @param Slider $slider
     * @param int $id
     * Update Slider Repository
     *
     * @return Slider
     */
    public function update(Slider $slider, int $id): Slider;

    /**
     * @param Slider $slider
     * Insert Slider Repository
     *
     * @return Slider
     */
    public function create(Slider $slider): Slider;

    /**
     * @param Slider $slider
     * Delete Slider Repository
     *
     * @return bool
     */
    public function delete(Slider $slider): bool;
}
