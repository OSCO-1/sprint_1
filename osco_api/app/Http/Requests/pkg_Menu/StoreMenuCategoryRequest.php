<?php

namespace App\Http\Requests\pkg_Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you have auth checks
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'exists:restaurants,id'],

            // Translatable name
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],

            // Translatable description
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],

            // Image upload (stored in Laravel storage)
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],

            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'restaurant_id.required' => 'The restaurant ID is required.',
            'restaurant_id.exists' => 'The selected restaurant does not exist.',

            'name.required' => 'The category name is required.',
            'name.array' => 'The category name must be provided for each language.',
            'name.*.required' => 'Each language version of the name is required.',
            'name.*.string' => 'Each language version of the name must be a string.',
            'name.*.max' => 'Each language version of the name may not be greater than 255 characters.',

            'description.array' => 'The description must be an array of language strings.',
            'description.*.string' => 'Each language version of the description must be a string.',

            'image_url.image' => 'The uploaded file must be an image.',
            'image_url.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image_url.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
