<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderRequest;
use App\Http\Requests\CompleteOrderRequest;
use App\Http\Requests\ConfirmOrderRequest;
use App\Http\Requests\DeliverOrderRequest;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Mail\InvoiceMail;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Stock;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validSortColumns = ['order_number', 'product_name','total_amount'  ,'order_status','order_date','id','created_at'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'created_at';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        $query = Order::with(['orderItems.stock.product','orderItems.stock.size','customer','coupon']);



        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('order_number', 'LIKE', "%$searchTerm%")
                ->orWhere('total_amount', 'LIKE', "%$searchTerm%")
                ->orWhere('order_status','LIKE',"%$searchTerm%")

                    ->orWhereHas('coupon', function (Builder $q) use ($searchTerm) {
                        return $q->where('coupon_title', 'LIKE', "%$searchTerm%")
                        ->orWhere('coupon_code', 'LIKE', "%$searchTerm%");
                    })
                    ->orWhereHas('customer', function (Builder $q) use ($searchTerm) {
                        return $q->where('customer_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('customer_email', 'LIKE', "%$searchTerm%");
                    })
                    ->orWhereHas('orderItems', function (Builder $q) use ($searchTerm) {
                        return $q->whereHas('stock', function (Builder $q) use ($searchTerm) {
                            return $q->whereHas('product', function (Builder $q) use ($searchTerm) {
                                return $q->where('product_name', 'LIKE', "%$searchTerm%");
                            });
                        });
                    });


            });
        }

        switch ($request->input('filter')) {
            case 'Paid':
                $query->where('is_paid', 1);
                break;

            case 'Unpaid':
                $query->where('is_paid', 0);
                break;

            case 'Pending':
            case 'Confirmed':
            case 'Delivered':
            case 'Completed':
            case 'Cancelled':
                $query->where('order_status', strtolower($request->input('filter')));
                break;
        }



        $query->orderBy($sortBy, $sortDirection);

        $order = $query->paginate($limit);
        $order->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit,
            'filter' => $request->input('filter')
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

//     public function confirmOrder(ConfirmOrderRequest $request,$id) {



//         $validator = Validator::make(['id' => $id], [
//             'id' => 'required|numeric|exists:orders,id'
//         ]);

//         if ($validator->fails()) {
//             return redirect()->route('order.index')
//                 ->withErrors($validator)
//                 ->withInput();
//         }


//         $order = Order::with('orderItems.stock')->find($id);
//         if($order->order_status === 'pending') {
//             $order->delivery_start_date = $request->start_date;
//             $order->delivery_end_date = $request->end_date;

//             if($order->orderItems->count() > 1) {

//                 $order->confirm_message = "Your orders have been confirmed";
//             }
//                 $order->confirm_message = "Your order has been  confirmed";

//         foreach($order->orderItems as $item) {

//             $stockId = $item->stock_id;

//             $stock = Stock::find($stockId);
//             $productId = $stock->product_id;
//             $product = Product::find($productId);



//             // next feature update


//             if($stock->stock_quantity >= $item->quantity && $stock->stock_quantity > 0 && $product->stock_count > 0 && $product->stock_count >= $item->quantity) {

//                 $stock->decrement('stock_quantity', $item->quantity);
//                 $product->decrement('stock_count', $item->quantity);
//             }
//             else {
//                 return back()->withErrors([
//                     'start_date' => 'Stock is not available.',
//                     'end_date' => 'Stock is not available.',

//                 ]);
//             }

//         }

//         $order->order_status = "confirmed";
//         $order->save();



//         if ($order->order_status === 'pending' || $order->order_status === 'cancelled') {

//             return redirect()->back()->with('error', 'Order cannot be confirmed.');
//         }




//          // Save invoice record in DB
//    $invoice =  Invoice::create([
//         'order_id' => $order->id,
//         'invoice_number' => 'INV-' . Str::padLeft($order->id, 6, '0'),
//         // 'pdf_path' => $pdfFilePath,
//         'status' => 'generated',
//     ]);

//     // Generate PDF file path
//     $pdfPath = storage_path("app/public/invoices/invoice-{$order->order_number}.pdf");

//     // Make sure directory exists
//     if (!file_exists(dirname($pdfPath))) {
//         mkdir(dirname($pdfPath), 0777, true);
//     }

//     // Generate PDF with Tailwind support
//     Browsershot::html(
//         view('admin.invoices.pdf', ['invoice' => $invoice, 'order' => $order])->render()
//     )
//         ->format('A4')
//         ->margins(10, 10, 10, 10)
//         ->waitUntilNetworkIdle()
//         ->save($pdfPath);

//         Mail::to($order->customer->customer_email)->send(new InvoiceMail($order, $invoice, $pdfPath));

//         return redirect()->route('order.show',['order' => $order->id])->with('success','Order confirmed successfully');
//         }


//     }

public function confirmOrder(ConfirmOrderRequest $request, $id)
{
    // Validate order ID
    $validator = Validator::make(['id' => $id], [
        'id' => 'required|numeric|exists:orders,id'
    ]);

    if ($validator->fails()) {
        return redirect()->route('order.index')
            ->withErrors($validator)
            ->withInput();
    }

    // Wrap everything in a transaction
    DB::beginTransaction();

    try {
        // Load order with items + customer
        $order = Order::with(['orderItems.stock.product', 'customer'])->findOrFail($id);

        if ($order->order_status !== 'pending' || $order->order_status === 'cancelled') {
            return redirect()->back()->with('error', 'Order cannot be confirmed.');
        }

        // Set delivery dates
        $order->delivery_start_date = $request->start_date;
        $order->delivery_end_date   = $request->end_date;

        // Confirmation message
        $order->confirm_message = $order->orderItems->count() > 1
            ? "Your orders have been confirmed"
            : "Your order has been confirmed";

        // Check stock & decrement
        foreach ($order->orderItems as $item) {
            $stock   = $item->stock;
            $product = $stock->product;

            if (
                $stock->stock_quantity >= $item->quantity &&
                $product->stock_count >= $item->quantity
            ) {
                $stock->decrement('stock_quantity', $item->quantity);
                $product->decrement('stock_count', $item->quantity);
            } else {
                DB::rollBack();
                return back()->withErrors([
                    'start_date' => 'Stock is not available.',
                    'end_date'   => 'Stock is not available.',
                ]);
            }
        }

        // Update order status
        $order->order_status = "confirmed";
        $order->save();

        // Save invoice record
        $invoice = Invoice::create([
            'order_id'       => $order->id,
            'invoice_number' => 'INV-' . Str::padLeft($order->id, 6, '0'),
            'status'         => 'generated',
        ]);

        // Generate PDF path
        $pdfPath = storage_path("app/public/invoices/invoice-{$order->order_number}.pdf");

        if (!file_exists(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0777, true);
        }

        // Generate PDF with Tailwind styles using Browsershot
        Browsershot::html(
            view('admin.invoices.pdf', compact('invoice', 'order'))->render()
        )
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->waitUntilNetworkIdle()
            ->save($pdfPath);

        // Commit transaction
    DB::commit();

        // Send invoice email with attachment
        // Mail::to($order->customer->customer_email)
        //     ->send(new InvoiceMail($order, $invoice, $pdfPath));

        return redirect()->route('order.show', ['order' => $order->id])
            ->with('success', 'Order confirmed successfully and invoice sent to customer.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
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

            return redirect()->route('order.show',['order' => $order->id])->with('success','Order delivered successfully');
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

                    $productIds = OrderItem::join('stocks', 'order_items.stock_id', '=', 'stocks.id')
                    ->where('order_items.order_id', $order->id)
                    ->pluck('stocks.product_id')
                    ->toArray();

                        $order->confirm_message = "Your order completed";
                        Review::where('user_id', $order->customer_id)
                        ->whereIn('product_id', $productIds)
                        ->update([
                            'is_verified' => true,
                            'is_show' => 1
                        ]);
                    $order->save();

                    return redirect()->route('order.show',['order' => $order->id])->with('success','Order completed successfully');
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


    public function markAsPaid ($id,Request $request) {


        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('order.index')
                ->withErrors($validator)
                ->withInput();
        }





        $order = Order::findOrFail($id);
        $order->is_paid = 1;
        $order->payment_received_at = now();
        $order->save();

        return redirect()->route('order.index',['sort_by' => $request->sortBy,'sort_direction' => $request->sortDirection,'limit' => $request->limit,'page' => $request->page]);
    }

}

