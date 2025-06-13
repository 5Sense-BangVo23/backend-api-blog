<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;
use App\Models\UploadedFile as UploadedFileModel;
use Illuminate\Support\Collection;

interface FileUploadServiceInterface
{
    /**
     * Upload a file and return its DB record.
     */
    public function upload(UploadedFile $file): UploadedFileModel;

    /**
     * Delete a file from storage and DB.
     */
    public function delete(string $publicId): bool;

    /**
     * Get all uploaded files.
     */
    public function getAll(): Collection;

    /**
     * Get a specific file by public_id.
     */
    public function getByPublicId(string $publicId): ?UploadedFileModel;
}
