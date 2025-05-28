<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\Language\LanguageResource;
use App\Services\LanguageService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    use ApiResponseTrait;

    protected LanguageService $service;

    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return $this->apiResponse(LanguageResource::collection($this->service->getAll()), 200);
    }

    public function store(CreateLanguageRequest $request): JsonResponse
    {
        return $this->apiResponse(new LanguageResource($this->service->create($request->validated())), 201);
    }

    public function show(string $code): JsonResponse
    {
        $lang = $this->service->getByCode($code);
        if (!$lang) return $this->apiResponse(null, 404);
        return $this->apiResponse(new LanguageResource($lang), 200);
    }

    public function update(UpdateLanguageRequest $request, int $id): JsonResponse
    {
        $updated = $this->service->update($id, $request->validated());
        if (!$updated) return $this->apiResponse(null, 404);
        return $this->apiResponse(new LanguageResource($updated), 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->delete($id);
        return $deleted
            ? $this->apiResponse(null, 200)
            : $this->apiResponse(null, 404);
    }
}
