<?php

namespace App\Services;

use App\Models\BlgCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlgCategoryService
{
    /**
     * Các trường cần lấy cho category
     */
    protected array $selectFields = ['id', 'name', 'description'];

    /**
     * Tạo mới category
     *
     * @param array $data
     * @return BlgCategory
     */
    public function createCategory(array $data): BlgCategory
    {
        return BlgCategory::create($data);
    }

    /**
     * Lấy tất cả category, chỉ lấy các trường cần thiết
     *
     * @return Collection
     */
    public function getAllCategories(): Collection
    {
        return BlgCategory::select($this->selectFields)->get();
    }

    /**
     * Lấy danh sách category phân trang, chỉ lấy các trường cần thiết
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllCategoriesPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return BlgCategory::select($this->selectFields)->paginate($perPage);
    }

    /**
     * Lấy category theo id, chỉ lấy các trường cần thiết, ném exception nếu không tìm thấy
     *
     * @param int $cateId
     * @return BlgCategory
     *
     * @throws ModelNotFoundException
     */
    public function getCategoryById(int $cateId): BlgCategory
    {
        return BlgCategory::select($this->selectFields)->findOrFail($cateId);
    }

    /**
     * Cập nhật category theo id, ném exception nếu không tìm thấy
     *
     * @param int $cateId
     * @param array $data
     * @return BlgCategory
     *
     * @throws ModelNotFoundException
     */
    public function updateCategory(int $cateId, array $data): BlgCategory
    {
        $category = $this->getCategoryById($cateId);
        $category->update($data);

        return $this->getCategoryById($cateId);
    }

    /**
     * Xóa category theo id
     *
     * @param int $cateId
     * @return bool
     */
    public function deleteCategory(int $cateId): bool
    {
        return (bool) BlgCategory::destroy($cateId);
    }
}
