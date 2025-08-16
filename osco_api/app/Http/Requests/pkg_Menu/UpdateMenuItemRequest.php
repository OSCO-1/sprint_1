<?php

namespace App\Http\Requests\pkg_Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust based on your authentication/authorization
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_category_id'  => ['nullable', 'integer', 'exists:menu_categories,id'],
            'name'              => ['nullable', 'array'],
            'name.*'            => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'array'],
            'description.*'     => ['nullable', 'string'],
            'image_url'         => ['nullable', function ($attribute, $value, $fail) {
                // If it's a file upload, validate as image
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    $validator = \Validator::make(
                        [$attribute => $value],
                        [$attribute => 'image|mimes:jpeg,png,jpg,gif|max:2048']
                    );
                    if ($validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                }
                // If it's a string (existing URL), validate as URL or allow it
                elseif (is_string($value) && !empty($value)) {
                    // Allow existing image URLs
                    return true;
                }
            }],
            'base_price'        => ['nullable', 'numeric', 'min:0'],
            'is_available'      => ['nullable', 'boolean'],
        ];
    }
}
