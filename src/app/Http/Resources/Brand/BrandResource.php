<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource  extends JsonResource{

    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'country'   => $this->country,
            'website'   => $this->website,
            'logo_url'  => $this->logo_url,
        ];
    }

}