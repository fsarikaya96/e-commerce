<?php

namespace App\Services\Implementations;

use App\Models\Brand;
use App\Repository\Interfaces\IBrandRepository;
use App\Services\Interfaces\IBrandService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;

    /**
     * BrandRepository constructor injection
     *
     * @param IBrandRepository $IBrandRepository
     */
    public function __construct(IBrandRepository $IBrandRepository)
    {
        $this->brandRepository = $IBrandRepository;
    }

    /**
     * @return mixed
     * @throws ValidationException
     */
    public function getBrandsWithPaginate(): mixed
    {
        Log::channel('service')->info("BrandService called --> Request getBrandsWithPaginate() function");
        try {
            Log::channel('service')->info("BrandService called --> Return all brands with paginate");

            return $this->brandRepository->getBrandsWithPaginate();
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Marka Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param array $condition
     *
     * @return Collection
     * @throws ValidationException
     */
    public function getBrandsByCondition(array $condition): Collection
    {
        Log::channel('service')->info("BrandService called --> Request getBrandsByCondition() function");
        try {
            Log::channel('service')->info("BrandService called --> Return all brands by condition");

            return $this->brandRepository->getBrandsByCondition($condition);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Marka Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param Brand $brand
     *
     * @return Brand
     * @throws ValidationException
     */
    public function create(Brand $brand): Brand
    {
        Log::channel('service')->info("BrandService called --> Request create() function");
        try {
            Log::channel('service')->info("BrandService called --> Insert Brand data : " . $brand);

            return $this->brandRepository->create($brand);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Kayıt işlemi başarısız..'],
            ]);
        }
    }

    /**
     * @param int $id
     *
     * @return Brand
     * @throws ValidationException
     */
    public function getBrandById(int $id): Brand
    {
        Log::channel('service')->info("CategoryService called --> Request edit() function");
        try {
            Log::channel('service')->info('CategoryService Called ---> Return get category by id : ' . $id);

            return $this->brandRepository->getBrandById($id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Böyle Bir Marka Bulunamadı.'],
            ]);
        }
    }

    /**
     * @param Brand $brand
     * @param int $id
     *
     * @return Brand
     * @throws ValidationException
     */
    public function update(Brand $brand, int $id): Brand
    {
        Log::channel('service')->info("BrandService called --> Request update() function");
        try {
            Log::channel('service')->info('BrandService Called ---> Update brand data : ' . $brand);

            return $this->brandRepository->update($brand, $id);
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
        Log::channel('service')->info("BrandService called --> Request delete() function");
        try {
            Log::channel('service')->info("BrandService called --> Delete brand by ID :" . $id);
            $brand = $this->brandRepository->getBrandById($id);

            return $this->brandRepository->delete($brand);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                'error' => ['Silme işlemi başarısız.'],
            ]);
        }
    }
}
