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
            'restaurant_id'     => ['sometimes', 'integer', 'exists:restaurants,id'],
            'menu_category_id'  => ['sometimes', 'integer', 'exists:menu_categories,id'],
            'name'              => ['sometimes', 'array'],
            'name.*'            => ['required_with:name', 'string', 'max:255'],
            'description'       => ['sometimes', 'array'],
            'description.*'     => ['nullable', 'string'],
            'image_url'         => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'base_price'        => ['sometimes', 'numeric', 'min:0'],
            'is_available'      => ['sometimes', 'boolean'],
        ];
    }
}
