<?php

namespace App\Http\Requests\pkg_Core;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        // Adjust authorization logic here if needed
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'logo_light_theme_url' => ['nullable', 'url'],
            'cover_image_url' => ['nullable', 'url'],

            'phone_number' => ['nullable', 'string', 'max:20'],
            'phone_fix' => ['nullable', 'string', 'max:20'],

            'gmail' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'google_maps_link' => ['nullable', 'url'],

            // Social media URLs
            'facebook' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
            'snapchat' => ['nullable', 'url'],
            'tiktok' => ['nullable', 'url'],

            'currency' => ['required', 'string', 'max:5'],
        ];
    }
}
