<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('manage-products');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'category_id' => 'required|exists:categories,id',

            'price' => 'required|numeric|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'suppliers' => 'nullable|array',

            'suppliers.*' => 'exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => 'The image must be 2 MB or smaller.',
        ];
    }
}
