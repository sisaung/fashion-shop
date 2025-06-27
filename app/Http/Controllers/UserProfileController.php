<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index() {


    }


    public function store(UserAddressRequest $request) {
        UserAddress::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'township' => $request->township,
            'address_detail' => $request->address_detail
        ]);



        return redirect()->route('order-confirmation.index');
    }
}
