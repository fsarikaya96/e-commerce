<?php

namespace App\Services\Implementations;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Repository\Interfaces\ISliderRepository;
use App\Services\Interfaces\ISliderService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SliderService implements ISliderService
{
    private ISliderRepository $sliderRepository;

    /**
     * Slider construct injection
     *
     * @param ISliderRepository $ISliderRepository
     */
    public function __construct(ISliderRepository $ISliderRepository)
    {
        $this->sliderRepository = $ISliderRepository;
    }

    /**
     * @return mixed
     * @throws ValidationException
     */
    public function getSlidersWithPaginate(): mixed
    {
        Log::channel('service')->info("SliderService called --> Request getSlidersWithPaginate() function");
        try {
            Log::channel('service')->info("SliderService called --> Return all sliders with paginate");

            return $this->sliderRepository->getSlidersWithPaginate();
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Slider Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return Slider
     * @throws ValidationException
     */
    public function getSliderById(int $id): Slider
    {
        Log::channel('service')->info("SliderService called --> Request getSliderById() function");
        try {
            Log::channel('service')->info("SliderService called --> Return slider by ID: " . $id);

            return $this->sliderRepository->getSliderById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Slider Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param SliderRequest $request
     * @param int $id
     *
     * @return Slider
     * @throws ValidationException
     */
    public function update(SliderRequest $request, int $id): Slider
    {
        $slider        = $this->sliderRepository->getSliderById($id);
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $path = $slider->image;

            if (File::exists($path)) {
                File::delete($path);
            }
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/sliders/', $fileName);
            $slider->image = "uploads/sliders/$fileName";
        }
        $slider->title       = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->link        = $validatedData['link'];
        $slider->status      = $request->status ? 1 : 0;

        Log::channel('service')->info("SliderService called --> Request update() function");
        try {
            Log::channel('service')->info("SliderService called --> Update Slider data : " . $slider);

            return $this->sliderRepository->update($slider, $id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Güncelleme işlemi başarısız..'],
            ]);
        }
    }

    /**
     * @param SliderRequest $request
     *
     * @return Slider
     * @throws ValidationException
     */
    public function create(SliderRequest $request): Slider
    {
        $slider        = new Slider;
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/sliders', $fileName);
            $validatedData['image'] = 'uploads/sliders/' . $fileName;
        }
        $slider->title       = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->link        = $validatedData['link'];
        $slider->image       = $validatedData['image'] ?? $request->image;
        $slider->status      = $request->status ? "1" : "0";

        Log::channel('service')->info("SliderService called --> Request create() function");
        try {
            Log::channel('service')->info("SliderService called --> Insert slider data : " . $slider);

            return $this->sliderRepository->create($slider);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kayıt işlemi başarısız.'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws ValidationException
     */
    public function delete(int $id): bool
    {
        Log::channel('service')->info("SliderService called --> Request delete() function");
        try {
            Log::channel('service')->info("SliderService called --> Delete slider by ID :" . $id);
            $slider = $this->sliderRepository->getSliderById($id);
            $path = $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            return $this->sliderRepository->delete($slider);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız.'],
            ]);
        }

    }
}
