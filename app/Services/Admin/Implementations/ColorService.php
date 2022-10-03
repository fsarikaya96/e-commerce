<?php

namespace App\Services\Admin\Implementations;

use App\Models\Color;
use App\Repository\Admin\Interfaces\IColorRepository;
use App\Services\Admin\Interfaces\IColorService;
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
        Log::channel('service')->info("ColorService called --> Request getAllColors() function");
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
     * @param $productColor
     *
     * @return mixed
     */
    public function getColorByProductID($productColor): mixed
    {
        Log::channel('service')->info("ColorService called --> Request getColorByProductID() function");
        Log::channel('service')->info("ColorService called --> ReturnColor By Product ID :" .json_encode($productColor));
        return $this->colorRepository->getColorByProductID($productColor);
    }

    /**
     * @param Color $color
     *
     * @return Color
     * @throws ValidationException
     */
    public function create(Color $color):Color
    {
        Log::channel('service')->info("ColorService called --> Request create() function");
        try {
            Log::channel('service')->info("ColorService called --> Insert color");

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
            Log::channel('service')->info("ColorService called --> Return get category by id : " . $id);

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
            Log::channel('service')->info("ColorService called --> Return get category by id : " . $id);

            return $this->colorRepository->update($color,$id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Renk Bulunamadı.'],
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
            Log::channel('service')->info("ColorService called --> Return get color by id : " . $id);

            $color =  $this->colorRepository->getColorById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız..'],
            ]);
        }
        return $color->delete();
    }
}
