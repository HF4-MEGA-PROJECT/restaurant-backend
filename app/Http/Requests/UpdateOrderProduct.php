<?php

namespace App\Http\Requests;

use App\Enums\OrderProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderProduct extends FormRequest
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
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:order_products,id',
            'price_at_purchase' => 'required|numeric',
            'status' => 'required|string|'.Rule::in(OrderProductStatus::ORDERED->value, OrderProductStatus::IN_PROGRESS->value, OrderProductStatus::DELIVERABLE->value),
            'product_id' => 'required|integer|exists:products,id',
            'order_id' => 'required|integer|exists:orders,id'
        ];
    }
}
