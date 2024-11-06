<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
        $id = $this->route('coupon'); // Lấy id từ route

        return [
            'code' => 'required|string|unique:coupons,code,' . $id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ];
    }
}
