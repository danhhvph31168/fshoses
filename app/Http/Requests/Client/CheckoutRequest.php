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
            'user_name'         => 'required',
            'user_email'        => (Auth::check() == true) ? 'required|email' : 'required|email|unique:users,email',
            'user_phone'        => (Auth::check() == true) ? 'required|numeric|digits_between:9,11' : 'required|numeric|digits_between:9,11|unique:users,phone',
            'user_address'      => 'required',
            'user_note'         => 'nullable',
            'payment_method'    => 'required',
        ];
    }
}
