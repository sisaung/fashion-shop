<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $notifications = $user->notifications()->latest()->get()->map(function ($notification) {
            return [
                'id' => $notification->id,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'unreadcount' => $notification->unreadcount,
                'created_at' => $notification->created_at->toDateTimeString(),
            ];
        });

        return response()->json($notifications);
    }

    public function markAsReadNotification($notificationId) {

        $validator = Validator::make(['id' => $notificationId], [
            'id' => 'required|exists:notifications'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       $user =  User::find(Auth::user()->id);


        $notification = $user->notifications()->findOrFail($notificationId);



    if ($notification->read_at === null) {
        $notification->markAsRead();
    }
    return response()->json(['status' => 'read']);
    }

    public function markAsReadAllNotification() {



       $user =  User::find(Auth::user()->id);


       foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
    }


    return response()->json(['status' => 'read']);
    }
}
