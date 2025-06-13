<?php

namespace App\Http\Requests;

use App\Rules\ImageOrUrl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNailPolishProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $productId = $this->route('nail_polish_product');

        return [
            'name'               => 'sometimes|required|string|max:255',
            'images_urls.*'      => ['required', new ImageOrUrl()],
            'code'               => 'sometimes|required|string|max:50|unique:nail_polish_products,code,' . $productId,
            'brand_id'           => 'nullable|exists:brands,id',
            'category_id'        => 'nullable|exists:categories,id',
            'color_code'         => 'nullable|string|max:20',
            'color_name'         => 'nullable|string|max:100',
            'hex_color'          => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'finish_type'        => 'nullable|in:shiny,matte,glitter',
            'volume_ml'          => 'nullable|numeric|min:0',
            'dry_time_seconds'   => 'nullable|integer|min:0',
            'durability_days'    => 'nullable|integer|min:0',
            'is_vegan'           => 'boolean',
            'is_cruelty_free'    => 'boolean',
            'is_toxic_free'      => 'boolean',
            'price_vnd'          => 'nullable|integer|min:0',
            'currency'           => 'string|size:3',
            'manufacture_date'   => 'nullable|date',
            'expiry_date'        => 'nullable|date|after_or_equal:manufacture_date',
            'barcode'            => 'nullable|string|max:20|unique:nail_polish_products,barcode,' . $productId,
            'usage_instructions' => 'nullable|string',
            'warning_notes'      => 'nullable|string',
            'storage_instructions'=> 'nullable|string',
        ];
    }
}
