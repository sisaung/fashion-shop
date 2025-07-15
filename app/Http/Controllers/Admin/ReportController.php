<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    public function showMonthlySales(Request $request) {
       // Date range filter
    $startDate = $request->input('start_date') ?? now()->startOfYear();
    $endDate = $request->input('end_date') ?? now()->endOfYear();

    // Current year revenue by month
    $revenue = DB::table('orders')
        ->select(DB::raw("MONTH(created_at) as month_number"), DB::raw("SUM(net_total) as total"), DB::raw("COUNT(*) as orders_count"))
        ->where('order_status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('month_number')
        ->orderBy('month_number')
        ->get();

    // Last year revenue for comparison
    $lastYear = now()->subYear();
    $revenueLastYear = DB::table('orders')
        ->select(DB::raw("MONTH(created_at) as month_number"), DB::raw("SUM(net_total) as total"))
        ->where('order_status', 'completed')
        ->whereYear('created_at', $lastYear->year)
        ->groupBy('month_number')
        ->orderBy('month_number')
        ->pluck('total', 'month_number');

    // Prepare full 12 months data for current and last year
    $months = array_fill(1, 12, ['total' => 0, 'orders_count' => 0]);
    foreach ($revenue as $row) {
        $months[$row->month_number] = ['total' => $row->total, 'orders_count' => $row->orders_count];
    }

    $monthsLastYear = array_fill(1, 12, 0);
    foreach ($revenueLastYear as $monthNumber => $total) {
        $monthsLastYear[$monthNumber] = $total;
    }


    // $orderTotals = DB::table('order_items')
    // ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
    // ->join('products', 'stocks.product_id', '=', 'products.id')
    // ->select(
    //     'products.id as product_id',
    //     'products.product_name',
    //     DB::raw('SUM(order_items.quantity) as total_sold'),
    //     DB::raw('SUM(order_items.total_price) as total_revenue')
    // )
    // ->groupBy('products.id', 'products.product_name');



    // $bestSelling = DB::table(DB::raw("({$orderTotals->toSql()}) as totals"))
    // ->mergeBindings($orderTotals) // keep bindings
    // ->leftJoin('product_images', 'totals.product_id', '=', 'product_images.product_id')
    // ->select(
    //     'totals.product_name',
    //     DB::raw('MIN(product_images.preview) as preview'), // pick one image
    //     'totals.total_sold',
    //     'totals.total_revenue'
    // )
    // ->groupBy('totals.product_id', 'totals.product_name', 'totals.total_sold', 'totals.total_revenue')
    // ->orderByDesc('totals.total_sold')
    // ->take(5)
    // ->get();

    $firstImages = DB::table('product_images as pi')
    ->select('pi.product_id', 'pi.preview')
    ->whereRaw('pi.id = (SELECT id FROM product_images WHERE product_id = pi.product_id ORDER BY id ASC LIMIT 1)');

    $bestSelling = DB::table('order_items')
    ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
    ->join('products', 'stocks.product_id', '=', 'products.id')
    ->leftJoinSub($firstImages, 'fi', function($join) {
        $join->on('products.id', '=', 'fi.product_id');
    })
    ->select(
        'products.product_name',
        'fi.preview',
        DB::raw('SUM(order_items.quantity) as total_sold'),
        DB::raw('SUM(order_items.total_price) as total_revenue')
    )
    ->groupBy('products.id', 'products.product_name', 'fi.preview')
    ->orderByDesc('total_sold')
    ->take(5)
    ->get();


    // Convert to month short names
    $monthLabels = [];
    foreach ($months as $num => $value) {
        $monthLabels[] = date("M", mktime(0, 0, 0, $num, 10));
    }


    return view('admin.report.sale.index', [
        'monthlySalesLabels' => $monthLabels,
        'monthlySalesData' => collect($months)->pluck('total')->values(),
        'monthlyOrdersData' => collect($months)->pluck('orders_count')->values(),
        'monthlyLastYearData' => array_values($monthsLastYear),
        'bestSellingProducts' => $bestSelling,
        'startDate' => $startDate,
        'endDate' => $endDate,
    ]);
    }

    public function showMonthlyOrders() {

        // monthly order count
        $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_orders')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Convert month numbers to month names (optional)
        $months = [];
        $orders = [];
        foreach ($monthlyOrders as $order) {
            $months[] = date("F", mktime(0, 0, 0, $order->month, 10)); // e.g. January
            $orders[] = $order->total_orders;
        }

        // order status summary
        $orderStatus = DB::table('orders')
    ->select('order_status', DB::raw('COUNT(*) as total'))
    ->groupBy('order_status')
    ->orderByDesc('order_status')
    ->pluck('total', 'order_status');


    // order status array
    $arrangeOrder = ['pending', 'confirmed', 'delivered', 'completed', 'cancelled'];

    //  Reorder based on desired order
    $orderedStatus = collect($arrangeOrder)->mapWithKeys(function ($status) use ($orderStatus) {
            return [$status => $orderStatus[$status] ?? 0]; // set to 0 if not exists in DB
    });
        return view('admin.report.order.index',
        [
            'months' => $months,'orders' => $orders, 'orderStatusLabels' => $orderedStatus->keys(),
            'orderStatusData' => $orderedStatus->values()
        ]);
    }

    public function reportCustomers() {
        $topCustomers = Order::select(
            'customer_id',
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total_amount) as total_spent')
        )
        ->groupBy('customer_id')
        ->orderByDesc('total_spent')
        ->with('customer') // eager load customer relationship
        ->limit(10)
        ->get();

        $customerOrders = Order::select(
            'customer_id',
            DB::raw('COUNT(*) as order_count')
        )
        ->groupBy('customer_id')
        ->get();

        // Count new and repeat customers
        $newCustomers = $customerOrders->where('order_count', 1)->count();
        $repeatCustomers = $customerOrders->where('order_count', '>', 1)->count();



        return view('admin.report.customer.index',
        [
            'topCustomers' => $topCustomers,
            'newCustomers' => $newCustomers,
            'repeatCustomers' => $repeatCustomers
        ]);
    }

    public function compareRepeatAndNewCustomer() {
        $customerOrders = Order::select(
            'customer_id',
            DB::raw('COUNT(*) as order_count')
        )
        ->groupBy('customer_id')
        ->get();

        // Count new and repeat customers
        $newCustomers = $customerOrders->where('order_count', 1)->count();
        $repeatCustomers = $customerOrders->where('order_count', '>', 1)->count();
        return view('admin.report.customer.index',['newcustomers' => $newCustomers,'repeatCustomers' => $repeatCustomers]);
    }
}
