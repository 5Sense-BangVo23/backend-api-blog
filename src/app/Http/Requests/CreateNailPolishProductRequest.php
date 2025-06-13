<?php

namespace App\Http\Requests;

use App\Rules\ImageOrUrl;
use Illuminate\Foundation\Http\FormRequest;

class CreateNailPolishProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255',
            'images_urls.*'      => ['required', new ImageOrUrl()],
            'code'               => 'required|string|max:50|unique:nail_polish_products,code',
            'brand_id'           => 'nullable|exists:brands,id',
            'category_id'        => 'nullable|exists:categories,id',
            'color_code'         => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'color_name'         => 'nullable|string|max:100',
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
            'barcode'            => 'nullable|string|max:20|unique:nail_polish_products,barcode',
            'usage_instructions' => 'nullable|string',
            'warning_notes'      => 'nullable|string',
            'storage_instructions'=> 'nullable|string',
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh (nếu muốn)
     */
    public function messages(): array
    {
        return [
            'color_code.regex' => 'Mã màu HEX phải có định dạng #xxxxxx (6 ký tự hex).',
            'expiry_date.after_or_equal' => 'Ngày hết hạn phải bằng hoặc sau ngày sản xuất.',
            'barcode.unique' => 'Mã vạch đã tồn tại trong hệ thống.',
        ];
    }
}
