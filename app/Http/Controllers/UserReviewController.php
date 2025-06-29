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
    public function getShopReview($productId, Request $request) {
        // validate product id
        $validator = Validator::make(['id' => $productId],[
            'id' => 'required|numeric|exists:products,id'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // get filter rating from request, default is 'All'
        $filterRating = $request->input('filter-rating', 'All');

        // build review query
        $review = Review::with(['user'])->where('product_id', $productId);

        if(Auth::check()) {
            $review->where(function($q) {
                $q->where('is_show', 1)
                  ->orWhere(function($q2) {
                      $q2->where('user_id', Auth::id())
                         ->where('is_show', '!=', 1);
                  });
            });
        } else {
            $review->where('is_show', 1);
        }


        if($filterRating != 'All') {
            $review->where('rating', $filterRating);
        }

        
        $review = $review->orderBy('id', 'DESC')->paginate(5);

        return response()->json($review);
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
