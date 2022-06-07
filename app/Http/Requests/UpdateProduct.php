<?php

namespace App\Http\Requests;

use App\Enums\ProductTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|'.Rule::in(ProductTypes::FOOD->value, ProductTypes::DRINKS->value, ProductTypes::SNACKS->value),
            'price' => 'nullable|numeric',
            'category_id' => 'nullable|integer|exists:categories,id',
            'photo_path' => 'nullable|string|max:2048',
        ];
    }
}
