<?php

namespace App\Http\Requests\pkg_Core;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLinksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust authorization logic as needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'facebook'  => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'youtube'   => ['nullable', 'url'],
            'snapchat'  => ['nullable', 'url'],
            'tiktok'    => ['nullable', 'url'],
        ];
    }

    /**
     * Optional custom error messages.
     */
    public function messages(): array
    {
        return [
            'facebook.url'  => 'The Facebook link must be a valid URL.',
            'instagram.url' => 'The Instagram link must be a valid URL.',
            'youtube.url'   => 'The YouTube link must be a valid URL.',
            'snapchat.url'  => 'The Snapchat link must be a valid URL.',
            'tiktok.url'    => 'The TikTok link must be a valid URL.',
        ];
    }
}
