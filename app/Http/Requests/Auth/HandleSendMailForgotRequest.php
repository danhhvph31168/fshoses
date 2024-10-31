<?php

namespace App\Http\Requests\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HandleSendMailForgotRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống..',
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
