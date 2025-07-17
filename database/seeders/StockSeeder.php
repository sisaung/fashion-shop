<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Get all products with their sizes through productType relationship
        $products = Product::with('productType.sizes')->get();

        foreach ($products as $product) {
            $totalQuantity = 0; // to calculate total stock quantity for this product

            // Loop through each size of the product
            foreach ($product->productType->sizes as $size) {
                $sku = $product->product_code . '-' . $size->size_name;
                $quantity = rand(4,7);

                // Create stock for this size
                Stock::create([
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                    'sku' => $sku,
                    'stock_quantity' => $quantity,
                ]);

                $totalQuantity += $quantity;
            }

            // Update product's stock_count after creating all sizes' stock
            $product->stock_count = $totalQuantity;
            $product->save();
        }
    }
}
