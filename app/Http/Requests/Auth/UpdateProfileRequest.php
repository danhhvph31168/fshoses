<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
            'district' => 'nullable',
            'province' => 'nullable',
            'ward' => 'nullable',
            'zip_code' => 'nullable|numeric|digits_between:3,10',
        ];
    }

   
    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors();

    //     $response = response()->json([
    //         'errors' => $errors->messages(),
    //     ], 400);
    //     throw new HttpResponseException($response);
    // }
}
