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
                'fits' => ['Slim Fit', 'Regular Fit', 'Stretch Fit','Classic Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL','XXL']
            ],
            [
                'name' => 'Shirt',
                'category' => 'Clothing',
                'fits' => ['Classic Fit', 'All Fit', 'Stretch Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL','XXL']
            ],
            [
                'name' => 'Sweater',
                'category' => 'Clothing',
                'fits' => ['Regular Fit', 'Wide Fit','Big Fit'],
                'sizes' => ['XS', 'S','M', 'L','XL','XXL']
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
                'name' => 'Polo Shirt',
                'category' => 'Clothing',
                'fits' => ['All Fit', 'Classic Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL','XXL']


            ],
            [
                'name' => 'Shorts',
                'category' => 'Clothing',
                'fits' => ['Relaxed Fit', 'Classic Fit'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL','XXL','28','29','30','31','32','33','34','35','36','38','40','42','44','46']


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
                'name' => 'Hoodie',
                'category' => 'Outerwear',
                'fits' => ['Regular Fit','Volume Fit','Relaxed Fit'],
                'sizes' => ['XS','S','M','L','XL']
            ],
            [
                'name' => 'Blazer',
                'category' => 'Outerwear',
                'fits' => ['Regular Fit','Slim Fit'],
                'sizes' => ['XXS','XS','S','M','L','XL']

            ],


            // footwear
            [
                'name' => 'Loafers',
                'category' => 'Footwear',
                'fits' => [],
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13'],
            ],
            [
                'name' => 'Shoes',
                'category' => 'Footwear',
                'fits' => [],
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13', '14', '15'],
            ],

            [
                'name' => 'Slides & Sandals',
                'category' => 'Footwear',
                'fits' => [],
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13'],
            ],
            [
                'name' => 'Sneakers',
                'category' => 'Footwear',
                'fits' => [],
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '13', '14', '15', '16', '17'],
            ],
            [
                'name' => 'Blazer',
                'category' => 'Outerwear',
                'fits' => ['Regular Fit'],
                'sizes' => ['32', '34', '36', '38', '40', '42', '44', '46', '48', '50', '52', '54'],
            ],
            [
                'name' => 'Jacket',
                'category' => 'Outerwear',
                'fits' => [],
                'sizes' => ['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL'],
            ],

            [
                'name' => 'Bag',
                'category' => 'Accessories',
                'fits' => [],
                'sizes' => ['One Size'],
            ],
            [
                'name' => 'Belts',
                'category' => 'Accessories',
                'fits' => [],
                'sizes' => ['S', 'M', 'L', 'XL', '32', '34', '36', '38', '40', '42'],
            ],
           
            [
                'name' => 'Wallets',
                'category' => 'Accessories',
                'fits' => [],
                'sizes' => ['One Size'],
            ],
            [
                'name' => 'Socks',
                'category' => 'Accessories',
                'fits' => [],
                'sizes' => ['One Size'],
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

