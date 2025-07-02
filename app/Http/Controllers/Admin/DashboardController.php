<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $totalRevenue = Order::where('order_status', 'completed')->sum('net_total');
        $totalOrder = Order::count();
        $totalProduct = Product::count();
        $totalCustomer = Customer::count();

        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $monthlyData = Order::where('order_status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as order_count, SUM(net_total) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = collect();
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $months->push($current->format('Y-m'));
            $current->addMonth();
        }

        $finalData = $months->map(function ($month) use ($monthlyData) {
            $data = $monthlyData->firstWhere('month', $month);

            return [
                'month' => $month,
                'order_count' => $data ? $data->order_count : 0,
                'total_revenue' => $data ? $data->total_revenue : 0,
            ];
        });

        return view('admin.dashboard.index', [
            'totalRevenue' => $totalRevenue,
            'totalOrder' => $totalOrder,
            'totalProduct' => $totalProduct,
            'totalCustomer' => $totalCustomer,
            'monthlyData' => $finalData,
        ]);
    }
}
