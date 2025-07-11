<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Fit;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            // Blazers
            [
                'product_name' => 'JXANA Blazer',
                'category' => 'Outerwear',
                'type' => 'Blazer',
                'brand' => 'JJXX',
                'fit' => 'Regular Fit',
                'original_price' => 80000,
                'sale_price' => 120000, // +40000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXELLIS Blazer',
                'category' => 'Outerwear',
                'type' => 'Blazer',
                'brand' => 'JJXX',
                'fit' => 'Regular Fit',
                'original_price' => 60000,
                'sale_price' => 95000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXMARY Blazer',
                'category' => 'Outerwear',
                'type' => 'Blazer',
                'brand' => 'JJXX',
                'fit' => 'Regular Fit',
                'original_price' => 75000,
                'sale_price' => 110000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXSOFIE Blazer',
                'category' => 'Outerwear',
                'type' => 'Blazer',
                'brand' => 'JJXX',
                'fit' => 'Slim Fit',
                'original_price' => 100000,
                'sale_price' => 140000, // +40000
                'gender' => 'female',
            ],

            // Hoodies
            [
                'product_name' => 'JXABBIE Hoodie',
                'category' => 'Outerwear',
                'type' => 'Hoodie',
                'brand' => 'JJXX',
                'fit' => 'Relaxed Fit',
                'original_price' => 50000,
                'sale_price' => 80000, // +30000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXABBIE Zip Hoodie',
                'category' => 'Outerwear',
                'type' => 'Hoodie',
                'brand' => 'JJXX',
                'fit' => 'Regular Fit',
                'original_price' => 55000,
                'sale_price' => 85000, // +30000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXEMMA Hoodie',
                'category' => 'Outerwear',
                'type' => 'Hoodie',
                'brand' => 'JJXX',
                'fit' => 'Volume Fit',
                'original_price' => 60000,
                'sale_price' => 95000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXPALMA Hoodie',
                'category' => 'Outerwear',
                'type' => 'Hoodie',
                'brand' => 'JJXX',
                'fit' => 'Relaxed Fit',
                'original_price' => 70000,
                'sale_price' => 110000, // +40000
                'gender' => 'female',
            ],

            // Jackets
            [
                'product_name' => 'JXELLA Bomber jacket',
                'category' => 'Outerwear',
                'type' => 'Jacket',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 50000,
                'sale_price' => 80000, // +30000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXESSI Bomber jacket',
                'category' => 'Outerwear',
                'type' => 'Jacket',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 85000,
                'sale_price' => 125000, // +40000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXGAIL Leather look biker jacket',
                'category' => 'Outerwear',
                'type' => 'Jacket',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 90000,
                'sale_price' => 130000, // +40000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXLEILA Bomber jacket',
                'category' => 'Outerwear',
                'type' => 'Jacket',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 100000,
                'sale_price' => 140000, // +40000
                'gender' => 'female',
            ],

            // JJXX  Bag
            [
                'product_name' => 'JJXX JXATHENA Crossover Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 60000,
                'sale_price' => 95000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JJXX JXKENYA Shoulder Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 70000,
                'sale_price' => 110000, // +40000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXATHENA Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 50000,
                'sale_price' => 80000, // +30000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXBEATA Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 80000,
                'sale_price' => 115000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXMESA Crossover Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 55000,
                'sale_price' => 85000, // +30000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXPATTY Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 65000,
                'sale_price' => 100000, // +35000
                'gender' => 'female',
            ],
            [
                'product_name' => 'JXTAMPA Shoulder Bag',
                'category' => 'Accessories',
                'type' => 'Bag',
                'brand' => 'JJXX',
                'fit' => '',
                'original_price' => 50000,
                'sale_price' => 80000, // +30000
                'gender' => 'female',
            ],

             // Accessories - Hats
    [
        'product_name' => 'XLU Bucket hat',
        'category' => 'Accessories',
        'type' => 'Hat',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XMORA Bucket hat',
        'category' => 'Accessories',
        'type' => 'Hat',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 70000,
        'sale_price' => 110000, // +40000
        'gender' => 'unisex',
    ],

    // Accessories - Caps
    [
        'product_name' => 'JXX JXSUZANNE Baseball Cap',
        'category' => 'Accessories',
        'type' => 'Cap',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XBASIC Baseball cap',
        'category' => 'Accessories',
        'type' => 'Cap',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XLU Baseball cap',
        'category' => 'Accessories',
        'type' => 'Cap',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 55000,
        'sale_price' => 85000, // +30000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XMORA Baseball cap',
        'category' => 'Accessories',
        'type' => 'Cap',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'unisex',
    ],

    // Accessories - Scarf
    [
        'product_name' => 'XMORENO Scarf',
        'category' => 'Accessories',
        'type' => 'Scarf',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'unisex',
    ],

    // Sunglasses
    [
        'product_name' => 'JXX JXRACHEL Sunglasses',
        'category' => 'Accessories',
        'type' => 'Sunglasses',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XKENT Sunglasses',
        'category' => 'Accessories',
        'type' => 'Sunglasses',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 55000,
        'sale_price' => 85000, // +30000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XKRISTINA Sunglasses',
        'category' => 'Accessories',
        'type' => 'Sunglasses',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XPHEOBE Sunglasses',
        'category' => 'Accessories',
        'type' => 'Sunglasses',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 70000,
        'sale_price' => 110000, // +40000
        'gender' => 'unisex',
    ],
    [
        'product_name' => 'XROSANNA Sunglasses',
        'category' => 'Accessories',
        'type' => 'Sunglasses',
        'brand' => 'JJXX',
        'fit' => '',
        'original_price' => 80000,
        'sale_price' => 115000, // +35000
        'gender' => 'unisex',
    ],

     // Polo Shirts
     [
        'product_name' => 'Big Pony Mesh Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'All Fits',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Classic Fit Mesh Graphic Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 70000,
        'sale_price' => 110000, // +40000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Classic Fit Polo Bear Mesh Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 55000,
        'sale_price' => 85000, // +30000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Classic Fit Soft Cotton Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 80000,
        'sale_price' => 115000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Polo Ralph Lauren Yankees Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 100000,
        'sale_price' => 135000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Soft Cotton Polo Shirt',
        'category' => 'Clothing',
        'type' => 'Polo Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'All Fits',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'male',
    ],

    // Shirts
    [
        'product_name' => 'Classic Fit Gingham Oxford Shirt',
        'category' => 'Clothing',
        'type' => 'Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Classic Fit Linen Shirt',
        'category' => 'Clothing',
        'type' => 'Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 55000,
        'sale_price' => 85000, // +30000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Classic Fit Striped Linen Shirt',
        'category' => 'Clothing',
        'type' => 'Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 75000,
        'sale_price' => 110000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Featherweight Mesh Shirt',
        'category' => 'Clothing',
        'type' => 'Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'All Fits',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'male',
    ],
    [
        'product_name' => 'The Iconic Oxford Shirt',
        'category' => 'Clothing',
        'type' => 'Shirt',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'male',
    ],

    // Shorts
    [
        'product_name' => '5-inch Stretch Classic Fit Chino Short',
        'category' => 'Clothing',
        'type' => 'Shorts',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 70000,
        'sale_price' => 110000, // +40000
        'gender' => 'male',
    ],
    [
        'product_name' => '7-inch Stretch Classic Seersucker Short',
        'category' => 'Clothing',
        'type' => 'Shorts',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'male',
    ],
    [
        'product_name' => '8.5-inch London Double-Exit Short',
        'category' => 'Clothing',
        'type' => 'Shorts',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 60000,
        'sale_price' => 95000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => '10-inch Classic Fit Ribbon Carpo Short',
        'category' => 'Clothing',
        'type' => 'Shorts',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Classic Fit',
        'original_price' => 80000,
        'sale_price' => 115000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => '12-inch Relaxed Fit Carpenter Short',
        'category' => 'Clothing',
        'type' => 'Shorts',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Relaxed Fit',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'male',
    ],

    // Sweaters
    [
        'product_name' => 'Argyle Cotton-Wool Sweater',
        'category' => 'Clothing',
        'type' => 'Sweater',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 90000,
        'sale_price' => 130000, // +40000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Big Fit Logo Cotton Sweater',
        'category' => 'Clothing',
        'type' => 'Sweater',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => 'Big Fit',
        'original_price' => 70000,
        'sale_price' => 110000, // +40000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Cable-Knit Wool-Cashmere Sweater',
        'category' => 'Clothing',
        'type' => 'Sweater',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 80000,
        'sale_price' => 115000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Polo Bear Sweater',
        'category' => 'Clothing',
        'type' => 'Sweater',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 75000,
        'sale_price' => 110000, // +35000
        'gender' => 'male',
    ],
    [
        'product_name' => 'Textured Cotton-Linen Sweater',
        'category' => 'Clothing',
        'type' => 'Sweater',
        'brand' => 'Ralph Lauren Corporation',
        'fit' => '',
        'original_price' => 50000,
        'sale_price' => 80000, // +30000
        'gender' => 'male',
    ],


       // --------------------------


                // T-Shirts
                [
                    'product_name' => 'Classic Fit Heavyweight Jersey T-Shirt',
                    'category' => 'Clothing',
                    'type' => 'T-Shirt',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => 'Classic Fit',
                    'original_price' => 50000,
                    'sale_price' => 80000, // +30000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Classic Fit Logo Jersey T-Shirt',
                    'category' => 'Clothing',
                    'type' => 'T-Shirt',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => 'Classic Fit',
                    'original_price' => 60000,
                    'sale_price' => 95000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Classic Fit London Jersey T-Shirt',
                    'category' => 'Clothing',
                    'type' => 'T-Shirt',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => 'Classic Fit',
                    'original_price' => 55000,
                    'sale_price' => 85000, // +30000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Classic Fit New York Jersey T-Shirt',
                    'category' => 'Clothing',
                    'type' => 'T-Shirt',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => 'Classic Fit',
                    'original_price' => 70000,
                    'sale_price' => 105000, // +35000
                    'gender' => 'male',
                ],

                // Footwear - Loafers
                [
                    'product_name' => 'Chalmers Burnished Calfskin Penny Loafer',
                    'category' => 'Footwear',
                    'type' => 'Loafers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 100000,
                    'sale_price' => 135000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Edric Leather Penny Loafer',
                    'category' => 'Footwear',
                    'type' => 'Loafers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 60000,
                    'sale_price' => 95000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Maestra Tasseled Calfskin Loafer',
                    'category' => 'Footwear',
                    'type' => 'Loafers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 80000,
                    'sale_price' => 115000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Meegan Calfskin Penny Loafer',
                    'category' => 'Footwear',
                    'type' => 'Loafers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 90000,
                    'sale_price' => 125000, // +35000
                    'gender' => 'male',
                ],

                // Footwear - Shoes
                [
                    'product_name' => 'Asher Monk-Strap Shoe',
                    'category' => 'Footwear',
                    'type' => 'Shoes',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 70000,
                    'sale_price' => 105000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Darnell Calf Monk-Strap Shoe',
                    'category' => 'Footwear',
                    'type' => 'Shoes',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 135000,
                    'sale_price' => 170000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Darnell Calfskin Monk-Strap Shoe',
                    'category' => 'Footwear',
                    'type' => 'Shoes',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 140000,
                    'sale_price' => 175000, // +35000
                    'gender' => 'male',
                ],

                // Footwear - Slides & Sandals
                [
                    'product_name' => 'Fisher Calfskin Slide Sandal',
                    'category' => 'Footwear',
                    'type' => 'Slides & Sandals',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 60000,
                    'sale_price' => 95000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Leather Slide Sandal',
                    'category' => 'Footwear',
                    'type' => 'Slides & Sandals',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 55000,
                    'sale_price' => 85000, // +30000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Polo Bear Slide',
                    'category' => 'Footwear',
                    'type' => 'Slides & Sandals',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 50000,
                    'sale_price' => 80000, // +30000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Shlborri-Inspired Slide',
                    'category' => 'Footwear',
                    'type' => 'Slides & Sandals',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 60000,
                    'sale_price' => 95000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Zane Leather Sandal',
                    'category' => 'Footwear',
                    'type' => 'Slides & Sandals',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 55000,
                    'sale_price' => 85000, // +30000
                    'gender' => 'male',
                ],

                // Footwear - Sneakers
                [
                    'product_name' => 'Heritage Court II Leather Sneaker',
                    'category' => 'Footwear',
                    'type' => 'Sneakers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 60000,
                    'sale_price' => 95000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Masters Court Suede-Paneled Sneaker',
                    'category' => 'Footwear',
                    'type' => 'Sneakers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 70000,
                    'sale_price' => 105000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Rilke Court Tumbled Leather Sneaker',
                    'category' => 'Footwear',
                    'type' => 'Sneakers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 80000,
                    'sale_price' => 115000, // +35000
                    'gender' => 'male',
                ],
                [
                    'product_name' => 'Train 89 Suede & Oxford Sneaker',
                    'category' => 'Footwear',
                    'type' => 'Sneakers',
                    'brand' => 'Ralph Lauren Corporation',
                    'fit' => '',
                    'original_price' => 60000,
                    'sale_price' => 95000,
                    'gender' => 'male',
                ],
        ];


        foreach ($productsData as $data) {
            // Ensure original price >= 50,000 and sale price > original price
            if ($data['original_price'] < 50000 || $data['sale_price'] <= $data['original_price']) {
                continue; // skip invalid data
            }

            // Get related brand
            $brand = Brand::where('brand_name', $data['brand'])->first();

            // Get related category
            $category = ProductCategory::where('category_name', $data['category'])->first();

            // Get related product type under this category
            $productType = ProductType::where('name', $data['type'])
                            ->where('product_category_id', $category->id ?? null)
                            ->first();

                            if (!$category || !$productType) {
                                continue;
                            }

            // Get fit if exists
            $fit = null;
            if ($data['fit']) {
                $fit = Fit::where('fit_name', $data['fit'])->first();
            }

            // Generate product code
            $latestId = Product::max('id') + 1;
            $date = now()->format('Ymd');
            $productCode = 'PROD-' . $date . '-' . str_pad($latestId, 4, '0', STR_PAD_LEFT);

            // Create product
            Product::create([
                'product_code' => strtoupper($productCode),
                'product_name' => $data['product_name'],
                'slug' => Str::slug($data['product_name'], '-'),
                'product_description' => $data['product_name'] . ' high quality product.',
                'original_price' => $data['original_price'],
                'sale_price' => $data['sale_price'],
                'discount_type' => null,
                'discount_value' => null,
                'display_price' => $data['sale_price'],
                'gender' => $data['gender'],
                'is_new_arrival' => 0,
                'stock_count' => 0,
                'brand_id' => $brand ? $brand->id : null,
                'product_category_id' => $category ? $category->id : null,
                'product_type_id' => $productType ? $productType->id : null,
                'fit_id' => $fit ? $fit->id : null,
                'user_id' => 1,
            ]);
        }
    }
}
