<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->input('filter', 'this_month'); // default last month

        // Set date ranges based on filter
        // switch ($filter) {
        //     case 'today':
        //         $start = Carbon::today();
        //         $end = Carbon::today()->endOfDay();

        //         break;

        //     case 'yesterday':
        //         $start = Carbon::yesterday()->startOfDay();
        //         $end = Carbon::yesterday()->endOfDay();

        //         break;

        //     case 'last_7_days':
        //         $start = Carbon::now()->subDays(7)->startOfDay();
        //         $end = Carbon::now()->endOfDay();
        //         break;

        //     case 'this_month':
        //         $start = Carbon::now()->startOfMonth();
        //         $end = Carbon::now()->endOfMonth();
        //         break;

        //     case 'last_month':
        //         $start = Carbon::now()->subMonth()->startOfMonth();
        //         $end = Carbon::now()->subMonth()->endOfMonth();
        //         break;

        //     case 'this_year':
        //         $start = Carbon::now()->startOfYear();
        //         $end = Carbon::now()->endOfYear();
        //         break;

        //     case 'last_year':
        //         $start = Carbon::now()->subYear()->startOfYear();
        //         $end = Carbon::now()->subYear()->endOfYear();
        //         break;

        //     default:
        //         $start = Carbon::now()->subMonth()->startOfMonth();
        //         $end = Carbon::now()->subMonth()->endOfMonth();
        //         break;
        // }


        switch ($filter) {


            case 'last_7_days':
                $start = Carbon::now()->subDays(7)->startOfDay();
                $end = Carbon::now()->endOfDay();
                break;

            case 'this_month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;

            case 'last_month':
                $start = Carbon::now()->subMonth()->startOfMonth();
                $end = Carbon::now()->subMonth()->endOfMonth();
                break;

            case 'this_year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;

            case 'last_year':
                $start = Carbon::now()->subYear()->startOfYear();
                $end = Carbon::now()->subYear()->endOfYear();
                break;

                default:
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
        }


        // Comparison period (previous period)

        $periodDays = $start->diffInDays($end) + 1;
        $previousStart = $start->copy()->subDays($periodDays);
        $previousEnd = $start->copy()->subDay();

        // Sales
        $totalSale = Order::where('order_status', 'completed')
        ->whereBetween('created_at', [$start, $end])
        ->sum('net_total');

        // $totalRevenue = Order::where('order_status', 'completed')
        // ->whereNotNull('payment_received_at')
        // ->whereBetween('payment_received_at', [$start, $end])
        // ->sum('net_total');

        // Revenue = only orders already paid
        $totalRevenue = Order::where('order_status', 'completed')
    ->whereNotNull('payment_received_at')
    ->whereBetween('created_at', [$start, $end])
    ->sum('net_total');




    //outstanding

    $outstanding = Order::where('order_status', 'completed')
    ->whereNull('payment_received_at')
    ->whereBetween('created_at', [$start, $end])
    ->sum('net_total');


        $totalOrder = Order::whereBetween('created_at',[$start,$end])->count();
        $totalProduct = Product::count();
        // $totalCustomer = Customer::whereBetween('created_at',[$start,$end])->count();
        $totalCustomer = Customer::whereHas('orders', function ($query) use ($start, $end) {
            $query->whereBetween('created_at', [$start, $end]);
        })->count();

        // revenue in selected period vs previous period
        $periodRevenue = Order::
        whereNotNull('payment_received_at')
        ->whereBetween('payment_received_at', [$start, $end])
        ->sum('net_total');


        $previousRevenue = Order::
        whereNotNull('payment_received_at')
        ->whereBetween('payment_received_at', [$previousStart, $previousEnd])
        ->sum('net_total');

          // sale in selected period vs previous period
          $periodSale = Order::where('order_status','completed')->whereBetween('created_at', [$start, $end])->sum('net_total');

          $previousSale = Order::where('order_status','completed')->whereBetween('created_at', [$previousStart, $previousEnd])->sum('net_total');

        // Orders
        $periodOrders = Order::whereBetween('created_at', [$start, $end])->count();
        $previousOrders = Order::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        // Customers
        // $periodCustomers = Customer::whereBetween('created_at', [$start, $end])->count();
        // $previousCustomers = Customer::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $periodCustomers = Customer::whereHas('orders', function ($query) use ($start, $end) {
            $query->whereBetween('created_at', [$start, $end]);
        })->count();

        $previousCustomers = Customer::whereHas('orders', function ($query) use ($previousStart, $previousEnd) {
            $query->whereBetween('created_at', [$previousStart, $previousEnd]);
        })->count();

        // Calculate % changes safely

        $revenueChange = ($previousRevenue != 0) ? (($periodRevenue - $previousRevenue) / $previousRevenue) * 100 : null;

        $saleChange = ($previousSale != 0) ? (($periodSale - $previousSale) / $previousSale) * 100 : null;
        $orderChange = ($previousOrders != 0) ? (($periodOrders - $previousOrders) / $previousOrders) * 100 : null;
        $customerChange = ($previousCustomers != 0) ? (($periodCustomers - $previousCustomers) / $previousCustomers) * 100 : null;


        $sparklineSale = [100, 200, 150, 250, 300, 280, 350];
        $sparklineRevenue = [100, 200, 150, 250, 300, 280, 350];
        $sparklineOrders = [10, 15, 12, 18, 20, 19, 25];
        $sparklineCustomers = [5, 6, 5, 7, 8, 7, 9];

        $latestOrders = Order::whereBetween('created_at', [$start, $end])
        ->orderByDesc('created_at')
        ->limit(5)
        ->get();




        // low stock product

        $lowStockProducts = Product::with(['stocks' => function($query) {
            $query->where('stock_quantity', '<=', 3)
                  ->orderBy('size_id');
        }])
        ->whereHas('stocks', function($query) {
            $query->where('stock_quantity', '<=', 3);
        })
        ->orderBy('id')
        ->get();

        // $topCategories = OrderItem::select(
        //     'product_categories.category_name',
        //     DB::raw('SUM(order_items.quantity * order_items.sale_price) as total_sales')
        // )
        // ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
        // ->join('products', 'stocks.product_id', '=', 'products.id')
        // ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
        // ->join('orders', 'order_items.order_id', '=', 'orders.id') // to access created_at
        // ->whereBetween('orders.created_at', [$start, $end]) // filter by selected date range
        // ->where('orders.order_status', 'completed') // only completed orders
        // ->groupBy('product_categories.id', 'product_categories.category_name')
        // ->orderByDesc('total_sales')
        // ->limit(5)
        // ->get();

    // 8. Prepare data for charts
    // $categoryNames = $topCategories->pluck('category_name')->toArray();
    // $categorySales = $topCategories->pluck('total_sales')->toArray();



     $topProductType = OrderItem::select(
            'product_types.name',
            DB::raw('SUM(order_items.total_price) as total_sales')
        )
        ->join('stocks', 'order_items.stock_id', '=', 'stocks.id')
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id') // to access created_at
        ->whereBetween('orders.created_at', [$start, $end]) // filter by selected date range
        ->where('orders.order_status', 'completed') // only completed orders
        ->groupBy('product_types.id', 'product_types.name')
        ->orderByDesc('total_sales')
        ->limit(5)
        ->get();

        $productTypeNames = $topProductType->pluck('name')->toArray();
        $productTypeSales = $topProductType->pluck('total_sales')->toArray();

        // return $totalSale;

    // return $results;
        return view('admin.dashboard.index', [
            'totalRevenue' => $totalRevenue,
            'totalSale' => $totalSale,
            'outstanding' => $outstanding,
            'totalOrder' => $totalOrder,
            'totalProduct' => $totalProduct,
            'totalCustomer' => $totalCustomer,
            'saleChange' => $saleChange,
            'revenueChange' => $revenueChange,
            'orderChange' => $orderChange,
            'customerChange' => $customerChange,
            'sparklineSale' => $sparklineSale,
            'sparklineRevenue' => $sparklineRevenue,

            'sparklineOrders' => $sparklineOrders,
            'sparklineCustomers' => $sparklineCustomers,
            'filter' => $filter,
             'customerChange' => $customerChange,

             'orders' => $latestOrders,

             'lowStockProducts' => $lowStockProducts,

             'productTypeNames' => $productTypeNames,
             'productTypeSales' => $productTypeSales,
            //  'categoryNames' => $categoryNames,
            //  'categorySales' => $categorySales
        ]);
    }



}
