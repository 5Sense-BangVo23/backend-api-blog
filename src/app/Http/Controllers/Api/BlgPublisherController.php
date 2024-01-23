<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Publisher\CreateBlgPublisherRequest;
use App\Http\Requests\Publisher\UpdateBlgPublisherRequest;
use App\Http\Resources\Publisher\BlgPublisherResource;
use App\Services\BlgPublisherService;
use Illuminate\Http\JsonResponse;

class BlgPublisherController extends Controller
{
    public function createPublisher(CreateBlgPublisherRequest $request): JsonResponse
    {
        $data = $request->validated();
        $publisher = \Publisher::createPublisher($data);
        $publisherResource = new BlgPublisherResource($publisher);

        return response()->json($publisherResource, 201);
    }

    public function getAllPublishers(): JsonResponse
    {
        $publishers = \Publisher::listAllPublishers();
        $publishersResource = BlgPublisherResource::collection($publishers);

        return response()->json($publishersResource);
    }

    public function updatePublisher(int $publisherId, UpdateBlgPublisherRequest $request): JsonResponse
    {
        $data = $request->validated();
        $publisher = \Publisher::updatePublisher($publisherId, $data);

        if ($publisher) {
            $publisherResource = new BlgPublisherResource($publisher);
            return response()->json($publisherResource, 200);
        } else {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
    }
}
