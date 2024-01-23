<?php

namespace App\Services;
use App\Models\BlgCategory;

class BlgCategoryService{

    public function createCategory(array $data){
        return BlgCategory::create($data);
    }

    public function getAllCategories(){
        return BlgCategory::all();
    }

    public function updateCategory(int $cateId, array $data){
        $category = BlgCategory::find($cateId);

        if (!$category) {
            return null;
        }
        $category->update($data);

        return $category;
    }
}   