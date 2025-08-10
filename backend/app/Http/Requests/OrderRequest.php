<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'table_id' => 'required|exists:tables,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|string|in:pending,preparing,served,cancelled',

            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ];
    }
}
