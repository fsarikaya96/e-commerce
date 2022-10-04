<?php

namespace App\Repository\Implementations;

use App\Models\Slider;
use App\Repository\Interfaces\ISliderRepository;
use Illuminate\Support\Collection;

class SliderRepository implements ISliderRepository
{
    /**
     * Get All Sliders Repository
     * @return mixed
     */
    public function getSlidersWithPaginate(): mixed
    {
        return Slider::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Fetch sliders by Condition Repository
     * @return mixed
     */
    public function getSlidersByCondition(array $condition): Collection
    {
        return Slider::where($condition)->get();
    }

    /**
     * @param int $id
     * Fetch Slider by ID Repository
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
     * Update Slider Repository
     *
     * @return Slider
     */
    public function update(Slider $slider, int $id): Slider
    {
        $slider->save();

        return $slider;
    }

    /**
     * @param Slider $slider
     * Insert Slider Repository
     *
     * @return Slider
     */
    public function create(Slider $slider): Slider
    {
        $slider->save();

        return $slider;
    }

    /**
     * @param Slider $slider
     * Slider Delete Repository
     *
     * @return bool
     */
    public function delete(Slider $slider): bool
    {
        return $slider->delete();
    }
}
