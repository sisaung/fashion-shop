<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $confirmedOrders = Order::where('order_status', 'confirmed')
        ->orWhere('order_status', 'delivered')
        ->orWhere('order_status', 'completed')
        ->get();

        foreach ($confirmedOrders as $order) {
            // Skip if invoice already exists for the order
            if ($order->invoice) {
                continue;
            }

            Invoice::create([
                'order_id' => $order->id,
                'invoice_number' => 'INV-' . Str::padLeft($order->id, 6, '0'),
                'pdf_path' => null, // You can later generate PDF if needed
                'status' => 'generated', // default status
            ]);
        }
    }
}
