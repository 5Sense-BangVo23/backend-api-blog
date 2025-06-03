<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BlgBrandService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\brand\StoreBrandRequest;
use App\Http\Requests\brand\UpdateBrandRequest;
use App\Http\Resources\Brand\BrandResource;

class BrandController extends Controller
{
    protected BlgBrandService $brandService;

    public function __construct(BlgBrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Tạo brand mới
     */
    public function createBrand(StoreBrandRequest $request): JsonResponse
    {
        $brand = $this->brandService->createBrand($request->validated());

        return response()->json([
            'message' => 'Brand created successfully',
            'data' => new BrandResource($brand)
        ], Response::HTTP_CREATED);
    }

    /**
     * Lấy danh sách tất cả brand
     */
    public function getAllBrand(): JsonResponse
    {
        $brands = $this->brandService->getAllBrands();

        return response()->json([
            'message' => 'List of brands',
            'data' => BrandResource::collection($brands),
        ], Response::HTTP_OK);
    }

    /**
     * Cập nhật brand theo ID
     */
    public function updateBrand(UpdateBrandRequest $request, int $id): JsonResponse
    {
        try {
            $brand = $this->brandService->updateBrand($id, $request->validated());

            return response()->json([
                'message' => 'Brand updated successfully',
                'data' => BrandResource::collection($brands),
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Brand update failed',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
