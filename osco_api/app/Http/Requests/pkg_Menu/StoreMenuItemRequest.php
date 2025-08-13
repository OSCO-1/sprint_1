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
            'name.en'           => ['required', 'string', 'max:255'], // English is required
            'name.fr'           => ['nullable', 'string', 'max:255'], // French is optional
            'name.ar'           => ['nullable', 'string', 'max:255'], // Arabic is optional
            'description'       => ['nullable', 'array'], // Optional translatable
            'description.en'    => ['nullable', 'string'], // English description optional
            'description.fr'    => ['nullable', 'string'], // French description optional
            'description.ar'    => ['nullable', 'string'], // Arabic description optional
            'image_url'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'base_price'        => ['required', 'numeric', 'min:0'],
            'is_available'      => ['required', 'boolean'],
        ];
    }
}
