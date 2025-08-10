<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends FormRequest
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
            'restaurant_id' => 'required|exists:restaurants,id',
            'parameter_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'primary_color' => 'nullable|string|max:255',
            'secondary_color' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:255',
            'text_color' => 'nullable|string|max:255',
            'font_family' => 'nullable|string|max:255',
            'font_size' => 'nullable|string|max:255',
            'logo_position' => 'nullable|string|max:255',
            'menu_layout' => 'nullable|string|max:255',
            'button_style' => 'nullable|string|max:255',
            'theme_mode' => 'nullable|string|max:255',
            'custom_css' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
        ];
    }
}
