<?php

namespace App\Http\Controllers\Api;

use App\Builders\NailPolishProductBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNailPolishProductRequest;
use App\Http\Requests\UpdateNailPolishProductRequest;
use App\Http\Resources\NailPolishProduct\NailPolishProductResource;
use App\Models\NailPolishProduct;
use App\Services\ImageUploadService;
use App\Services\NailPolishProductService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NailPolishProductController extends Controller
{
    use ApiResponseTrait;

    protected NailPolishProductService $service;
    protected ImageUploadService $imageUploadService;

    public function __construct(
        NailPolishProductService $productService,
        ImageUploadService $imageUploadService
    ) {
        $this->service = $productService;
        $this->imageUploadService = $imageUploadService;
    }

    // GET /api/nail-polish-products
    public function index(Request $request): JsonResponse
    {
        $products = $this->service->getAll($request->all());
        return $this->apiResponse(NailPolishProductResource::collection($products), 200);
    }

    // GET /api/nail-polish-products/{id}
    public function show(int $id): JsonResponse
    {
        $product = $this->service->getById($id);

        if (!$product) {
            return $this->apiResponse(null, 404);
        }

        return $this->apiResponse(new NailPolishProductResource($product), 200);
    }

    // POST /api/nail-polish-products
    public function store(CreateNailPolishProductRequest $request)
    {
        $data = $request->validated();

        $builder = (new NailPolishProductBuilder())
            ->setName($data['name'])
            ->setCode($data['code'])
            ->setBrandId($data['brand_id'] ?? null)
            ->setCategoryId($data['category_id'] ?? null)
            ->setColorCode($data['color_code'] ?? null)
            ->setColorName($data['color_name'] ?? null)
            ->setFinishType($data['finish_type'] ?? null)
            ->setVolumeMl($data['volume_ml'] ?? null)
            ->setDryTimeSeconds($data['dry_time_seconds'] ?? null)
            ->setDurabilityDays($data['durability_days'] ?? null)
            ->setIsVegan($data['is_vegan'] ?? false)
            ->setIsCrueltyFree($data['is_cruelty_free'] ?? false)
            ->setIsToxicFree($data['is_toxic_free'] ?? false)
            ->setPriceVnd($data['price_vnd'] ?? null)
            ->setCurrency($data['currency'])
            ->setManufactureDate($data['manufacture_date'] ?? null)
            ->setExpiryDate($data['expiry_date'] ?? null)
            ->setBarcode($data['barcode'] ?? null)
            ->setUsageInstructions($data['usage_instructions'] ?? null)
            ->setWarningNotes($data['warning_notes'] ?? null)
            ->setStorageInstructions($data['storage_instructions'] ?? null);

        $product = $this->service->create($builder);

        return response()->json($product, 201);
    }


    // PUT/PATCH /api/nail-polish-products/{id}
    public function update(UpdateNailPolishProductRequest $request, int $id): JsonResponse
    {
        $updated = $this->service->update($id, $request->validated());

        if (!$updated) {
            return $this->apiResponse(null, 404);
        }

        return $this->apiResponse(new NailPolishProductResource($updated), 200);
    }

    // DELETE /api/nail-polish-products/{id}
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {
            return $this->apiResponse(null, 404);
        }

        return $this->apiResponse(null, 200);
    }

    public function uploadImages(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'images.*' => 'required|image|max:5120',
        ]);

        if (!$request->hasFile('images')) {
            return response()->json(['message' => 'Không có file ảnh được gửi'], 422);
        }

        $product = NailPolishProduct::findOrFail($id);
        $uploadedUrls = $this->imageUploadService->uploadMultiple($request->file('images'));

        $product = $this->service->saveImagesUrls($product, $uploadedUrls);

        return response()->json([
            'message' => 'Upload thành công',
            'images_urls' => json_decode($product->images_urls, true),
        ]);
    }

    
}
