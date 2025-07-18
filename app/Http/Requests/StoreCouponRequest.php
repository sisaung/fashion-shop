<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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

            'coupon_title' => 'required|string|min:3|max:50|unique:coupons,coupon_title',
            'coupon_code' => 'required|string|min:3|max:50|unique:coupons,coupon_code',
            'discount_type' => 'required|in:percentage,fixed',
            'coupon_discount' => 'required|numeric|min:1|max:99999999',
            'coupon_expire_date' => 'required|string',
        ];
    }
}
