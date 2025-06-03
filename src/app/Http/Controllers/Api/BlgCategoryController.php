<?php

namespace App\Http\Controllers\Api;

use App\Constants\Messages;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateBlgCategoryRequest;
use App\Http\Requests\Category\UpdateBlgCategoryRequest;
use App\Http\Resources\Category\BlgCategoryResource;
use App\Services\BlgCategoryService;
use Illuminate\Http\JsonResponse;
use PHPUnit\TextUI\Configuration\Constant;
use Symfony\Component\HttpFoundation\Response;

class BlgCategoryController extends Controller
{
    protected BlgCategoryService $categoryService;

    public function __construct(BlgCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function createCategory(CreateBlgCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $category = $this->categoryService->createCategory($data);

        return response()->json([
            'message' => Messages::CATEGORY_CREATED,
            'data' => new BlgCategoryResource($category),
        ], Response::HTTP_CREATED);
    }

    public function getAllCategories(): JsonResponse
    {
        $categories = $this->categoryService->getAllCategories();

        return response()->json([
            'message' =>  Messages::CATEGORY_LIST,
            'data' => BlgCategoryResource::collection($categories),
        ], Response::HTTP_OK);
    }

    public function updateCategory(UpdateBlgCategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->validated());

            return response()->json([
                'message' => Messages::CATEGORY_UPDATED,
                'data' => new BlgCategoryResource($category),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => Messages::CATEGORY_UPDATE_FAILED,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
