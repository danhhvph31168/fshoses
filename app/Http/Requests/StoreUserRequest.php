<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email'     => 'required|unique',
            'password'  => 'required|max:30',
            'avatar'    => 'nullable|image',
            'phone'     => 'required|number',
            'status'    => [Rule::in([0, 1])],
            'address'   => 'nullable|max:255',
            'balance'   => 'nullable|min:0',
            'district'  => 'nullable|max:255',
            'province'  => 'nullable|max:255',
            'zip_code'  => 'number',
        ];
    }

}
