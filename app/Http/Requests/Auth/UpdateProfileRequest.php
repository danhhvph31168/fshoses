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
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'phone' => 'nullable|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'zip_code' => 'nullable|numeric|digits_between:3,10',
        ];
    }

    // Tùy chỉnh thông báo lỗi
    public function messages()
    {
        return [
            'name.required' => 'Tên là trường bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự hợp lệ.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'avatar.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png, hoặc gif.',
            'avatar.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB.',
            'phone.regex' => 'Số điện thoại phải là một chuỗi số từ 10 đến 15 ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'balance.numeric' => 'Số dư phải là một số hợp lệ.',
            'balance.min' => 'Số dư không được nhỏ hơn 0.',
            'district.max' => 'Quận/Huyện không được vượt quá 255 ký tự.',
            'province.max' => 'Tỉnh/Thành phố không được vượt quá 255 ký tự.',
            'zip_code.numeric' => 'Mã bưu điện phải là số.',
            'zip_code.digits_between' => 'Mã bưu điện phải có từ 3 đến 10 chữ số.',
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
