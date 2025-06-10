<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $relatedFits = [
            "T-Shirts" => ['Slim Fit', 'Regular Fit', 'Oversized Fit'],
            "Jeans" => ['Slim Fit', 'Relaxed Fit', 'Straight Fit'],
            "Dresses" => ['Bodycon Fit', 'A-Line Fit', 'Wrap Fit'],
            "Shirts" => ['Slim Fit', 'Regular Fit', 'Tailored Fit'],
            "Jackets" => ['Boxy Fit', 'Oversized Fit', 'Regular Fit'],
            "Hoodies" => ['Relaxed Fit', 'Oversized Fit'],
        ];

        $now = Carbon::now();

        foreach ($productTypes as $categoryName => $types) {
            $category = ProductCategory::where('category_name', $categoryName)->first();

            if ($category) {
                foreach ($types as $typeName) {
                    $productType = ProductType::create([
                        'name' => $typeName,
                        'product_category_id' => $category->id,
                        'user_id' => 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    // Attach related fits if defined
                    if (isset($relatedFits[$typeName])) {
                        $fitIds = DB::table('fits')
                            ->whereIn('fit_name', $relatedFits[$typeName])
                            ->pluck('id');

                        foreach ($fitIds as $fitId) {
                            DB::table('fit_product_type')->updateOrInsert([
                                'fit_id' => $fitId,
                                'product_type_id' => $productType->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
