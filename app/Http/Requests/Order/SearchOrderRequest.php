<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class SearchOrderRequest extends FormRequest
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
         
                'sku_order' => 'required|string|max:255',
                'user_phone' => 'required|string|max:20',

        ];
    }
}
