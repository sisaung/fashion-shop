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
        $products = Product::with('productType.sizes')->get();

        foreach ($products as $product) {
            $sizes = $product->productType->sizes; // get sizes via productType relationship

            foreach ($sizes as $size) {
                $sku = $product->product_code . '-' . $size->size_name;

                Stock::create([
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                    'sku' => $sku,
                    'stock_quantity' => rand(5, 15),
                ]);
            }
        }
    }
}
