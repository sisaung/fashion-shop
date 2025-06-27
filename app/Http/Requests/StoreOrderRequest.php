<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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

            'customer' => 'required|array',
            'customer.name' => 'required|string|max:255',
            'customer.email' => 'required|email|max:255',
            'customer.profile_image' => 'nullable|string',

            'address_id' => 'required|numeric|exists:user_addresses,id',
            'coupon_id' => 'nullable|numeric|exists:coupons,id',
            'order_date' => 'required|string',
            'total_amount' => 'required|numeric|min:1|max:999999999',
            'tax_amount' => 'required|numeric|min:0|max:999999999',
            'net_total' => 'required|numeric|min:1|max:999999999',

            'order_items' => 'required|array|min:1',
            'order_items.*.stock_id' => 'required|numeric|exists:stocks,id',
            'order_items.*.price' => 'required|numeric|min:1|max:999999999',
            'order_items.*.quantity' => 'required|numeric|min:1|max:9999',


        ];
    }
}
