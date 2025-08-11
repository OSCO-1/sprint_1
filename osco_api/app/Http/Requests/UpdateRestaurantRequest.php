<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        // Adjust authorization logic if needed.
        // For now, allow everyone (or add auth logic)
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string',
            'description' => 'nullable|string',
            'currency' => 'required|string|max:5',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            // Add other validation rules here as needed
        ];
    }
}
