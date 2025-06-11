<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductTypeRequest extends FormRequest
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

            'name' => 'required|string|min:3|max:50|unique:product_types,name,'.$this->route('product_type'),
            'product_category_id' => 'required|numeric|exists:product_categories,id',
            'fits' => 'nullable|string',
            'sizes' => 'nullable|string',
        ];
    }
}
