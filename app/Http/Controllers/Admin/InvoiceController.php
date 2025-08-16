<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Spatie\Browsershot\Browsershot;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validSortColumns = ['invoice_number','customer_name','total_amount','status','id','created_at'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns) ? $request->input('sort_by') : 'created_at';

        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc']) ? $request->input('sort_direction') : 'desc';


        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 ? $limit : 5;

        $searchTerm = $request->input('q');

        // $query = Order::with(['orderItems.stock.product','orderItems.stock.size','customer','coupon']);
        $query = Invoice::with(['order']);


        if ($searchTerm) {

            $query->where(function (Builder $q) use ($searchTerm) {

                return $q->where('invoice_number', 'LIKE', "%$searchTerm%")
                ->orWhereHas('order',function ($q) use ($searchTerm) {

                    $q->where('customer_name','LIKE',"%$searchTerm%")
                    ->orwhere('total_amount','LIKE',"%$searchTerm%")
                    ->orWhereHas('customer_address',function($q) use($searchTerm){

                        $q->where('address_detail');
                    });


                });
                // ->orWhere('total_amount', 'LIKE', "%$searchTerm%")
                // ->orWhere('order_status','LIKE',"%$searchTerm%")

                //     ->orWhereHas('coupon', function (Builder $q) use ($searchTerm) {
                //         return $q->where('coupon_title', 'LIKE', "%$searchTerm%")
                //         ->orWhere('coupon_code', 'LIKE', "%$searchTerm%");
                //     })
                //     ->orWhereHas('customer', function (Builder $q) use ($searchTerm) {
                //         return $q->where('customer_name', 'LIKE', "%$searchTerm%")
                //         ->orWhere('customer_email', 'LIKE', "%$searchTerm%");
                //     })
                //     ->orWhereHas('orderItems', function (Builder $q) use ($searchTerm) {
                //         return $q->whereHas('stock', function (Builder $q) use ($searchTerm) {
                //             return $q->whereHas('product', function (Builder $q) use ($searchTerm) {
                //                 return $q->where('product_name', 'LIKE', "%$searchTerm%");
                //             });
                //         });
                //     });


            });
        }

        // switch ($request->input('filter')) {
        //     case 'Paid':
        //         $query->where('is_paid', 1);
        //         break;

        //     case 'Unpaid':
        //         $query->where('is_paid', 0);
        //         break;

        //     case 'Pending':
        //     case 'Confirmed':
        //     case 'Delivered':
        //     case 'Completed':
        //     case 'Cancelled':
        //         $query->where('order_status', strtolower($request->input('filter')));
        //         break;
        // }


        $query->join('orders', 'invoices.order_id', '=', 'orders.id')

        ->select('invoices.*');

        $query->orderBy($sortBy, $sortDirection);

        $invoice = $query->paginate($limit);
        $invoice->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit,
            // 'filter' => $request->input('filter')
        ]);



        return view('admin.invoices.index',['invoices'=>$invoice]);
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
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:invoices'
        ]);

        if ($validator->fails()) {
            return redirect()->route('invoices.index')
                ->withErrors($validator)
                ->withInput();
        }

       $invoice =  Invoice::with('order')->find($id);
       return view('admin.invoices.show',['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }


//     public function generateInvoicePDF($invoiceId)
// {
//     $invoice = Invoice::with('order.orderItems.stock.product', 'order.customerAddress', 'order.coupon')
//         ->findOrFail($invoiceId);

//     $order = $invoice->order;

//     // Create folder if missing
//     $pdfFolder = storage_path('app/public/invoices');
//     if (!file_exists($pdfFolder)) {
//         mkdir($pdfFolder, 0755, true);
//     }

//     $pdfFilePath = "invoices/invoice_{$invoice->id}.pdf";
//     $fullPath = storage_path("app/public/{$pdfFilePath}");

//     // Generate PDF from Blade
//     $html = view('admin.invoices.pdf', compact('invoice', 'order'))->render();

//     Browsershot::html($html)
//         ->noSandbox()
//         ->waitUntilNetworkIdle()
//         ->save($fullPath);

//     // Save path in DB
//     $invoice->update(['pdf_path' => $pdfFilePath]);

//     return response()->download($fullPath);
// }

public function generateInvoicePDF($invoiceId)
{
    $invoice = Invoice::with('order.orderItems.stock.product', 'order.customerAddress', 'order.coupon')
        ->findOrFail($invoiceId);

    $order = $invoice->order;

    // Create folder if missing
    $pdfFolder = storage_path('app/public/invoices');
    if (!file_exists($pdfFolder)) {
        mkdir($pdfFolder, 0755, true);
    }

    $pdfFilePath = "invoices/invoice_{$invoice->id}.pdf";
    $fullPath = storage_path("app/public/{$pdfFilePath}");

    // Generate PDF from Blade
    $html = view('admin.invoices.pdf', compact('invoice', 'order'))->render();

    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    $cssFile = public_path('build/' . $manifest['resources/css/app.css']['file']);
    if (!file_exists($cssFile)) {
        throw new \Exception("CSS file not found: {$cssFile}");
    }

    $css = file_get_contents($cssFile);

    Browsershot::html($html)
        ->addStyle($css)          // <-- add Tailwind CSS here
        ->noSandbox()
        ->waitUntilNetworkIdle()
        ->format('A4')
        ->save($fullPath);

    // Save path in DB
    $invoice->update(['pdf_path' => $pdfFilePath]);

    return response()->download($fullPath);
}

}
