<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['name','product_name', 'rating',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Review::with(['user', 'product']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                $q->whereHas('product',function(Builder $q) use($searchTerm) {
                    $q->where('product_name', 'like', "%$searchTerm%");

               })
               ->orWhereHas('user',function(Builder $q) use($searchTerm) {
                    $q->where('name', 'like', "%$searchTerm%");
               });
            });
        }

        $query->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*')
            ->groupBy('reviews.id');

        $query->orderBy($sortBy, $sortDirection);

        $review = $query->paginate($limit);
        $review->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);


        return view('admin.review.index', ['reviews' => $review]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:reviews'
        ]);

        if ($validator->fails()) {
            return redirect()->route('review.index')
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::with(['user', 'product'])->find($id);
        return view('admin.review.show', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:reviews'
        ]);

        if ($validator->fails()) {
            return redirect()->route('review.index')
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::find($id);
        $review->delete();
        return redirect()->route('review.index');
    }

    public function showReview($id, Request $request) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:reviews'
        ]);

        if ($validator->fails()) {
            return redirect()->route('review.index')
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::find($id);
        $review->is_show = $request->is_show;
        $review->save();
        return response()->json($review);
    }
}
