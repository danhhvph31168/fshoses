<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HandleForgotPassRequest extends FormRequest
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
            'password' => 'required|confirmed|min:8',
        ];
    }
    public function messages(): array
    {
        return [

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
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
