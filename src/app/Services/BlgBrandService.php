<?php

namespace App\Services;

use App\Models\BlgBrand;
use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BlgBrandService
{
    /**
     * Các trường cần lấy cho brand
     */
    protected array $selectFields = [
        'id',
        'name',
        'country',
        'website',
        'logo_url'
    ];

    /**
     * Tạo mới brand
     *
     * @param array $data
     * @return Brand
     */
    public function createBrand(array $data): Brand
    {
        return Brand::create($data);
    }

    /**
     * Lấy tất cả brand, chỉ lấy các trường cần thiết
     *
     * @return Collection
     */
    public function getAllBrands(): Collection
    {
        return Brand::select($this->selectFields)->orderBy('name')->get();
    }

    /**
     * Lấy danh sách brand phân trang
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedBrands(int $perPage = 15): LengthAwarePaginator
    {
        return Brand::select($this->selectFields)
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    /**
     * Lấy brand theo id, ném lỗi nếu không tìm thấy
     *
     * @param int $brandId
     * @return Brand
     *
     * @throws ModelNotFoundException
     */
    public function getBrandById(int $brandId): Brand
    {
        return Brand::select($this->selectFields)->findOrFail($brandId);
    }

    /**
     * Cập nhật brand theo id
     *
     * @param int $brandId
     * @param array $data
     * @return Brand
     *
     * @throws ModelNotFoundException
     */
    public function updateBrand(int $brandId, array $data): Brand
    {
        $brand = $this->getBrandById($brandId);
        $brand->update($data);

        return $this->getBrandById($brandId);
    }

    /**
     * Xoá brand theo id
     *
     * @param int $brandId
     * @return bool
     */
    public function deleteBrand(int $brandId): bool
    {
        return (bool) Brand::destroy($brandId);
    }
}