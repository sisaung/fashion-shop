<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['name', 'product_name',  'id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Wishlist::with(['user', 'products']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                $q->whereHas('products', function (Builder $q) use ($searchTerm) {
                    $q->where('product_name', 'like', "%$searchTerm%");
                })
                    ->orWhereHas('user', function (Builder $q) use ($searchTerm) {
                        $q->where('name', 'like', "%$searchTerm%");
                    });
            });
        }

        $query->join('users', 'wishlists.user_id', '=', 'users.id')
            ->join('product_wishlist', 'wishlists.id', '=', 'product_wishlist.wishlist_id')
            ->join('products', 'product_wishlist.product_id', '=', 'products.id')
            ->select('wishlists.*')
            ->groupBy('wishlists.id', 'wishlists.name', 'wishlists.user_id', 'wishlists.created_at', 'wishlists.updated_at');


        $query->orderBy($sortBy, $sortDirection);

        $wishlist = $query->paginate($limit);
        $wishlist->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return view('admin.wishlist.index', ['wishlists' => $wishlist]);
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
    public function store(StoreWishlistRequest $request)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return response()->json([
               'message' => 'Unauthenticated'
            ], 401);
        }


        // Get or create wishlist for user
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);

        $wishlist->products()->syncWithoutDetaching($request->product_id);
        $wishlist->load('products');



        return response()->json(['message' => 'Product added to wishlist successfully.','success' => true,'wishlist' => $wishlist], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:wishlists,id']);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $wishlist = Wishlist::with(['products','user','user.address'])->find($id);

        if($wishlist) {
            return view('admin.wishlist.show', ['wishlist' => $wishlist]);
        }

        return redirect()->route('wishlist.index')->with('error', 'Wishlist not found.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return response()->json([
               'message' => 'Unauthenticated'
            ], 401);
        }

        $validator = Validator::make(['product_id' => $productId], [
            'product_id' => 'required|exists:products,id',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $wishlist = Wishlist::where('user_id', $user->id)->first();
        $wishlist->products()->detach($productId);

        return redirect()->route('wishlist.showWishlistShow')->with('success', 'Product removed from wishlist successfully.');
    }

    public function destroyWishlist($productId)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return response()->json([
               'message' => 'Unauthenticated'
            ], 401);
        }

        $validator = Validator::make(['product_id' => $productId], [
            'product_id' => 'required|exists:products,id',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $wishlist = Wishlist::where('user_id', $user->id)->first();
        $wishlist->products()->detach($productId);

        return response()->json(['message' => 'Product removed from wishlist successfully.','success' => true], 200);
    }

    public function getWishList() {
        $user = Auth::user();

        if (!Auth::check()) {
            return response()->json([
               'message' => 'Unauthenticated'
            ], 401);
        }

        $wishlist = Wishlist::where('user_id', $user->id)->first();
        if($wishlist) {

            $wishlist->load('products');
        }

        return response()->json(['message' => 'Product added to wishlist successfully.','success' => true,'wishlist' => $wishlist], 200);
    }

    public function showWishlistShow() {

        $wishlist = Wishlist::where('user_id', Auth::user()->id)->first();
        if ($wishlist) {
            $wishlist->load(['products' => function ($query) {
                $query->orderBy('id', 'desc');
            }]);
        }


        return view('public.wishlist.index',['wishlist' => $wishlist]);
    }

    public function removeAllWishlist() {
        if (!Auth::check()) {
            return response()->json([
               'message' => 'Unauthenticated'
            ], 401);
        }

        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if ($wishlist) {
            $wishlist->products()->detach();
        }

        return redirect()->back()->with('success', 'All wishlist items removed successfully.');
    }

}
