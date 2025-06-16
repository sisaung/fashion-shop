<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeNameRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }


    public function changeProfileImage(ChangeProfileImageRequest $request) {

        $user = $request->user();

        if($user->profile_image) {

            Storage::delete($user->profile_image);
        }

        $path = null;
        if($request->hasFile('profile_image')) {
           $path =  $request->file('profile_image')->store('profile-image','public');
        }

        $user->profile_image = $path;
        $user->save();
        return response()->json($user);

    }

    public function changeNameIndex() {
        return view('admin.profile.changeName');
    }

    public function changeName(ChangeNameRequest $request) {

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('admin-profile.index');
    }

    public function changePasswordIndex() {
        return view('admin.profile.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request) {
     $user = $request->user();


     if(Hash::check($request->old_password, $user->password)) {

        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
     }
    }

}
