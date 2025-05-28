<?php
namespace App\Services;

use App\Builders\NailPolishProductBuilder;
use App\Models\NailPolishProduct;
use Illuminate\Database\Eloquent\Collection;

class NailPolishProductService
{
    // Lấy danh sách tất cả sản phẩm
    public function getAll(): Collection
    {
        return NailPolishProduct::all();
    }

    // Lấy chi tiết sản phẩm theo ID
    public function getById(int $id): ?NailPolishProduct
    {
        return NailPolishProduct::find($id);
    }

    // Tạo sản phẩm mới từ builder
    public function create(NailPolishProductBuilder $builder): NailPolishProduct
    {
        $product = $builder->build();
        $product->save();
        return $product;
    }

    // Cập nhật sản phẩm
    public function update(int $id, NailPolishProductBuilder $builder): ?NailPolishProduct
    {
        $product = $this->getById($id);
        if (!$product) {
            return null;
        }

        $data = $builder->build()->toArray();
        $product->fill($data);
        $product->save();

        return $product;
    }

    // Xóa sản phẩm theo ID
    public function delete(int $id): bool
    {
        $product = $this->getById($id);
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
}
