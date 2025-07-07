<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
         // ✅ Monthly Sales Revenue for 6 months (Line Chart)
    // $monthlySales = DB::table('orders')
    // ->select(DB::raw("DATE_FORMAT(created_at, '%b') as month"), DB::raw("SUM(net_total) as total"))
    // ->where('order_status', 'completed')
    // ->groupBy('month')
    // ->orderByRaw("STR_TO_DATE(month, '%b')")
    // ->pluck('total', 'month');

    // ✅ Monthly Sales Revenue for 12 months
        $sales = DB::table('orders')
        ->select(DB::raw("MONTH(created_at) as month_number"), DB::raw("SUM(net_total) as total"))
        ->where('order_status', 'completed')
        ->groupBy('month_number')
        ->orderBy('month_number')
        ->pluck('total', 'month_number');

        // Create full 12 months array initialized to 0
        $months = [
        1 => 0, 2 => 0, 3 => 0, 4 => 0,
        5 => 0, 6 => 0, 7 => 0, 8 => 0,
        9 => 0, 10 => 0, 11 => 0, 12 => 0,
        ];


        // Merge DB results into months array
        foreach ($sales as $monthNumber => $total) {
        $months[$monthNumber] = $total;
        }

        // Convert to month short names
        $monthLabels = [];
        foreach ($months as $num => $value) {
        $monthLabels[] = date("M", mktime(0, 0, 0, $num, 10)); // Jan, Feb, etc
        }

// ✅ Best-Selling Products (Bar Chart)
$bestSelling = DB::table('order_items')
    ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
    ->join('products', 'stocks.product_id', '=', 'products.id')
    ->join('product_images','products.id','=','product_images.product_id')
    ->select('products.product_name', DB::raw('SUM(order_items.quantity) as total_sold'))
    ->groupBy('products.id')
    ->orderByDesc('total_sold')
    ->take(5)
    ->pluck('total_sold', 'products.product_name');

//  Order Status Summary (Pie Chart)
$orderStatus = DB::table('orders')
    ->select('order_status', DB::raw('COUNT(*) as total'))
    ->groupBy('order_status')
    ->orderByDesc('order_status')
    ->pluck('total', 'order_status');


    //  Desired order array
$arrangeOrder = ['pending', 'confirmed', 'delivered', 'completed', 'cancelled'];

//  Reorder based on desired order
$orderedStatus = collect($arrangeOrder)->mapWithKeys(function ($status) use ($orderStatus) {
    return [$status => $orderStatus[$status] ?? 0]; // set to 0 if not exists in DB
});



return view('admin.reports.index', [
    'monthlySalesLabels' => $monthLabels,
    'monthlySalesData' => array_values($months),
    'bestSellingLabels' => $bestSelling->keys(),
    'bestSellingData' => $bestSelling->values(),
    'orderStatusLabels' => $orderedStatus->keys(),
    'orderStatusData' => $orderedStatus->values(),
]);
    }
}
