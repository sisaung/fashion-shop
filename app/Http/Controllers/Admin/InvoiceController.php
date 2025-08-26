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
            return redirect()->route('invoice.index')
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

// public function generateInvoicePDF($invoiceId)
// {
//     $invoice = Invoice::with('order.orderItems.stock.product', 'order.customerAddress', 'order.coupon')
//         ->findOrFail($invoiceId);

//     $order = $invoice->order;

//     // Create folder if missing
//     $pdfFolder = storage_path('app/public/invoices');
//     if (!file_exists($pdfFolder)) {
//         mkdir($pdfFolder, 0755, true);
//     }

//     $pdfFilePath = "invoices/invoice_{$invoice->invoice_number}.pdf";
//     $fullPath = storage_path("app/public/{$pdfFilePath}");

//     // Render Blade HTML
//     $html = view('admin.invoices.pdf', compact('invoice', 'order'))->render();

//     // For Tailwind v4, we need to include the runtime engine
//     $tailwindRuntime = <<<HTML
//     <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
//     <script>
//         tailwind.config = {
//             important: '#tailwind-pdf',
//         }
//     </script>
//     HTML;

//     $fullHtml = <<<HTML
// <!DOCTYPE html>
// <html lang="en">
// <head>
//   <meta charset="UTF-8">
//   <title>Invoice</title>
//   {$tailwindRuntime}
//   <style>
//     @media print {
//         body {
//             -webkit-print-color-adjust: exact;
//             print-color-adjust: exact;
//         }
//     }
//     #tailwind-pdf {
//         all: initial;
//     }
//   </style>
// </head>
// <body>
//   <div id="tailwind-pdf" class="bg-gray-100 p-6">
//     {$html}
//   </div>
// </body>
// </html>
// HTML;

//     // Generate PDF
//     Browsershot::html($fullHtml)
//         ->noSandbox()
//         ->waitUntilNetworkIdle()
//         ->emulateMedia('print')
//         ->showBackground()
//         ->format('A4')
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

    $pdfFilePath = "invoices/invoice_{$invoice->invoice_number}.pdf";
    $fullPath = storage_path("app/public/{$pdfFilePath}");

    // ✅ Load Tailwind CSS from Vite manifest
    $manifestPath = public_path('build/manifest.json');
    if (!file_exists($manifestPath)) {
        throw new \Exception('Vite manifest.json not found. Run "npm run build".');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);

    if (!isset($manifest['resources/css/app.css']['file'])) {
        throw new \Exception('CSS entry not found in manifest.json');
    }

    $cssFile = $manifest['resources/css/app.css']['file']; // e.g. assets/app-xyz123.css
    $cssPath = public_path("build/{$cssFile}");
    $css     = file_get_contents($cssPath);

    // Render Blade HTML
    $html = view('admin.invoices.pdf', compact('invoice', 'order'))->render();

    // Build full HTML with Tailwind CSS inline
    $fullHtml = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <style>
    {$css}
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
  </style>
</head>
<body class="bg-gray-100 p-6">
  {$html}
</body>
</html>
HTML;

    // Generate PDF with Tailwind
    Browsershot::html($fullHtml)
        ->noSandbox()
        ->waitUntilNetworkIdle()
        ->emulateMedia('print')
        ->showBackground()
        ->format('A4')
        ->save($fullPath);

    // Save path in DB
    $invoice->update(['pdf_path' => $pdfFilePath]);
    $invoice->save();

    return response()->download($fullPath);
}

}
