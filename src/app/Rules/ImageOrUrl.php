<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ImageOrUrl implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        }

        if ($value instanceof UploadedFile) {
            return in_array(
                $value->getMimeType(),
                ['image/jpeg', 'image/png', 'image/gif', 'image/webp']
            );
        }

        return false;
    }

    public function message(): string
    {
        return 'The :attribute must be a valid URL or a valid image file.';
    }
}
