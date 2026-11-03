<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the product name.',
            'category_id.required' => 'Please choose a category.',
            'stock.min' => 'Stock cannot be less than 0.',
            'price.numeric' => 'Price must be a number.',
        ];
    }
    public function attributes(): array
{
    return [
        'price' => 'product price',
    ];
}
}
