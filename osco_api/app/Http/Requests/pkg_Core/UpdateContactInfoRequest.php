<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Adjust this based on your authentication logic.
     */
    public function authorize(): bool
    {
        return true; // Change to false if authorization is needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number'      => 'nullable|string|max:50',
            'phone_fix'         => 'nullable|string|max:50',
            'gmail'             => 'nullable|email|max:255',
            'address'           => 'nullable|string|max:500',
            'google_maps_link'  => 'nullable|url|max:1000',
        ];
    }
}
