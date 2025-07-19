<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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

            'brand_name' => 'required|string|min:3|max:50|unique:brands,brand_name,' . $this->route('brand'),
            'brand_image' => 'nullable|image|mimes:png,jpg,jpeg,webp,avif',
            // 'sort_by' => 'nullabel',
            // 'sort_direction' => 'nullabel',
            // 'limit' => 'nullabel',
            // 'page' => 'nullabel',


        ];
    }
}
