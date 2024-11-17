<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'user_id'           => 'required|exists:users,id',
            'role_id'           => 'required|exists:roles,id',
            'sku_order'         => 'required',
            'user_name'         => 'required',
            'user_email'        => 'nullable|email|unique:users,email',
            'user_phone'        => 'nullable|numeric|digits_between:9,11|unique:users,phone',
            'user_address'      => 'nullable',
            'user_note'         => 'nullable',
            'status_order'      => 'required',
            'status_payment'    => 'required',

            // 'product' => 'array',
            // 'product.*' => 'array|required_array_keys:size,color,quatity',
            // 'product.*.id' => 'required|exists:products,id',
            // 'product.*.size' => 'required|exists:product_sizes,id',
            // 'product.*.color' => 'required|exists:product_colors,id',
            // 'product.*.quatity' => 'required|min:0|max:10',
        ];
    }
}
