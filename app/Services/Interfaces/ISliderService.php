<?php

namespace App\Services\Interfaces;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;

interface ISliderService
{
    /**
     * Get All Sliders with Paginate Service
     * @return mixed
     */
    public function getSlidersWithPaginate(): mixed;

    /**
     * @param int $id
     * Fetch Slider by ID Service
     *
     * @return Slider
     */
    public function getSliderById(int $id): Slider;

    /**
     * @param SliderRequest $request
     * @param int $id
     * Update Slider Service
     *
     * @return Slider
     */
    public function update(SliderRequest $request, int $id): Slider;

    /**
     * @param SliderRequest $request
     * Update Slider Service
     *
     * @return Slider
     */
    public function create(SliderRequest $request): Slider;

    /**
     * @param int $id
     * Delete Slider Service
     *
     * @return bool
     */
    public function delete(int $id): bool;
}
