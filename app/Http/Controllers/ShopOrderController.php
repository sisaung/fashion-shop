<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopOrderController extends Controller
{
   public function index() {
        return view('public.order-confirmation.index');
   }
}
