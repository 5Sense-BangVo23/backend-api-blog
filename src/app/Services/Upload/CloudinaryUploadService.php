<?php

namespace App\Services\Upload;

use App\Interfaces\FileUploadServiceInterface;
use App\Models\UploadedFile as UploadedFileModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryUploadService implements FileUploadServiceInterface
{
    public function upload(UploadedFile $file): UploadedFileModel
    {
        $uploaded = Cloudinary::upload($file->getRealPath(), [
            'folder' => 'uploads'
        ]);

        return UploadedFileModel::create([
            'original_name' => $file->getClientOriginalName(),
            'public_id' => $uploaded->getPublicId(),
            'url' => $uploaded->getSecurePath(),
            'file_type' => $file->getClientMimeType(),
            'upload_type' => 'cloudinary',
        ]);
    }

    public function delete(string $publicId): bool
    {
        Cloudinary::destroy($publicId);
        return UploadedFileModel::where('public_id', $publicId)->delete() > 0;
    }

    public function getAll(): Collection
    {
        return UploadedFileModel::latest()->get();
    }

    public function getByPublicId(string $publicId): ?UploadedFileModel
    {
        return UploadedFileModel::where('public_id', $publicId)->first();
    }
}
