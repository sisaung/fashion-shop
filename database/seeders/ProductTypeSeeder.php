<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        

        $productTypes = [
            "Clothing" => [
                "T-Shirts",
                "Jeans",
                "Dresses",
                "Shirts"
            ],
            "Footwear" => [
                "Sneakers",
                "Boots",
                "Sandals",
                "Formal Shoes"
            ],
            "Accessories" => [
                "Watches",
                "Belts",
                "Jewelry",
                "Hats"
            ],
            "Outerwear" => [
                "Jackets",
                "Coats",
                "Hoodies",
                "Raincoats"
            ],
            "Bags" => [
                "Backpacks",
                "Handbags",
                "Messenger Bags",
                "Suitcases"
            ],
        ];

        $now = Carbon::now();

        foreach ($productTypes as $categoryName => $types) {
            $category = ProductCategory::where('category_name', $categoryName)->first();

            if ($category) {
                foreach ($types as $typeName) {
                    ProductType::create([
                        'name' => $typeName,
                        'product_category_id' => $category->id,
                        'user_id' => 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
