<?php

namespace Database\Seeders;

use App\Models\Fit;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\Size;
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
        $productTypeData = [
            [
                'name' => 'T-Shirt',
                'category' => 'Clothing',
                'fits' => ['Slim Fit', 'Regular Fit', 'Stretch Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Sweater',
                'category' => 'Clothing',
                'fits' => ['Regular Fit', 'Wide Fit'],
                'sizes' => ['XS', 'M', 'L']
            ],
            [
                'name' => 'Skirt',
                'category' => 'Clothing',
                'fits' => ['Mini-Skirt Fit', 'Short-Skirt Fit', 'Long-Skirt Fit', 'Regular Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Tops',
                'category' => 'Clothing',
                'fits' => ['Stretch Fit', 'Rib Fit'],
                'sizes' => ['XS', 'XXS', 'M', 'L', 'XL']
            ],
            [
                'name' => 'Trousers',
                'category' => 'Clothing',
                'fits' => ['Regular Fit', 'Wide-leg Fit'],
                'sizes' => ['24', '25', '26', '27', '28', '29', '30', '31', '32']
            ],
            [
                'name' => 'Hat',
                'category' => 'Accessories',
                'fits' => [],
                'sizes' => ['free size']
            ],
            [
                'name' => 'Cap',
                'category' => 'Accessories',
                'fits' => [],

                'sizes' => ['free size']
            ],
            [
                'name' => 'Scraf',
                'category' => 'Accessories',
                'fits' => [],

                'sizes' => ['one size']
            ],
            [
                'name' => 'Sunglasses',
                'category' => 'Accessories',
                'fits' => [],

                'sizes' => ['one size']
            ],
            [
                'name' => 'Sunglasses',
                'category' => 'Accessories',
                'fits' => [],

                'sizes' => ['one size']
            ],
            [
                'name' => 'Hoodie',
                'category' => 'Outerwear',
                'fits' => ['Regular Fit','Slim Fit'],
                'sizes' => ['XS','S','M','L','XL']
            ],
            [
                'name' => 'Blazor',
                'category' => 'Outerwear',
                'fits' => ['Relaxed Fit','Regular Fit','Volume Fit'],
                'sizes' => ['XXS','XS','S','M','L','XL']

            ],
            [
                'name' => 'Jacket',
                'category' => 'Outerwear',
                'fits' => [],

                'sizes' => ['XS','S','M','L','XL','XXL']

            ],

        ];

        foreach ($productTypeData as $data) {
            // Find category
            $category = ProductCategory::where('category_name', $data['category'])->first();

            // Create product type
            $productType = ProductType::create([
                'name' => $data['name'],
                'product_category_id' => $category->id,
                'user_id' => 1
            ]);

            // Attach fits
            $fitIds = Fit::whereIn('fit_name', $data['fits'])->pluck('id');
            $productType->fits()->attach($fitIds);

            // Attach sizes
            $sizeIds = Size::whereIn('size_name', $data['sizes'])->pluck('id');
            $productType->sizes()->attach($sizeIds);
        }
    }
    }

