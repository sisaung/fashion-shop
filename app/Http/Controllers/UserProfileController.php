<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserAddressRequest;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserChangeNameRequest;
use App\Http\Requests\UserProfileImageRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function changeProfileImage(UserProfileImageRequest $request) {
        $user = $request->user();


        if($user->profile_image) {

            Storage::delete($user->profile_image);
        }

        $path = null;

        if($request->hasFile('profile_image')) {
               $path =  $request->file('profile_image')->store('profile_images','public');
        }
        $user->profile_image = $path;
        $user->save();
        return "";
    }



    public function changeName(UserChangeNameRequest $request) {

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('account.showProfileInformation');
    }

    public function addressIndex() {
        return view('public.account.address.index');
    }

    public function storeAdress(UserAddressRequest $request) {

        UserAddress::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'township' => $request->township,
            'address_detail' => $request->address_detail
        ]);



        // return redirect()->route('account.addressIndex');
        return redirect()->back()->with('success', 'Address added successfully.');

}

public function destroyAddress($id) {
    $validator = Validator::make(['id' => $id], [
        'id' => 'required|exists:user_addresses,id'
    ]);
    if($validator->fails()) {
        return redirect()->route('account.addressIndex');
    }
    $address = UserAddress::find($id);
    $address->delete();
    // return redirect()->route('account.addressIndex');
    return redirect()->back()->with('success', 'Address deleted successfully.');

}

public function updateAddress(UpdateUserAddressRequest $request,$id) {
    $validator = Validator::make(['id' => $id], [
        'id' => 'required|exists:user_addresses,id'
    ]);
    if($validator->fails()) {
        return redirect()->route('account.addressIndex');
    }
    $address = UserAddress::find($id);

    $address->phone_number = $request->phone_number;
    $address->city = $request->city;
    $address->township = $request->township;
    $address->address_detail = $request->address_detail;
    $address->save();
    // return redirect()->route('account.addressIndex');
    return redirect()->back()->with('success', 'Address updated successfully.');

}
}
