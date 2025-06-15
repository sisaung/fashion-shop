<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'coupon_title' => 'required|string|min:3|max:50|unique:coupons,coupon_title,'.$this->route('coupon'),
            'coupon_code' => 'required|string|min:3|max:50|unique:coupons,coupon_code,'.$this->route('coupon'),
            'coupon_discount' => 'required|numeric|min:1|max:100',
            'coupon_expire_date' => 'required|string',
        ];
    }
}
