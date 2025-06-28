<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopOrderCancelRequest extends FormRequest
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

            'cancel_reason' => 'required|string|min:3|max:100',
            'sure_cancel_order' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cancel_reason.required' => 'Reason is required',
            'cancel_reason.string' => 'Reason must be a string',
            'cancel_reason.min' => 'Reason must be at least 3 characters',
            'cancel_reason.max' => 'Reason must not exceed 100 characters',
            'sure_cancel_order.required' => 'Please confirm to cancel order',
        ];
    }
}
