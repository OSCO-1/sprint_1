<?php

namespace App\Http\Requests\pkg_Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Update this logic based on your authentication/authorization setup
        return true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'name' => ['required', 'array'], // expecting translations as array e.g. { "en": "Pizza", "fr": "Pizza" }
            'name.*' => ['required', 'string', 'max:255'], // each language must be string max 255
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:255'],
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
            'image_url.url' => 'The image URL must be a valid URL.',
        ];
    }
}
