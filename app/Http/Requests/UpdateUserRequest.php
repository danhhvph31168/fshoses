<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'role_id'   => ['required', Rule::exists('roles', 'id')],
            'name'      => 'required|max:255',
            'email'     => 'required|max:255',
            'password'  => 'required|max:255',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,gif|',
            'phone'     => 'required',
            'status'    => [Rule::in([0, 1])],
            'address' => 'nullable|string|max:255',
            'district' => 'nullable',
            'province' => 'nullable',
            'ward' => 'nullable',
        ];
    }
}
