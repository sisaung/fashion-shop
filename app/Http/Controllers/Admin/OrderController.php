<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['order_number', 'product_name','total_amount' , 'order_status','order_date','id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Order::with(['orderItems','customer','coupon']);

        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('order_number', 'like', "%$searchTerm%")
                ->orWhere('total_amount', 'like', "%$searchTerm%")
                ->orWhere('order_status','like',"%$searchTerm%")

                    ->orWhereHas('coupon', function (Builder $q) use ($searchTerm) {
                        return $q->where('coupon_title', 'like', "%$searchTerm%")
                        ->$q->where('coupon_code', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('customer', function (Builder $q) use ($searchTerm) {
                        return $q->where('customer_name', 'like', "%$searchTerm%")
                        ->orWhere('customer_email', 'like', "%$searchTerm%");
                    })
                    ->orWhereHas('orderItems', function (Builder $q) use ($searchTerm) {
                        return $q->whereHas('product', function (Builder $q) use ($searchTerm) {
                            return $q->where('product_name', 'like', "%$searchTerm%");
                        });
                    });


            });
        }


        $query->orderBy($sortBy, $sortDirection);

        $order = $query->paginate($limit);
        $order->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit
        ]);



        return view('admin.order.index',['orders'=>$order]);
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
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
