<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNailPolishProductRequest;
use App\Http\Requests\UpdateNailPolishProductRequest;
use App\Http\Resources\NailPolishProduct\NailPolishProductResource;
use App\Services\NailPolishProductService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NailPolishProductController extends Controller
{
    use ApiResponseTrait;

    protected NailPolishProductService $service;

    public function __construct(NailPolishProductService $service)
    {
        $this->service = $service;
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
    public function store(CreateNailPolishProductRequest $request): JsonResponse
    {
        $product = $this->service->create($request->validated());

        return $this->apiResponse(new NailPolishProductResource($product), 201);
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
}
