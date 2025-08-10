<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:250',
            'number_phone' => 'required|string|max:15',
            'email' => 'required|email|max:100|unique:restaurants,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }
}
