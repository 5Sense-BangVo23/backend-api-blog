<?php

namespace App\Services\Upload;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Http\UploadedFile;
use App\Models\UploadedFile as UploadedFileModel;

class UploadManager
{
    protected FileUploadServiceInterface $service;

    public function __construct(FileUploadServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Upload a file to the current storage provider.
     */
    public function upload(UploadedFile $file): UploadedFileModel
    {
        return $this->service->upload($file);
    }

    /**
     * Delete a file by public ID.
     */
    public function delete(string $publicId): bool
    {
        return $this->service->delete($publicId);
    }

    /**
     * Get all uploaded files.
     */
    public function getAll()
    {
        return $this->service->getAll();
    }

    /**
     * Get a single uploaded file by its public ID.
     */
    public function getByPublicId(string $publicId): ?UploadedFileModel
    {
        return $this->service->getByPublicId($publicId);
    }
}
