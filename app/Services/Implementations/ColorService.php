<?php

namespace App\Services\Implementations;

use App\Models\Color;
use App\Repository\Interfaces\IColorRepository;
use App\Services\Interfaces\IColorService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ColorService implements IColorService
{
    private IColorRepository $colorRepository;

    /**
     * ColorRepository constructor injection
     *
     * @param IColorRepository $IColorRepository
     */
    public function __construct(IColorRepository $IColorRepository)
    {
        $this->colorRepository = $IColorRepository;
    }


    /**
     * @return mixed
     * @throws ValidationException
     */
    public function getColorsWithPaginate(): mixed
    {
        Log::channel('service')->info("ColorService called --> Request getColorsWithPaginate() function");
        try {
            Log::channel('service')->info("ColorService called --> Return all colors with paginate");

            return $this->colorRepository->getColorsWithPaginate();
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Renk Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param array $condition
     *
     * @return Collection
     * @throws ValidationException
     */
    public function getColorsByCondition(array $condition): Collection
    {
        Log::channel('service')->info("ColorService called --> Request getColorsByCondition() function");
        try {
            Log::channel('service')->info("ColorService called --> Return all colors by condition");

            return $this->colorRepository->getColorsByCondition($condition);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Renk Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param $productColor
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed
    {
        Log::channel('service')->info("ColorService called --> Request getColorByProductID() function");
        Log::channel('service')->info(
            "ColorService called --> ReturnColor By Product ID :" . json_encode($productColor)
        );

        return $this->colorRepository->getColorByProductID($productColor);
    }

    /**
     * @param Color $color
     *
     * @return Color
     * @throws ValidationException
     */
    public function create(Color $color): Color
    {
        Log::channel('service')->info("ColorService called --> Request create() function");
        try {
            Log::channel('service')->info("ColorService called --> Insert color data : " . $color);

            return $this->colorRepository->create($color);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kayıt işlemi başarısız.'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return Color
     * @throws ValidationException
     */
    public function getColorById(int $id): Color
    {
        Log::channel('service')->info("ColorService called --> Request getColorById() function");
        try {
            Log::channel('service')->info("ColorService called --> Return get color by id : " . $id);

            return $this->colorRepository->getColorById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Renk Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param Color $color
     * @param int $id
     *
     * @return Color
     * @throws ValidationException
     */
    public function update(Color $color, int $id): Color
    {
        Log::channel('service')->info("ColorService called --> Request getColorById() function");
        try {
            Log::channel('service')->info("ColorService called --> Update color data : " . $color);

            return $this->colorRepository->update($color, $id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Güncelleme işlemi başarısız.'],
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
        Log::channel('service')->info("ColorService called --> Request delete() function");
        try {
            Log::channel('service')->info("ColorService called --> Delete color by ID : " . $id);

            $color = $this->colorRepository->getColorById($id);

            return $this->colorRepository->delete($color);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız..'],
            ]);
        }
    }
}
