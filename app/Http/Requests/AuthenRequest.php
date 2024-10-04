<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên người dùng không được bỏ trống!",
            'name.max' => "Tên người dùng quá dài!",
            'email.required' => "Email không được bỏ trống!",
            'email.email' => "Email không hợp lệ!",
            'email.max' => "Email quá dài!",
            'email.unique' => "Email đã tồn tại!",
            'password.required' => "Password không được bỏ trống!",
            'password.min' => "Password phải chứa từ 8 ký tự trở lên!",
            'password.confirmed' => "Password không khớp!",
        ];
    }
}
