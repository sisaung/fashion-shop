<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\OrderItem;
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


         // Check if user has purchased this product
    $isVerified = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
    ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
    ->where('orders.customer_id', Auth::id())
    ->where('stocks.product_id',  $productId)
    ->where('orders.order_status', 'completed') // adjust status if your completed status is different
    ->exists();

    $isShow = 0;

    if($isVerified) {

        $isShow = 1;

    }

    $reviewData = [
        'product_id' => $product->id,
        'user_id' => Auth::id(),
        'review' => $request->review,
        'rating' => $request->rating,
        'is_show' => $isShow,
        'is_verified' => $isVerified

    ];

    // Guest handling
    if (Auth::check()) {
        $reviewData['user_id'] = Auth::id();
        Review::create($reviewData);
        return back()->with('success', 'Review submitted successfully.');
    } else {
       // Guest user
    //    $reviewData['session_id'] = session()->getId();

    //   Review::create($reviewData);


       // Store intended product page in session for redirect after login
       session(['next_action_after_login' => route('shop.show', ['slug' => $product->slug])]);
    //    session(['guest_session_id' => session()->getId()]);

       return redirect()->route('login');
    }

        // Review::create($reviewData);

        // return back()->with('success','Review provided successfully');
        // ;
    }

    public static function attachGuestReviewsToUser($userId)
    {
        $guestSessionId = session()->pull('guest_session_id'); // <- use stored value

        if (!$guestSessionId) return; // nothing to attach

        $guestReviews = Review::where('session_id', $guestSessionId)
            ->whereNull('user_id')
            ->get();

            return $guestReviews;

        foreach ($guestReviews as $guestReview) {
            $isVerified = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
                ->where('orders.customer_id', $userId)
                ->where('stocks.product_id', $guestReview->product_id)
                ->where('orders.order_status', 'completed')
                ->exists();

            $guestReview->update([
                'user_id' => $userId,
                'session_id' => null,
                'is_verified' => $isVerified,
                'is_show' => 1
            ]);
        }
    }

    public function reviewRedirectToLogin($productId) {

        $product  = Product::find($productId);
            // Store intended product page in session for redirect after login
       session(['next_action_after_login' => route('shop.show', ['slug' => $product->slug])]);
       //    session(['guest_session_id' => session()->getId()]);

          return redirect()->route('login');
    }

}
