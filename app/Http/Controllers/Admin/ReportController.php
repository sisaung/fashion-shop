<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
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



    // filter
    $timeFilter = $request->input('time_filter', 'this_year');



        switch ($timeFilter) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday()->startOfDay();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'last_7_days':
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'this_year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'last_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                break;
            default:
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
        }


    // Current year sale by month
    $sale = DB::table('orders')
        ->select(DB::raw("MONTH(created_at) as month_number"), DB::raw("SUM(net_total) as total"), DB::raw("COUNT(*) as orders_count"))
        ->where('order_status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('month_number')
        ->orderBy('month_number')
        ->get();

    // Last year sale for comparison
    $lastYear = now()->subYear();
    $saleLastYear = DB::table('orders')
        ->select(DB::raw("MONTH(created_at) as month_number"), DB::raw("SUM(net_total) as total"))
        ->where('order_status', 'completed')
        ->whereYear('created_at', $lastYear->year)
        ->groupBy('month_number')
        ->orderBy('month_number')
        ->pluck('total', 'month_number');



    // Prepare full 12 months data for current and last year
    $months = array_fill(1, 12, ['total' => 0, 'orders_count' => 0]);
    foreach ($sale as $row) {
        $months[$row->month_number] = ['total' => $row->total, 'orders_count' => $row->orders_count];
    }



    $monthsLastYear = array_fill(1, 12, 0);
    foreach ($saleLastYear as $monthNumber => $total) {
        $monthsLastYear[$monthNumber] = $total;
    }


    $firstImages = DB::table('product_images as pi')
    ->select('pi.product_id', 'pi.preview')
    ->whereRaw('pi.id = (SELECT id FROM product_images WHERE product_id = pi.product_id ORDER BY id ASC LIMIT 1)');

$bestSelling = DB::table('order_items')
    ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
    ->join('products', 'stocks.product_id', '=', 'products.id')
    ->join('orders', 'order_items.order_id', '=', 'orders.id') // join orders to filter by time
    ->leftJoinSub($firstImages, 'fi', function($join) {
        $join->on('products.id', '=', 'fi.product_id');
    })
    ->select(
        'products.product_name',
        'fi.preview',
        DB::raw('SUM(order_items.quantity) as total_sold'),
        DB::raw('SUM(order_items.total_price) as total_sale')
    )
    ->where('orders.order_status', 'completed') // only completed orders
    ->whereBetween('orders.created_at', [$startDate, $endDate]) // time filter applied here
    ->groupBy('products.id', 'products.product_name', 'fi.preview')
    ->orderByDesc('total_sold')
    ->take(5)
    ->get();


    // Convert to month short names
    $monthLabels = [];
    foreach ($months as $num => $value) {
        $monthLabels[] = date("M", mktime(0, 0, 0, $num, 10));
    }

    $salesData = array_column($months, 'total_sales');
    $ordersData = array_column($months, 'orders_count');
    $salesLastYearData = array_values($monthsLastYear);


    return view('admin.report.sale.index', [
        'monthlySalesLabels' => $monthLabels,
        'monthlySalesData' => collect($months)->pluck('total')->values(),
        'monthlyOrdersData' => collect($months)->pluck('orders_count')->values(),
        'monthlyLastYearData' => array_values($monthsLastYear),
        // 'salesData' => $salesData,
        // 'ordersData' => $ordersData,
        // 'salesLastYearData' => $salesLastYearData,
        // 'monthlySalesData' => $salesData,
        // 'monthlyOrdersData' => $ordersData,
        // 'monthlyLastYearData' => $salesLastYearData,
        'bestSellingProducts' => $bestSelling,
        // 'startDate' => $startDate,
        // 'endDate' => $endDate,

    ]);
    }

    public function showMonthlyOrders(Request $request) {

        $timeFilter = $request->input('time_filter', 'this_year');
        $customStart = $request->input('start_date');
        $customEnd = $request->input('end_date');

        if($customStart && $customEnd) {

            $startDate = Carbon::parse($customStart)->startOfDay();
            $endDate = Carbon::parse($customEnd)->endOfDay();
            $groupBy = 'DATE(created_at)'; // Custom date range grouped by day
        }else {
            switch ($timeFilter) {
                case 'today':
                    $startDate = Carbon::today()->startOfDay();
                    $endDate = Carbon::today()->endOfDay();
                    $groupBy = 'HOUR(created_at)';
                    break;

                case 'yesterday':
                    $startDate = Carbon::yesterday()->startOfDay();
                    $endDate = Carbon::yesterday()->endOfDay();
                    $groupBy = 'HOUR(created_at)';
                    break;

                case 'last_7_days':
                    $startDate = Carbon::now()->subDays(7)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $groupBy = 'DATE(created_at)';
                    break;

                case 'this_month':
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                    $groupBy = 'DATE(created_at)';
                    break;

                case 'last_month':
                    $startDate = Carbon::now()->subMonth()->startOfMonth();
                    $endDate = Carbon::now()->subMonth()->endOfMonth();
                    $groupBy = 'DATE(created_at)';
                    break;

                case 'this_year':
                    $startDate = Carbon::now()->startOfYear();
                    $endDate = Carbon::now()->endOfYear();
                    $groupBy = 'MONTH(created_at)';
                    break;

                case 'last_year':
                    $startDate = Carbon::now()->subYear()->startOfYear();
                    $endDate = Carbon::now()->subYear()->endOfYear();
                    $groupBy = 'MONTH(created_at)';
                    break;

                default:
                    $startDate = Carbon::now()->startOfYear();
                    $endDate = Carbon::now()->endOfYear();
                    $groupBy = 'MONTH(created_at)';
                    break;
            }
        }


    // Get combined chart data
    $chartData = Order::select(
        DB::raw($groupBy . ' as period'),
        DB::raw('COUNT(*) as total_orders'),
        DB::raw('SUM(net_total) as total_sale')
    )
    ->where('order_status', 'completed')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->groupBy(DB::raw($groupBy))
    ->orderBy(DB::raw($groupBy))
    ->get();

    // Prepare arrays for chart

    $labels = [];
    $orderCounts = [];
    $sales = [];

    foreach ($chartData as $order) {
        if ($timeFilter == 'today' || $timeFilter == 'yesterday') {
            $labels[] = $order->period . ":00";
        } elseif (in_array($timeFilter, ['last_7_days', 'this_month', 'last_month'])) {
            $labels[] = $order->period;
        } else {
            $labels[] = date("F", mktime(0, 0, 0, $order->period, 10));
        }

        $orderCounts[] = $order->total_orders;
        $sales[] = $order->total_sale;
    }

        // Convert month numbers to month names (optional)
        // $months = [];
        // $orders = [];
        // foreach ($monthlyOrders as $order) {
        //     $months[] = date("F", mktime(0, 0, 0, $order->month, 10)); // e.g. January
        //     $orders[] = $order->total_orders;
        // }

       // Get counts grouped by order_status
    $orderStatus = DB::table('orders')
    ->select('order_status', DB::raw('COUNT(*) as total'))
    ->groupBy('order_status')
    ->pluck('total', 'order_status'); // returns key=>value array

    // Desired order status sequence
    $arrangeOrder = ['pending', 'confirmed', 'delivered', 'completed', 'cancelled'];

    // Reorder with default 0 if not exists
    $orderedStatus = collect($arrangeOrder)->mapWithKeys(function ($status) use ($orderStatus) {
        return [$status => $orderStatus[$status] ?? 0];
    });
        return view('admin.report.order.index',
        [
            // 'months' => $months,'orders' => $orders, 'orderStatusLabels' => $orderedStatus->keys(),
            // 'orderStatusData' => $orderedStatus->values()
            'labels' => $labels,
            'orderCounts' => $orderCounts,
            'sales' => $sales,
            'timeFilter' => $timeFilter,
            'orderedStatus' => $orderedStatus,
            'customStart' => $customStart,
            'customEnd' => $customEnd
        ]);
    }


    // time filter
   public function timeFilter ($filter,$query)  {
        $now = Carbon::now();

        if ($filter === 'today') {
            $query->whereDate('created_at', $now->toDateString());
        } elseif ($filter === 'last_7_days') {
            $query->whereBetween('created_at', [$now->copy()->subDays(7), $now]);
        } elseif ($filter === 'this_month') {
            $query->whereYear('created_at', $now->year)
                  ->whereMonth('created_at', $now->month);
        } elseif ($filter === 'last_month') {
            $lastMonth = $now->copy()->subMonth();
            $query->whereYear('created_at', $lastMonth->year)
                  ->whereMonth('created_at', $lastMonth->month);
        } elseif ($filter === 'this_year') {
            $query->whereYear('created_at', $now->year);
        } elseif ($filter === 'last_year') {
            $lastYear = $now->year - 1;
            $query->whereYear('created_at', $lastYear);
        }

        return $query;
    }

    // public function reportCustomers(Request $request) {
    //     $filter = $request->input('filter', 'this_month');

    //     // Top customers query
    //     $topCustomersQuery = Order::select(
    //         'customer_id',
    //         DB::raw('COUNT(*) as total_orders'),
    //         DB::raw('SUM(total_amount) as total_spent')
    //     )
    //     ->groupBy('customer_id')
    //     ->orderByDesc('total_spent');

    //     // Apply time filter (your custom method)
    //     $topCustomersQuery = $this->timeFilter($filter, $topCustomersQuery);

    //     // Get top 5 customers
    //     $topCustomers = $topCustomersQuery->limit(5)->get();

    //     // Eager load customer data for top customers (best way)
    //     $topCustomers->load('customer');

    //     // Count new and repeat customers
    //     $customerOrdersQuery = Order::select(
    //         'customer_id',
    //         DB::raw('COUNT(*) as order_count')
    //     )
    //     ->groupBy('customer_id');

    //     $customerOrdersQuery = $this->timeFilter($filter, $customerOrdersQuery);
    //     $customerOrders = $customerOrdersQuery->get();

    //     $newCustomers = $customerOrders->where('order_count', 1)->count();
    //     $repeatCustomers = $customerOrders->where('order_count', '>', 1)->count();

    //     return view('admin.report.customer.index', [
    //         'topCustomers' => $topCustomers,
    //         'newCustomers' => $newCustomers,
    //         'repeatCustomers' => $repeatCustomers,
    //         'filter' => $filter
    //     ]);
    // }

    public function reportCustomers(Request $request) {
        $filter = $request->input('filter', 'this_month');

        // Top customers query
        $topCustomersQuery = Order::select(
            'customer_id',
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total_amount) as total_spent')
        )
        ->where('order_status','!=','cancelled')
        ->groupBy('customer_id')
        ->orderByDesc('total_spent');

        // Apply time filter (your custom method)
        $topCustomersQuery = $this->timeFilter($filter, $topCustomersQuery);

        // Get top 5 customers
        $topCustomers = $topCustomersQuery->limit(5)->get();

        // Eager load customer data for top customers (best way)
        $topCustomers->load('customer');

        // Count new and repeat customers
        $customerOrdersQuery = Order::select(
            'customer_id',
            DB::raw('COUNT(*) as order_count')
        )
        ->groupBy('customer_id');

        $customerOrdersQuery = $this->timeFilter($filter, $customerOrdersQuery);
        $customerOrders = $customerOrdersQuery->get();

        $newCustomers = $customerOrders->where('order_count', 1)->count();
        $repeatCustomers = $customerOrders->where('order_count', '>', 1)->count();

        return view('admin.report.customer.index', [
            'topCustomers' => $topCustomers,
            'newCustomers' => $newCustomers,
            'repeatCustomers' => $repeatCustomers,
            'filter' => $filter
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
