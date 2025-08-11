<?php

namespace App\Http\Requests\pkg_Core;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasicInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Adjust authorization logic as needed.
     */
    public function authorize(): bool
    {
        return true; // Set to false if you want to restrict access
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255',
            'headline'           => 'nullable|string|max:255',
            'description'        => 'nullable|string',
            'logo_light_theme_url'=> 'nullable|url|max:255',
            'cover_image_url'    => 'nullable|url|max:255',
            'currency'           => 'required|string|max:10',
        ];
    }
}
