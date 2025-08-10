<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class MenuCategoryRequest extends FormRequest
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
                'name' => 'required|string|max:55',
                'description' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Accepted image formats are: jpeg, png, jpg, gif, svg.',
        ];
    }

    }
