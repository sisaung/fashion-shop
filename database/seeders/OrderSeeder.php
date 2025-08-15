<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Stock;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $customers = Customer::all();

    //     $months_2024 = range(1, 12);
    //     $months_2025 = range(1, 7);

    //     foreach ($customers as $customer) {
    //         // Get customer address
    //         $customerAddress = CustomerAddress::where('customer_id', $customer->id)->first();

    //         // Create orders for each month in 2024
    //         foreach ($months_2024 as $month) {
    //             $this->createOrder($customer, $customerAddress, 2024, $month);
    //         }

    //         // Create orders for each month in 2025 (Jan to July)
    //         foreach ($months_2025 as $month) {
    //             $this->createOrder($customer, $customerAddress, 2025, $month);
    //         }
    //     }
    // }

    /**
     * Helper function to create order with order items.
     */
    // private function createOrder($customer, $customerAddress, $year, $month)
    // {
    //     $stocks = Stock::all();
    //     if ($stocks->isEmpty()) {
    //         return;
    //     }

    //     // Create random day in month
    //     $date = Carbon::create($year, $month, rand(1, 28));

    //     // Create order
    //     $order = Order::create([
    //         'order_number' => 'ORD-' . strtoupper(Str::random(8)),
    //         'order_status' => 'completed',
    //         'total_amount' => 0,
    //         'order_date' => $date->toDateString(),
    //         'delivery_start_date' => $date->copy()->addDays(1)->toDateString(),
    //         'delivery_end_date' => $date->copy()->addDays(3)->toDateString(),
    //         'customer_name' => $customer->customer_name,
    //         'customer_id' => $customer->id,
    //         'customer_address_id' => $customerAddress ? $customerAddress->id : null,
    //         'net_total' => 0,
    //         'created_at' => $date,
    //         'updated_at' => $date,
    //     ]);

    //     $total = 0;

    //     // Random 1-3 items
    //     $items = $stocks->random( min(3, $stocks->count()) );

    //     if ($items instanceof Stock) {
    //         $items = collect([$items]);
    //     }

    //     foreach ($items as $stock) {
    //         $quantity = rand(1, 3);
    //         $sale_price = $stock->sale_price ?? 80000; // default if null
    //         $total_price = $sale_price * $quantity;

    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'stock_id' => $stock->id,
    //             'sale_price' => $sale_price,
    //             'quantity' => $quantity,
    //             'total_price' => $total_price,
    //             'created_at' => $date,
    //             'updated_at' => $date,
    //         ]);

    //         $total += $total_price;
    //     }

    //     // Update order totals
    //     $order->update([
    //         'total_amount' => $total,
    //         'tax_amount' => $total * 0.05, // 5% tax example
    //         'net_total' => $total + ($total * 0.05),
    //         'created_at' => $date,
    //         'updated_at' => $date,
    //     ]);
    // }


    public function run(): void
    {
        $customers = Customer::all();
        $stocks = Stock::all();

        if ($customers->isEmpty() || $stocks->isEmpty()) {
            return;
        }

        $months_last_year = range(1, 12); // 2024 months
        $months_this_year = range(1, 7); // 2025 till July

        foreach ($customers as $customer) {
            $customerAddress = CustomerAddress::where('customer_id', $customer->id)->first();

            // Seed orders for last year
            foreach ($months_last_year as $month) {
                $this->createOrder($customer, $customerAddress, 2024, $month, $stocks);
            }

            // Seed orders for this year
            foreach ($months_this_year as $month) {
                $this->createOrder($customer, $customerAddress, 2025, $month, $stocks);
            }
        }
    }

    private function createOrder($customer, $customerAddress, $year, $month, $stocks)
    {
        $date = Carbon::create($year, $month, rand(1, 28));

        $isOlderThanAWeek = $date->lt(Carbon::now()->subWeek());

        // Set order status and payment
        $order_status = $isOlderThanAWeek ? 'completed' : 'pending';
        $is_paid = $isOlderThanAWeek ? 1 : 0;
        $payment_received_at = $isOlderThanAWeek ? $date->copy()->addWeek() : null;

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'order_status' => $order_status,
            'total_amount' => 0,
            'order_date' => $date->toDateString(),
            'delivery_start_date' => $date->copy()->addDays(1)->toDateString(),
            'delivery_end_date' => $date->copy()->addDays(3)->toDateString(),
            'confirm_message' => null,
            'deliver_message' => null,
            'cancel_message' => null,
            'is_cancel' => 0,
            'tax_amount' => 0,
            'net_total' => 0,
            'customer_name' => $customer->customer_name,
            'customer_id' => $customer->id,
            'customer_address_id' => $customerAddress ? $customerAddress->id : null,
            'coupon_id' => null,
            'is_paid' => $is_paid,
            'payment_received_at' => $payment_received_at,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        $total = 0;

        // Random 1-3 items
        // $items = $stocks->random( min(3, $stocks->count()) );
        // if ($items instanceof Stock) {
        //     $items = collect([$items]);
        // }

         // Ensure only one stock per product
    $uniqueStocks = $stocks
    ->groupBy('product_id') // Group by product
    ->map(function ($group) {
        return $group->random(); // Pick 1 random size for that product
    })
    ->values();

// Randomly pick up to 3 products for this order
$items = $uniqueStocks->random(min(3, $uniqueStocks->count()));

        foreach ($items as $stock) {
            $quantity = rand(1, 3);
            $sale_price = $stock->sale_price ?? 80000;
            $total_price = $sale_price * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'stock_id' => $stock->id,
                'sale_price' => $sale_price,
                'quantity' => $quantity,
                'total_price' => $total_price,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $total += $total_price;
        }

        // Update order totals
        $tax = $total * 0.05;
        $net = $total + $tax;



        $order->update([
            'total_amount' => $total,
            'tax_amount' => $tax,
            'net_total' => $net,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
