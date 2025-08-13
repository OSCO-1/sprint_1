<?php

namespace App\Http\Requests\pkg_Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust this if you have authentication/authorization logic
        return true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id'     => ['required', 'integer', 'exists:restaurants,id'],
            'menu_category_id'  => ['required', 'integer', 'exists:menu_categories,id'],
            'name'              => ['required', 'array'], // Because it's translatable
            'name.*'            => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'array'], // Optional translatable
            'description.*'     => ['nullable', 'string'],
            'image_url'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'base_price'        => ['required', 'numeric', 'min:0'],
            'is_available'      => ['required', 'boolean'],
        ];
    }
}
