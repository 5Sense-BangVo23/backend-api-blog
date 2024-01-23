<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateBlgCategoryRequest;
use App\Http\Requests\Category\UpdateBlgCategoryRequest;
use App\Http\Resources\Category\BlgCategoryResource;
use App\Models\BlgCategory;
use Illuminate\Http\JsonResponse;

class BlgCategoryController extends Controller
{
    
    public function createCategory(CreateBlgCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $category = BlgCategory::create($data);
        $categoryResource = new BlgCategoryResource($category);
        
        return response()->json(new BlgCategoryResource($categoryResource), 200);
    }

    public function getAllCategories(): JsonResponse
    {
        $categories = BlgCategory::all();
        $categoryResources = BlgCategoryResource::collection($categories);

        return response()->json($categoryResources);
    }
}
