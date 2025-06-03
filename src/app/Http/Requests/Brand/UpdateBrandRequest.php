<?php

namespace App\Http\Requests\brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Lấy id brand từ route param để bỏ qua unique slug của chính nó
        $brandId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'logo_url' => 'nullable|url|max:255',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}