<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpeningHoursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'opening_hours' => ['required', 'array'],
            // Optionally, validate structure inside the array if you know keys
            // 'opening_hours.mon-fri' => 'string',
            // 'opening_hours.sat-sun' => 'string',
        ];
    }

    /**
     * Customize the error messages if needed.
     */
    public function messages(): array
    {
        return [
            'opening_hours.required' => 'Opening hours data is required.',
            'opening_hours.array' => 'Opening hours must be an array.',
        ];
    }
}
