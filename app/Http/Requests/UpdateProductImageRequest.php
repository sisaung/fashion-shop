<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductImageRequest extends FormRequest
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

            'original_name' => 'required|string',
            'product_id' => 'required|numeric|exists:products,id',
            // 'images' => 'nullable|array|image|mimes:png,jpg,jpeg',
            'images' => 'nullable',

        ];
    }
}
