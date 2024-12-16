<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
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
            'user_name'      => 'required',
            'user_email'     => 'required|email',
            'user_phone'     => 'required|numeric|digits_between:9,11',
            'user_address'   => 'required',
            'user_province'  => 'required',
            'user_district'  => 'required',
            'user_ward'      => 'required',
            'user_note'      => 'nullable|max:150',
            'payment_method' => 'required',
        ];
    }
}
