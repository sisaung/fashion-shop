<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {


      $brand = Brand::query();
      $brand->whereHas('products',function ($q) {

        $q->where('stock_count','>','0');
      });

     $products =  Product::where('is_new_arrival',1)
                ->orWhere('is_trending',1)
                ->get();

        return view('home',['brands' => $brand->take(5)->get()]);
    }

    public function getLatestStyle() {

        $products =  Product::with('productImages')->where('is_new_arrival',1)
        ->orWhere('is_trending',1)
        ->take(5)
        ->get();

        return response()->json($products);
    }
}
