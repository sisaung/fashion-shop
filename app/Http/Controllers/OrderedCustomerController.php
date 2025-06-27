<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderedCustomerController extends Controller
{
    public function store(StoreCustomerRequest $request) {
      $customer =  Customer::create([
            'customer_name' =>  $request->customer_name,
            'customer_email' =>  $request->customer_email,
            'profile_image' =>  $request->profile_image,

        ]);
        return response()->json(['message' => 'Customer created successfully', 'data' => $customer]);
    }

}
