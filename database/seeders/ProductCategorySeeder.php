<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productCategories = [
            ["category_name" => "Clothing"],
            ['category_name' => "Denim"],
            ["category_name" => "Footwear"],
            ["category_name" => "Accessories"],
            ["category_name" => "Outerwear"],
            ["category_name" => "Bags"]
        ];

        $now = now();

        $productCategories =  array_map(fn($category) => ["category_name" => $category['category_name'], 'user_id' => 1, 'created_at' => $now, 'updated_at' => $now], $productCategories);


        foreach ($productCategories as $category) {

            DB::table('product_categories')->insert($category);
        }
    }
}
