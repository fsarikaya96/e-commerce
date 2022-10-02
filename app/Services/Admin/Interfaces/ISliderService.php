<?php

namespace App\Services\Admin\Interfaces;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;

interface ISliderService
{
    /**
     * Get All Sliders
     * @return mixed
     */
    public function getAllSliders():mixed;

    /**
     * @param int $id
     * Fetch Slider by ID
     * @return Slider
     */
    public function getSliderById(int $id):Slider;

    /**
     * @param SliderRequest $request
     * @param int $id
     * Update Slider
     *
     * @return Slider
     */
    public function update(SliderRequest $request, int $id):Slider;

    /**
     * @param SliderRequest $request
     *
     * @return Slider
     */
    public function create(SliderRequest $request):Slider;
    /**
     * @param int $id
     * Delete Slider
     * @return bool
     */
    public function delete(int $id):bool;
}
