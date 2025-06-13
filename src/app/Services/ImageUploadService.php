<?php

namespace App\Services;

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Upload nhiều ảnh lên storage (disk 'public'), trả về mảng url
     * 
     * @param UploadedFile[] $images
     * @return array
     */
    public function uploadMultiple(array $images): array
    {
        $urls = [];

        foreach ($images as $image) {
            $path = $image->store('nail_polish_products', 'public');
            $urls[] = Storage::url($path);
        }

        return $urls;
    }
}
