<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StoreCouponRequest extends FormRequest
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
            'code' => 'required|string|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'minimum_order_value' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->type === 'percent' && $this->value > 100) {
                $validator->errors()->add('value', 'Value cannot be greater than 100 when type is percent.');
            }

            if ($this->minimum_order_value <= $this->value) {
                $validator->errors()->add('minimum_order_value', 'Minimum order value must be greater than value.');
            }
        });
    }
}
