<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderRequest;
use App\Http\Requests\CompleteOrderRequest;
use App\Http\Requests\ConfirmOrderRequest;
use App\Http\Requests\DeliverOrderRequest;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['order_number', 'product_name','total_amount'  ,'order_status','order_date','id'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'id';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Order::with(['orderItems.stock.product','orderItems.stock.size','customer','coupon']);

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
    public function show($id)
    {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:orders'
        ]);

        if ($validator->fails()) {
            return redirect()->route('order.index')
                ->withErrors($validator)
                ->withInput();
        }

        $order = Order::with(['orderItems','customer','coupon'])->find($id);
        foreach($order->orderItems as $item){
            $productId = $item->product_id;
            $product = Product::find($productId);

        }

        return view('admin.order.show',['order' => $order]);
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

    public function confirmOrder(ConfirmOrderRequest $request,$id) {


        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('order.index')
                ->withErrors($validator)
                ->withInput();
        }


        $order = Order::with('orderItems.stock')->find($id);
        if($order->order_status === 'pending') {
            $order->delivery_start_date = $request->start_date;
            $order->delivery_end_date = $request->end_date;

            if($order->orderItems->count() > 1) {

                $order->confirm_message = "Your orders have been confirmed";
            }
                $order->confirm_message = "Your order has been  confirmed";

        foreach($order->orderItems as $item) {

            $stockId = $item->stock_id;

            $stock = Stock::find($stockId);
            $productId = $stock->product_id;
            $product = Product::find($productId);



            if($stock->stock_quantity > $item->quantity && $stock->stock_quantity > 0 && $product->stock_count > 0 && $product->stock_count > $item->quantity) {

                $stock->decrement('stock_quantity', $item->quantity);
                $product->decrement('stock_count', $item->quantity);
            }
            else {
                return back()->withErrors([
                    'start_date' => 'Stock is not available.',
                    'end_date' => 'Stock is not available.',

                ]);
            }

        }
        $order->order_status = "confirmed";
        $order->save();

        return redirect()->route('order.show',['order' => $order->id]);
        }


    }

    public function deliverOrder(DeliverOrderRequest $request,$id) {

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('order.index')
                ->withErrors($validator)
                ->withInput();
        }


        $order = Order::find($id);
        if($order->order_status === 'confirmed' && $request->deliver_order ) {

            $order->order_status = "delivered";
            if($order->orderItems->count() > 1) {

                $order->deliver_message = "Your orders have been delivered";
            }
                $order->deliver_message = "Your order has been  delivererd";


            $order->save();

            return redirect()->route('order.show',['order' => $order->id]);
            }
            else {
                return back()->withErrors([
                    'deliverOrder' => 'Make sure to deliver order.',

                ]);
            }

        }

        public function completeOrder(CompleteOrderRequest $request,$id) {

        $validator = Validator::make(['id' => $id], [
                    'id' => 'required|numeric|exists:orders,id'
                ]);

                if ($validator->fails()) {
                    return redirect()->route('order.index')
                        ->withErrors($validator)
                        ->withInput();
                }


                $order = Order::find($id);
                if($order->order_status === 'delivered' && $request->complete_order ) {

                    $order->order_status = "completed";

                    if($order->orderItems->count() > 1) {

                        $order->confirm_message = "Your orders completed";
                    }
                        $order->confirm_message = "Your order completed";
                    $order->save();

                    return redirect()->route('order.show',['order' => $order->id]);
                    }
                    else {
                        return back()->withErrors([
                            'deliverOrder' => 'Make sure to deliver order.',

                        ]);
                    }

                }



                public function cancelOrder(CancelOrderRequest $request,$id) {


                    $validator = Validator::make(['id' => $id], [
                        'id' => 'required|numeric|exists:orders,id'
                    ]);

                    if ($validator->fails()) {
                        return redirect()->route('order.index')
                            ->withErrors($validator)
                            ->withInput();
                    }



                    $order = Order::with('orderItems.stock')->find($id);


                    if($order->order_status !== 'cancelled' && $request->sure_cancel_order ) {


                       if($order->order_status !== "pending") {
                        foreach($order->orderItems as $item) {

                            $stockId = $item->stock_id;

                            $stock = Stock::find($stockId);
                            $stock->increment('stock_quantity', $item->quantity);

                            $productId = $stock->product_id;
                            $product = Product::find($productId);
                            $product->increment('stock_count', $item->quantity);

                        }
                    }
                        $order->is_cancel = 1;
                        $order->order_status = "cancelled";
                        $order->cancel_message = $request->reason;

                    
                    $order->save();
                    return redirect()->route('order.show',['order' => $order->id]);

                    }else {
                        return back()->withErrors([
                            'cancelOrder' => 'Make sure to cancel order.',

                        ]);
                    }



                }

}

