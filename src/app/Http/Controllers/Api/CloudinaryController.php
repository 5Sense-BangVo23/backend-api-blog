<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Upload\UploadFileRequest;
use App\Http\Resources\Upload\UploadedFileResource;
use App\Services\Upload\UploadManager;
use Illuminate\Http\JsonResponse;


class CloudinaryController extends Controller
{

    protected UploadManager $uploadManager;

    public function __construct(UploadManager $uploadManager)
    {
        $this->uploadManager = $uploadManager;
    }

    public function upload(UploadFileRequest $request): JsonResponse
    {
        $uploaded = $this->uploadManager->upload($request->file('file'));

        return response()->json([
            'message' => 'Upload successful',
            'data' => new UploadedFileResource($uploaded),
        ], 201);
    }


    public function list(): JsonResponse
    {
        $files = $this->uploadManager->getAll();

        return response()->json([
            'message' => 'List of uploaded files',
            'data' => UploadedFileResource::collection($files),
        ]);
    }


    public function get(string $publicId): JsonResponse
    {
        $file = $this->uploadManager->getByPublicId($publicId);

        return $file
            ? response()->json([
                'message' => 'File retrieved successfully',
                'data' => new UploadedFileResource($file),
            ])
            : response()->json([
                'message' => 'File not found',
            ], 404);
    }

}