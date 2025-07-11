<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            // 'product_code' => 'required|string|min:5|max:60|unique:products,product_code,'.$this->route('product'),
            'product_name' => 'required|string|min:3|max:50|unique:products,product_name,'.$this->route('product'),
            'original_price' => 'required|string|min:1|max:999999999',
            'sale_price' => 'required|string|min:1|max:999999999',
            'discount_type' => 'nullable',
            'discount_value' => 'nullable|numeric|min:1|max:999999999',
            'display_price' => 'required|string|min:1|max:999999999',
            'gender' => ['required', Rule::enum(Gender::class)],
            'is_new_arrival' => 'nullable',
            'brand_id' => 'required|numeric|exists:brands,id',
            'product_category_id' => 'required|numeric|exists:product_categories,id',
            'product_type_id' => 'required|numeric|exists:product_types,id',
            'fit_id' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
