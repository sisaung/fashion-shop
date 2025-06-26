<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class ShopOrderController extends Controller
{
   public function index() {
        return view('public.order-confirmation.index');
   }

   public function checkCoupon(Request $request) {

    $couponCode = $request->input('coupon_code');
    $coupon = Coupon::where('coupon_code',$couponCode)->first();

   $currentDate = now()->format('Y-m-d');


    if(!$coupon ) {

      return response()->json('Invalid Coupon');

    }
    if($coupon->coupon_expire_date < $currentDate) {

      return response()->json('Coupon Expired');
    }
    return response()->json(['message' => 'Valid Coupon','coupon_discount' => $coupon->coupon_discount]);

   }
}
