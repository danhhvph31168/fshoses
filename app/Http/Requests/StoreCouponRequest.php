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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'code.required' => 'The coupon code is required.',
    //         'code.string' => 'The coupon code must be a string.',
    //         'code.unique' => 'The coupon code has already been taken.',
    //         'type.required' => 'You must select a coupon type.',
    //         'type.in' => 'The selected coupon type is invalid.',
    //         'value.required' => 'The value is required.',
    //         'value.numeric' => 'The value must be a number.',
    //         'quantity.required' => 'The quantity is required.',
    //         'quantity.integer' => 'The quantity must be an integer.',
    //         'quantity.min' => 'The quantity must be at least 1.',
    //         'start_date.required' => 'The start date is required.',
    //         'start_date.date' => 'The start date must be a valid date.',
    //         'end_date.required' => 'The end date is required.',
    //         'end_date.date' => 'The end date must be a valid date.',
    //         'end_date.after' => 'The end date must be after the start date.'
    //     ];
    // }
}
