<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopOrderController extends Controller
{
   public function index() {
       $userAddress =  UserAddress::all();

        return view('public.order-confirmation.index',['useAddress' => $userAddress]);
   }


   public function store(StoreOrderRequest $request) {

    function generateOrderNumber() {
        $prefix = 'ORDER';
        $number = rand(10000, 99999); // 5 digit number

        $letters = '';
        for ($i = 0; $i < 3; $i++) {
            $letters .= chr(rand(65, 90)); // A-Z
        }

        return $prefix . $number . $letters;
    }

    // 1. Find or create customer
    $customer = Customer::firstOrCreate(
    ['customer_email' => $request->customer['email']],
    [
        'customer_name' => $request->customer['name'],
        'profile_image' => $request->customer['profile_image'],
    ]
);


    // 2. Get user address
$userAddress = UserAddress::where('id', $request->address_id)
->where('user_id',Auth::id())
->firstOrFail();

// 3. Create customer address (snapshot)
$customerAddress = CustomerAddress::create([
'customer_id' => $customer->id,
'phone_number' => $userAddress->phone_number,
'city' => $userAddress->city,
'township' => $userAddress->township,
'address_detail' => $userAddress->address_detail,
]);



$order = Order::create([
    'order_number' => generateOrderNumber(),
   'order_date' => $request->order_date,
    'customer_id' => $customer->id,
    'customer_address_id' => $customerAddress->id,
    'coupon_id' => $request->coupon_id,
    'total_amount' => $request->total_amount,
    'tax_amount' => $request->tax_amount,
    'net_total' => $request->net_total,

]);

$orderId = $order->id;
foreach($request->order_items as $item) {

   OrderItem::create([
        'order_id' => $orderId,
        'stock_id' => $item['stock_id'],
        'sale_price' => $item['price'],
        'quantity' => $item['quantity'],
    ]);
}

return response()->json(['message' => 'Order created successfully','data'=>$order,'success'=> true]);

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
    return response()->json(['message' => 'Valid Coupon','coupon_id' => $coupon->id,'coupon_discount' => $coupon->coupon_discount]);

   }

   public function getDeliveryAddress() {
    $userAddress =  UserAddress::all();
    return view('public.order-confirmation.index',['userAddress' => $userAddress]);
}

public function getOrders() {

    $userOrders = Order::with(['orderItems','customerAddress','orderItems.stock','orderItems.stock.product'])->where('customer_id',Auth::id())->get();

    return view('public.account.order.index',['orders' => $userOrders]);
}
}
