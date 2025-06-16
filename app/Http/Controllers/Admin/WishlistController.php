<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
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
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
