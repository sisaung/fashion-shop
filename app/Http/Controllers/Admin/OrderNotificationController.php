<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderNotification;
use Illuminate\Http\Request;

class OrderNotificationController extends Controller
{
    public function index() {

        $noti = OrderNotification::with('order','order.customer','order.orderItems')->latest()->take(10)->orderBy('created_at','desc')->get();
        return response()->json($noti);
    }
}
