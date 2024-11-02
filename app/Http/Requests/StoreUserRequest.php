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
            'email'     => 'required|max:255|unique:users',
            'password'  => 'required|max:255',
            'avatar'    => 'image',
            'phone'     => 'required',
            'status'    => [Rule::in([0, 1])],
            'address'   => 'max:255',
            'balance'   => 'min:0',
            'district'  => 'max:255',
            'province'  => 'max:255'
        ];
    }
}
