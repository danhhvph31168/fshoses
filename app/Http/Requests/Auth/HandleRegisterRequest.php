<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class HandleRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'Tên là bắt buộc.',
    //         'name.string' => 'Tên phải là chuỗi ký tự.',
    //         'name.max' => 'Tên không được vượt quá :max ký tự.',

    //         'email.required' => 'Email là bắt buộc.',
    //         'email.email' => 'Email không hợp lệ.',
    //         'email.unique' => 'Email đã tồn tại.',

    //         'password.required' => 'Mật khẩu là bắt buộc.',
    //         'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
    //         'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
    //     ];
    // }
    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors();

    //     $response = response()->json([
    //         'errors' => $errors->messages(),
    //     ], 400);
    //     throw new HttpResponseException($response);
    // }
}
