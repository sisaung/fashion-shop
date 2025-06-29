<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserReviewController extends Controller
{
    public function getReview($productId) {

        $validator = Validator::make(['id' => $productId],[
            'id' => 'required|numeric|exists:products,id'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

       $review =  Review::with(['user'])->where('product_id',$productId)->where('is_show',1)->get();
       return $review;



       return view('public.shop.show',['reviews' => $review]);
    }
    public function store(StoreReviewRequest $request, $productId) {

        $validator = Validator::make(['id' => $productId],[
            'id' => 'required|numeric|exists:products,id'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $product = Product::find($productId);

        Review::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'review' => $request->review,
            'rating' => $request->rating
        ]);

        return redirect()->route('shop.show', ['slug' => $product->slug]);
    }
}
