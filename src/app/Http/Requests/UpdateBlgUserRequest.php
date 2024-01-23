<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlgUserRequest extends FormRequest
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
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:blg_users,email,' . $this->route('id'),
                'old_password' => 'sometimes|string',
                'new_password' => 'sometimes|string|min:8',
                'confirm_password' => 'sometimes|string|same:new_password',
        ];
    }
}
