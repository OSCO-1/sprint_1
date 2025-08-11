<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLinksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'social_links' => ['required', 'array'],
            // Optionally validate URL format for known social keys, e.g.:
            // 'social_links.facebook' => 'nullable|url',
            // 'social_links.instagram' => 'nullable|url',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'social_links.required' => 'Social links data is required.',
            'social_links.array' => 'Social links must be an array.',
        ];
    }
}
