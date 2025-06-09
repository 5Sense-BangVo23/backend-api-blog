<?php

namespace App\Http\Resources\NailPolishProduct;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class NailPolishProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'code'              => $this->code,
            'brand_id'          => $this->brand_id,
            'category_id'       => $this->category_id,
            'color_code'        => $this->color_code,
            'color_name'        => $this->color_name,
            'hex_color'         => $this->hex_color,
            'finish_type'       => $this->finish_type,
            'volume_ml'         => $this->volume_ml,
            'dry_time_seconds'  => $this->dry_time_seconds,
            'durability_days'   => $this->durability_days,
            'is_vegan'          => $this->is_vegan,
            'is_cruelty_free'   => $this->is_cruelty_free,
            'is_toxic_free'     => $this->is_toxic_free,
            'price_vnd'         => $this->price_vnd,
            'currency'          => $this->currency,
            'manufacture_date' => $this->manufacture_date ? Carbon::parse($this->manufacture_date)->toDateString() : null,
            'expiry_date'      => $this->expiry_date ? Carbon::parse($this->expiry_date)->toDateString() : null,
            'barcode'           => $this->barcode,
            'usage_instructions'=> $this->usage_instructions,
            'warning_notes'     => $this->warning_notes,
            'storage_instructions' => $this->storage_instructions,
            'created_at'        => $this->created_at->toDateTimeString(),
            'updated_at'        => $this->updated_at->toDateTimeString(),
        ];
    }
}
