<?php

namespace App\Repository\Admin\Implementations;

use App\Models\Slider;
use App\Repository\Admin\Interfaces\ISliderRepository;

class SliderRepository implements ISliderRepository
{
    /**
     * Get All Sliders
     * @return mixed
     */
    public function getAllSliders(): mixed
    {
        return Slider::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * @param int $id
     * Fetch Slider by ID
     *
     * @return Slider
     */
    public function getSliderById(int $id): Slider
    {
        return Slider::findOrFail($id);
    }

    /**
     * @param Slider $slider
     * @param int $id
     * Update Slider
     * @return Slider
     */
    public function update(Slider $slider, int $id): Slider
    {
        $slider->save();

        return $slider;
    }

    /**
     * @param Slider $slider
     * Insert Slider
     * @return Slider,
     */
    public function create(Slider $slider): Slider
    {
        $slider->save();

        return $slider;
    }

    /**
     * @param Slider $slider
     * Slider Delete
     *
     * @return bool
     */
    public function delete(Slider $slider): bool
    {
        return $slider->delete();
    }
}
