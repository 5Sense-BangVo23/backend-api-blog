<?php

namespace App\Http\Resources\Upload;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UploadedFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,
            'original_name' => $this->original_name,
            'public_id' => $this->public_id,
            'url' => $this->url,
            'file_type' => $this->file_type,
            'upload_type' => $this->upload_type,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
