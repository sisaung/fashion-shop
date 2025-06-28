<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserChangeNameRequest;
use App\Http\Requests\UserProfileImageRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
}
