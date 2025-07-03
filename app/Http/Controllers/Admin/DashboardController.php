<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $totalRevenue = Order::where('order_status', 'completed')->sum('net_total');
        $totalOrder = Order::count();
        $totalProduct = Product::count();
        $totalCustomer = Customer::count();

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();


        // Get last month start and end
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();


        //Get last 6months

       // Last 6 months start (January start)
        $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();


        // Last month end (June end)
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();


         // Current month revenue count
         $currentMonthRevenue = Order::where('order_status','completed')->whereBetween('created_at',[$currentMonthStart,$currentMonthEnd])->sum('net_total');

         $lastMonthRevenue =  Order::where('order_status','completed')->whereBetween('created_at',[$lastMonthStart,$lastMonthEnd])->sum('net_total');


        // Current month orders count
        $currentMonthOrders = Order::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->count();

        //current month customer count
        $currentMonthCustomers = Customer::whereBetween('created_at',[$currentMonthStart,$currentMonthEnd])->count();

        //last month customer count
        $lastMonthCustomers = Customer::whereBetween('created_at',[$lastMonthStart,$lastMonthEnd])->count();


        // Last month orders count
        $lastMonthOrders = Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        // Calculate percentage change safely
        if ($lastMonthRevenue > 0 ) {

            if($currentMonthRevenue == 0) {

                $revenueChange = null;
            }else{

            $revenueChange = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;

            }

        } else {
            $revenueChange = null; // or set as 100% if no orders last month
        }


        // Calculate percentage change safely
        if ($lastMonthOrders > 0 ) {

            if($currentMonthOrders == 0) {

                $orderChange = null;
            }else{

            $orderChange = (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100;

            }

        } else {
            $orderChange = null; // or set as 100% if no orders last month
        }

        if ($lastMonthCustomers > 0 ) {

            if($currentMonthCustomers == 0) {
                $customerChange = null;
            }
            else {

                $customerChange = (($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100;
            }
        } else {
            $customerChange = null; // or set as 100% if no orders last month
        }



    //    last 6 month orders

    $monthlyOrders = Order::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as total_orders')
    )
    ->whereBetween('created_at', [
        Carbon::now()->subMonths(6)->startOfMonth(), // January start
        Carbon::now()->subMonth()->endOfMonth() // June end
    ])
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy(DB::raw('MONTH(created_at)'))
    ->get();


    $previousTotal = null;
$results = [];

foreach ($monthlyOrders as $order) {
    $monthName = Carbon::create()->month($order->month)->format('F');
    $currentTotal = $order->total_orders;

    if ($previousTotal !== null) {
        if($previousTotal == 0){
            $change = null; // avoid divide by zero
        }else{
            $change = (($currentTotal - $previousTotal) / $previousTotal) * 100;
        }
    } else {
        $change = null; // first month has no previous
    }

    $results[] = [
        'month' => $monthName,
        'total_orders' => $currentTotal,
        'change_percentage' => $change
    ];

    $previousTotal = $currentTotal;

}
// return $results;

$order =  Order::latest()->take(5)->get();



        // $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        // $endDate = Carbon::now()->endOfMonth();

        // $currentMonth = Carbon::now()->format('Y-m');

        // $monthlyData = Order::where('order_status', 'completed')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as order_count, SUM(net_total) as total_revenue')
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();

        // $months = collect();
        // $current = $startDate->copy();

        // while ($current <= $endDate) {
        //     $months->push($current->format('Y-m'));
        //     $current->addMonth();
        // }

        // $finalData = $months->map(function ($month) use ($monthlyData) {
        //     $data = $monthlyData->firstWhere('month', $month);

        //     return [
        //         'month' => $month,
        //         'order_count' => $data ? $data->order_count : 0,
        //         'total_revenue' => $data ? $data->total_revenue : 0,
        //     ];
        // });


    // return $results;
        return view('admin.dashboard.index', [
            'totalRevenue' => $totalRevenue,
            'totalOrder' => $totalOrder,
            'totalProduct' => $totalProduct,
            'totalCustomer' => $totalCustomer,
            'currentMonthOrders' => $currentMonthOrders,
             'orderChange' => $orderChange,
             'customerChange' => $customerChange,
             'revenueChange' => $revenueChange,
             'orders' => $order,
             'monthlyOrders' => $results
            // 'monthlyData' => $finalData,
        ]);
    }

}
