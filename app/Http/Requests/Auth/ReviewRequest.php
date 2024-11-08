<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'comment' => 'required|string|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'comment.required' => 'Bình luận không được để trống. Vui lòng nhập nội dung bình luận.',
            'comment.string' => 'Bình luận phải là chuỗi ký tự.',
            'comment.max' => 'Bình luận không được vượt quá 1000 ký tự.',
        ];
    }
}
