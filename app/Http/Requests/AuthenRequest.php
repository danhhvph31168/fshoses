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
            'role_id'   => 'required|integer|exists:roles,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'phone'     => 'required|digits_between:10,15',
            'address'   => 'required|max:500',
            'balance'   => 'required|numeric|min:0',
            'district'  => 'required|string|max:255',
            'province'  => 'required|string|max:255',
            'zip_code'  => 'required|string|max:10',
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
            'phone.required' => "Số điện thoại không được bỏ trống!",
            'phone.digits_between' => "Số điện thoại phải nằm trong khoảng từ 10 đến 15 chữ số.",
            'address.required' => "Địa chỉ không được bỏ trống!",
            'address.max' => "Địa chỉ không hợp lệ! Tối đa 500 ký tự!",
            'balance.required' => "Số dư tài khoản không được bỏ trống!",
            'balance.numeric' => "Số dư tài khoản không hợp lệ!",
            'balance.min' => "Số dư tài khoản không hợp lệ!",
            'district.required' => "Quận/Huyện không được bỏ trống!",
            'district.string' => "Quận/Huyện không đúng định dạng!",
            'district.max' => "Quận/Huyện không hợp lệ! Tối đa 255 ký tự!",
            'province.required' => "Tỉnh/TP không được bỏ trống!",
            'province.string' => "Tỉnh/TP không đúng định dạng!",
            'province.max' => "Tỉnh/TP không hợp lệ! Tối đa 255 ký tự!",
            'zip_code.required' => "Mã Zip không được bỏ trống!",
            'zip_code.string' => "Mã Zip không đúng định dạng!",
            'zip_code.max' => "Mã Zip không hợp lệ! Tối đa 10 ký tự!",
        ];
    }
}
