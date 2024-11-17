<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id'                   => ['required', Rule::exists('categories', 'id')],
            'brand_id'                      => ['required', Rule::exists('brands', 'id')],
            'name'                          => 'required|max:50',
            'sku'                           => 'required|max:255|unique:products',
            'img_thumbnail'                 => 'image',
            'price_regular'                 => 'required|min:0',
            'price_sale'                    => 'required|min:0',
            'description'                   => 'nullable|max:255',
            'content'                       => 'max:65000',

            'is_active'                     => [Rule::in([0, 1])],
            'is_hot_deal'                   => [Rule::in([0, 1])],
            'is_show_home'                  => [Rule::in([0, 1])],

            'product_variants'              => 'array',
            'product_variants.*.quantity'   => 'min:0',
            'product_variants.*.image'      => 'image',

            'product_galleries'             => 'array',
            'product_galleries.*'           => 'image',
        ];
    }
}
