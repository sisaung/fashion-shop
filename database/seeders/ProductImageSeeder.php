<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $imageManager = ImageManager::gd(); // or ->imagick() based on your setup

        //  Define product images data by product_name
        // $productImages = [
        //     'Polo Bear Cotton-Blend Crew Sock 6-Pack' => ['polo-bear-cotton.png'],
        //     'Cotton-Blend Quarter Sock 6-Pack' => ['blend.png'],
        // ];


        $productsData = [
            [
                'product_name' => 'Polo Bear Cotton-Blend Crew Sock 6-Pack',
                'brand' => 'polo',
                'type' => 'sock',
                'images' => ['polo-bear-cotton.png'],
            ],

            [
                'product_name' => 'Cotton-Blend Quarter Sock 6-Pack',
                'brand' => 'polo',
                'type' => 'sock',
                'images' => ['blend.png'],
            ],

            //polo

            [
                'product_name' => 'Big Pony Mesh Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => [
                    'Big Pony Mesh Polo Shirt - All Fits.png',
                    's7-1365173_alternate10.avif',
                    '$115.00.avif',
                    's7-1365173_alternate4.avif',
                ],
            ],
            [
                'product_name' => 'Classic Fit Mesh Graphic Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => [
                'Classic Fit Mesh Graphic Polo Shirt.png',
                's7-AI710974580001_alternate10.avif',
                '$168.png',
                's7-AI710974580001_alternate3.avif',
                's7-AI710974580001_alternate4.avif',],
            ],
            [
                'product_name' => 'Classic Fit Polo Bear Mesh Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => [  'Classic Fit Polo Bear Mesh Polo Shirt.png','s7-AI710974583001_alternate10.avif',

                's7-AI710974583001_alternate3.avif',
                's7-AI710974583001_alternate4.avif',],
            ],
            [
                'product_name' => 'Classic Fit Soft Cotton Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => ['Classic Fit Soft Cotton Polo Shirt.png','s7-1396581_alternate10.avif',

                's7-1396581_alternate3.avif',
                's7-1396581_alternate4.avif',],
            ],
            [
                'product_name' => 'Polo Ralph Lauren Yankees Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => ['Polo Ralph Lauren Yankees Polo Shirt.png','$148.00.avif',

                's7-AI710967425004_alternate1.avif',
                's7-AI710967425004_alternate3.avif',],
            ],
            [
                'product_name' => 'Soft Cotton Polo Shirt',
                'brand' => 'polo',
                'type' => 'Polo Shirt',
                'images' => ['Soft Cotton Polo Shirt - All Fits.png','$110.00.avif',
                's7-AI710660606201_alternate3.avif',
                's7-AI710660606201_alternate10.avif',
                ],
            ],
            [
                'product_name' => 'Classic Fit Gingham Oxford Shirt',
                'brand' => 'polo',
                'type' => 'Shirt',
                'images' => ['Classic Fit Gingham Oxford Shirt.png',
                's7-1287236_alternate3.avif',
                's7-1287236_alternate4.avif',
                's7-1287236_alternate10.avif',],
            ],
            [
                'product_name' => 'Classic Fit Linen Shirt',
                'brand' => 'polo',
                'type' => 'Shirt',
                'images' => [  'Classic Fit Linen Shirt.png','s7-1358540_alternate16.avif',
                's7-1358540_alternate3.avif',
                's7-1358540_alternate4.avif',
                's7-1358540_alternate10.avif',
                's7-1358540_alternate15.avif',],
            ],
            [
                'product_name' => 'Classic Fit Striped Linen Shirt',
                'brand' => 'polo',
                'type' => 'Shirt',
                'images' => ['Classic Fit Striped Linen Shirt.png',
                            's7-AI710966142001_alternate3.avif',
                            's7-AI710966142001_alternate4.avif',
                            's7-AI710966142001_alternate10.avif',
                            's7-AI710966142001_alternate20.avif',],
            ],
            [
                'product_name' => 'Featherweight Mesh Shirt',
                'brand' => 'polo',
                'type' => 'Shirt',
                'images' => ['Featherweight Mesh Shirt.png',
                        's7-1364843_alternate3.avif',
                        's7-1364843_alternate4.avif',
                        's7-1364843_alternate9.avif',
                        's7-1364843_alternate10.avif'],
            ],
            [
                'product_name' => 'The Iconic Oxford Shirt',
                'brand' => 'polo',
                'type' => 'Shirt',
                'images' => ['The Iconic Oxford Shirt - All Fits.png',
                        's7-1151197_alternate20.avif',
                        's7-1151197_alternate3.avif',
                        's7-1151197_alternate4.avif',
                        's7-1151197_alternate10.avif'],
            ],
            [
                'product_name' => '5-Inch Stretch Classic Fit Chino Short',
                'brand' => 'polo',
                'type' => 'Shorts',
                'images' => ['5-Inch Stretch Classic Fit Chino Short.png',
                            's7-1435682_alternate1.avif',
                            's7-1435682_alternate3.avif',
                            's7-1435682_alternate4.avif',
                            's7-1435682_alternate10.avif'],
            ],
            [
                'product_name' => '7-Inch Stretch Classic Seersucker Short',
                'brand' => 'polo',
                'type' => 'Shorts',
                'images' => ['7-Inch Stretch Classic Seersucker Short.png',
                                's7-AI710968939001_alternate1.avif',
                                's7-AI710968939001_alternate3.avif',
                                's7-AI710968939001_alternate4.avif',
                                's7-AI710968939001_alternate10.avif',],
            ],
            [
                'product_name' => '8.5-Inch London Double-Knit Short',
                'brand' => 'polo',
                'type' => 'Shorts',
                'images' => ['8.5-Inch London Double-Knit Short.png',
                            's7-AI710977461001_alternate1.avif',
                            's7-AI710977461001_alternate3.avif',
                            's7-AI710977461001_alternate4.avif',
                            's7-AI710977461001_alternate10.avif'],
            ],
            [
                'product_name' => '8-Inch Classic Fit Ripstop Cargo Short',
                'brand' => 'polo',
                'type' => 'Shorts',
                'images' => ['8-Inch Classic Fit Ripstop Cargo Short.png',
                            's7-AI710958606001_alternate1.avif',
                            's7-AI710958606001_alternate3.avif',
                            's7-AI710958606001_alternate4.avif',
                            's7-AI710958606001_alternate10.avif'],
            ],
            [
                'product_name' => '9-Inch Relaxed Fit Carpenter Short',
                'brand' => 'polo',
                'type' => 'Shorts',
                'images' => ['9-Inch Relaxed Fit Carpenter Short.png',
                        's7-AI710971777001_alternate1.avif',
                        's7-AI710971777001_alternate3.avif',
                        's7-AI710971777001_alternate4.avif',
                        's7-AI710971777001_alternate10.avif'],
            ],
            [
                'product_name' => 'Argyle Cotton-Wool Sweater',
                'brand' => 'polo',
                'type' => 'Sweaters',
                'images' => ['Argyle Cotton-Wool Sweater.png',
                            's7-AI710970653001_alternate3.avif',
                            's7-AI710970653001_alternate4.avif',
                            's7-AI710970653001_alternate10.avif'],
            ],
            [
                'product_name' => 'Big Fit Logo Cotton Sweater',
                'brand' => 'polo',
                'type' => 'Sweaters',
                'images' => [ 'Big Fit Logo Cotton Sweater.png',
                's7-AI710970290001_alternate3.avif',
                's7-AI710970290001_alternate4.avif',
                's7-AI710970290001_alternate10.avif'],
            ],
            [
                'product_name' => 'Cable-Knit Wool-Cashmere Sweater',
                'brand' => 'polo',
                'type' => 'Sweaters',
                'images' => [ 'Cable-Knit Wool-Cashmere Sweater.png',
                's7-1450570_alternate3.avif',
                's7-1450570_alternate4.avif',
                's7-1450570_alternate10.avif'],
            ],
            [
                'product_name' => 'Polo Bear Sweater',
                'brand' => 'polo',
                'type' => 'Sweaters',
                'images' => ['Polo Bear Sweater.png',
                            's7-AI710970284001_alternate3.avif',
                            's7-AI710970284001_alternate4.avif',
                            's7-AI710970284001_alternate5.avif',
                            's7-AI710970284001_alternate10.avif'],
            ],
            [
                'product_name' => 'Textured Cotton-Linen Sweater',
                'brand' => 'polo',
                'type' => 'Sweaters',
                'images' => ['Textured Cotton-Linen Sweater.png',
                                's7-AI710934180006_alternate10.avif',
                                's7-AI710934180006_alternate3.avif',
                                's7-AI710934180006_alternate4.avif'],
            ],


            // polo T-shirt

                [
                    'product_name' => 'Classic Fit Heavyweight Jersey T-Shirt',
                    'brand' => 'polo',
                    'type' => 'T-Shirts',
                    'images' => ['Classic Fit Heavyweight Jersey T-Shirt.png',
                    's7-1369703_alternate10.avif',
                    's7-1369703_alternate3.avif',
                    's7-1369703_alternate4.avif',]
                ],

                [
                    'product_name' => 'Classic Fit Logo Jersey T-Shirt',
                    'brand' => 'polo',
                    'type' => 'T-Shirts',
                    'images' => ['Classic Fit Logo Jersey T-Shirt.png', 's7-AI710972663002_alternate3.avif', 's7-AI710972663002_alternate4.avif', 's7-AI710972663002_alternate10.avif'],
                ],
                [
                    'product_name' => 'Classic Fit London Jersey T-Shirt',
                    'brand' => 'polo',
                    'type' => 'T-Shirts',
                    'images' => ['Classic Fit London Jersey T-Shirt.png', 's7-AI710977451001_alternate3.avif', 's7-AI710977451001_alternate4.avif', 's7-AI710977451001_alternate10.avif'],
                ],
                [
                    'product_name' => 'Classic Fit New York Jersey T-Shirt',
                    'brand' => 'polo',
                    'type' => 'T-Shirts',
                    'images' => ['Classic Fit New York Jersey T-Shirt.png', 's7-AI710977447001_alternate3.avif', 's7-AI710977447001_alternate4.avif', 's7-AI710977447001_alternate10.avif'],
                ],

                // polo loafters

                [
                    'product_name' => 'Chalmers Burnished Calfskin Penny Loafer',
                    'brand' => 'polo',
                    'type' => 'Loafers',
                    'images' => ['Chalmers Burnished Calfskin Penny Loafer.png', 's7-1437139_alternate1.png', 's7-1437139_alternate3.avif', 's7-1437139_alternate4.avif'],
                ],
                [
                    'product_name' => 'Edric Leather Penny Loafer',
                    'brand' => 'polo',
                    'type' => 'Loafers',
                    'images' => ['Edric Leather Penny Loafer.png', 's7-1360825_alternate1.avif', 's7-1360825_alternate3.avif', 's7-1360825_alternate4.avif'],
                ],
                [
                    'product_name' => 'Maestra Tasseled Calfskin Loafer',
                    'brand' => 'polo',
                    'type' => 'Loafers',
                    'images' => ['Maestra Tassel Calfskin Loafer.png', 's7-AI811967540001_alternate1.avif', 's7-AI811967540001_alternate3.avif', 's7-AI811967540001_alternate4.avif'],
                ],
                [
                    'product_name' => 'Meegan Calfskin Penny Loafer',
                    'brand' => 'polo',
                    'type' => 'Loafers',
                    'images' => ['Meegan Calfskin Penny Loafer.png', 's7-1419542_alternate1.avif', 's7-1419542_alternate2.avif', 's7-1419542_alternate3.avif'],
                ],

                // polo shoe
                [
                    'product_name' => 'Asher Monk-Strap Shoe',
                    'brand' => 'polo',
                    'type' => 'Shoes',
                    'images' => ['Asher Monk-Strap Shoe.png', 's7-1333527_alternate1.avif', 's7-1333527_alternate2.avif', 's7-1333527_alternate3.png'],
                ],
                [
                    'product_name' => 'Darnell Calf Monk-Strap Shoe',
                    'brand' => 'polo',
                    'type' => 'Shoes',
                    'images' => ['Darnell Calf Monk-Strap Shoe.png', 's7-1169846_alternate1.avif', 's7-1169846_alternate2.avif', 's7-1169846_alternate3.avif'],
                ],
                [
                    'product_name' => 'Darnell Calfskin Monk-Strap Shoe',
                    'brand' => 'polo',
                    'type' => 'Shoes',
                    'images' => ['Darnell Calfskin Monk-Strap Shoe.png', 's7-AI801913607001_alternate1.avif', 's7-AI801913607001_alternate3.avif', 's7-AI801913607001_alternate4.avif'],
                ],


                // polo slide & sandals
                [
                    'product_name' => 'Fisher Calfskin Slide Sandal',
                    'brand' => 'polo',
                    'type' => 'Slides & Sandals',
                    'images' => ['Fisher Calfskin Slide Sandal.png', 's7-AI801938761001_alternate1.avif', 's7-AI801938761001_alternate3.avif', 's7-AI801938761001_alternate4.png'],
                ],
                [
                    'product_name' => 'Leather Slide Sandal',
                    'brand' => 'polo',
                    'type' => 'Slides & Sandals',
                    'images' => ['Leather Slide Sandal.png', 's7-AI801914090001_alternate1.avif', 's7-AI801914090001_alternate3.avif', 's7-AI801914090001_alternate4.avif'],
                ],

                [
                    'product_name' => 'Polo Bear Slide',
                    'brand' => 'polo',
                    'type' => 'Slides & Sandals',
                    'images' => ['Polo Bear Slide.avif.png', 's7-AI809962615001_alternate1.webp', 's7-AI809962615001_alternate3.avif', 's7-AI809962615001_alternate4.avif'],
                ],
                [
                    'product_name' => 'Shlborri-Inspired Slide',
                    'brand' => 'polo',
                    'type' => 'Slides & Sandals',
                    'images' => ['Shibori-Inspired Slide.png'],
                ],
                [
                    'product_name' => 'Zane Leather Sandal',
                    'brand' => 'polo',
                    'type' => 'Slides & Sandals',
                    'images' => ['Zane Leather Sandal.png', 's7-AI803961444002_alternate1.avif', 's7-AI803961444002_alternate3.avif', 's7-AI803961444002_alternate4.avif'],
                ],

            //   polo  Sneakers
                [
                    'product_name' => 'Heritage Court II Leather Sneaker',
                    'brand' => 'polo',
                    'type' => 'Sneakers',
                    'images' => ['Heritage Court II Leather Sneaker.png', 's7-1446091_alternate1.avif', 's7-1446091_alternate3.avif',  's7-1446091_alternate8.avif'],
                ],
                [
                    'product_name' => 'Masters Court Suede-Paneled Sneaker',
                    'brand' => 'polo',
                    'type' => 'Sneakers',
                    'images' => ['Masters Court Suede-Paneled Sneaker.png', 's7-AI809971482001_alternate1.avif', 's7-AI809971482001_alternate3.avif', 's7-AI809971482001_alternate4.avif'],
                ],
                [
                    'product_name' => 'Rilke Court Tumbled Leather Sneaker',
                    'brand' => 'polo',
                    'type' => 'Sneakers',
                    'images' => ['RLite Court Tumbled Leather Sneaker.png', 's7-AI809974097001_alternate1.avif', 's7-AI809974097001_alternate3.avif', 's7-AI809974097001_alternate4.avif', 's7-AI809974097001_alternate7.avif'],
                ],
                [
                    'product_name' => 'Train 89 Suede & Oxford Sneaker',
                    'brand' => 'polo',
                    'type' => 'Sneakers',
                    'images' => ['Train 89 Suede & Oxford Sneaker.png','s7-AI809968176001_alternate1.avif','s7-AI809968176001_alternate3.avif','s7-AI809968176001_alternate4.avif'],
                ],


                  // Polo Blazers (Outerwear)
            [
                'product_name' => 'Gregory Hand-Tailored Wool Serge Blazer',
                'brand' => 'polo',
                'type' => 'Blazer',
                'images' => ['Gregory Hand-Tailored Wool Serge Blazer.png','s7-1339458_alternate3.avif','s7-1339458_alternate4.avif','s7-1339458_alternate5.avif','s7-1339458_alternate10.avif','s7-1339458_alternate17.avif'],
            ],
            [
                'product_name' => 'Hadley Hand-Tailored Wool Piqué Blazer',
                'brand' => 'polo',
                'type' => 'Blazer',
                'images' => ['Hadley Hand-Tailored Wool Piqué Blazer.png','s7-AI798926849005_alternate3.avif','s7-AI798926849005_alternate4.avif','s7-AI798926849005_alternate5.avif','s7-AI798926849005_alternate10.avif'],
            ],
            [
                'product_name' => 'Kent Handmade Cashmere Blazer',
                'brand' => 'polo',
                'type' => 'Blazer',
                'images' => ['Kent Handmade Cashmere Blazer.png','s7-AI798954042001_alternate3.avif','s7-AI798954042001_alternate4.avif','s7-AI798954042001_alternate5.avif','s7-AI798954042001_alternate10.avif'],
            ],
            [
                'product_name' => 'The Iconic Doeskin Blazer',
                'brand' => 'polo',
                'type' => 'Blazer',
                'images' => ['The Iconic Doeskin Blazer.png','s7-1156439_alternate3.avif','s7-1156439_alternate4.avif','s7-1156439_alternate5.avif','s7-1156439_alternate10.avif'],
            ],
            [
                'product_name' => 'The Iconic Doeskin Two-Button Blazer',
                'brand' => 'polo',
                'type' => 'Blazer',
                'images' => ['The Iconic Doeskin Two-Button Blazer.png','s7-1135845_alternate3.avif','s7-1135845_alternate4.avif','s7-1135845_alternate5.avif','s7-1135845_alternate6.avif','s7-1135845_alternate10.avif',],
            ],

            //Polo jacket
            [
                'product_name' => 'Ralph’s Coffee Baseball Jacket',
                'brand' => 'polo',
                'type' => 'Jacket',
                'images' => ['Ralph’s Coffee Baseball Jacket.png','s7-AI710P01488001_alternate1.avif','s7-AI710P01488001_alternate3.avif','s7-AI710P01488001_alternate6.avif'],
            ],
            [
                'product_name' => 'Stretch Double-Knit Track Jacket',
                'brand' => 'polo',
                'type' => 'Jacket',
                'images' => ['Stretch Double-Knit Track Jacket.png','s7-AI710972339001_alternate3.avif','s7-AI710972339001_alternate4.avif','s7-AI710972339001_alternate10.avif'],
            ],
            [
                'product_name' => 'Wimbledon Double-Knit Baseball Jacket',
                'brand' => 'polo',
                'type' => 'Jacket',
                'images' => ['Wimbledon Double-Knit Baseball Jacket.png','s7-AI710970510001_alternate3.avif','s7-AI710970510001_alternate4.avif','s7-AI710970510001_alternate5.avif','s7-AI710970510001_alternate10.avif'],
            ],

            // polo Accessories - Belts
            [
                'product_name' => 'Heritage Plaque-Buckle Belt',
                'brand' => 'polo',
                'type' => 'Belt',
                'images' => ['Heritage Plaque-Buckle Belt.png','s7-1354182_alternate15.avif'],
            ],
            [
                'product_name' => 'Polo Bear Leather Belt',
                'brand' => 'polo',
                'type' => 'Belt',
                'images' => ['Polo Bear Leather Belt.png','s7-1430360_alternate1.avif'],
            ],
            [
                'product_name' => 'Reversible Leather Dress Belt',
                'brand' => 'polo',
                'type' => 'Belt',
                'images' => ['Reversible Leather Dress Belt.png','s7-1392214_alternate1.avif'],
            ],
            [
                'product_name' => 'Suede D-Ring Belt',
                'brand' => 'polo',
                'type' => 'Belt',
                'images' => ['Suede D-Ring Belt.png','s7-1336037_alternate1.avif'],
            ],
            [
                'product_name' => 'Tiger-Buckle Leather Belt',
                'brand' => 'polo',
                'type' => 'Belt',
                'images' => ['Tiger-Buckle Leather Belt.png','s7-1459442_alternate1.avif'],
            ],

    //polo cap

            [
                'product_name' => 'Denim Baseball Cap',
                'brand' => 'polo',
                'type' => 'Cap',
                'images' => ['Denim Baseball Cap.png','s7-1272794_alternate2.avif'],
            ],
            [
                'product_name' => 'Polo Bear Twill Ball Cap',
                'brand' => 'polo',
                'type' => 'Cap',
                'images' => ['Polo Bear Twill Ball Cap.png','s7-AI710966835001_alternate1.avif'],
            ],
            [
                'product_name' => 'Ponte Ball Cap',
                'brand' => 'polo',
                'type' => 'Cap',
                'images' => ['Ponte Ball Cap.png','s7-AI710833790020_alternate1.avif'],
            ],

            //polo accessories - Wallets

            [
                'product_name' => 'Alligator Billfold Wallet',
                'brand' => 'polo',
                'type' => 'Wallets',
                'images' => ['Alligator Billfold Wallet.png','$3200.avif'],
            ],
            [
                'product_name' => 'Pebbled Leather Billfold Wallet',
                'brand' => 'polo',
                'type' => 'Wallets',
                'images' => ['Pebbled Leather Billfold Wallet.png','s7-AI405963224001_alternate1.avif'],
            ],
            [
                'product_name' => 'Polo Bear Leather Billfold Wallet',
                'brand' => 'polo',
                'type' => 'Wallets',
                'images' => ['Polo Bear Leather Billfold Wallet.png','s7-AI405962466001_alternate1.avif','s7-AI405962466001_alternate2.avif'],
            ],

            [
                'product_name' => 'Pony-Plaque Leather Billfold Wallet',
                'brand' => 'polo',
                'type' => 'Wallets',
                'images' => ['Pony-Plaque Leather Billfold Wallet.png','$188.00.avif','s7-AI405931779001_alternate1.avif'],
            ],


            // JJXX Blazer

            // [
            //     'product_name' => 'JXANA Blazer',
            //     'brand' => 'JJXX',
            //     'type' => 'blazer',
            //     'images' => [
            //         'JXANA Blazer.webp',
            //         '£65.00.webp',
            //         'jjxx-jxanamaryregblazertlrln-grey (1).webp',
            //         'jjxx-jxanamaryregblazertlrln-grey (2).webp',
            //         'jjxx-jxanamaryregblazertlrln-grey.webp'
            //     ],
            // ],


            [
                'product_name' => 'JXANA Blazer',
                'brand' => 'JJXX',
                'type' => 'blazer',
                'images' => [
                   'JXANA Blazer.webp' ,
                    'jjxx-jxanamaryregblazertlrln-grey (1).webp',
                    'jjxx-jxanamaryregblazertlrln-grey (2).webp',
                    'jjxx-jxanamaryregblazertlrln-grey.webp',
                    '£65.00.webp'],
                ],
                [
                'product_name' => 'JXELLIS Blazer',
                'brand' => 'JJXX',
                'type' => 'blazer',
                'images' => [
                  'JXELLIS Blazer.webp',
                    'jjxx-jxellismiablazertlrnoos-blue (1).webp',
                    'jjxx-jxellismiablazertlrnoos-blue (2).webp',
                    'jjxx-jxellismiablazertlrnoos-blue.webp',
                    '£45.00.webp'
                ],
            ],

                [
                'product_name' => 'JXMARY Blazer',
                'brand' => 'JJXX',
                'type' => 'blazer',
                'images' => ['JXMARY Blazer.webp',

                    'jjxx-jxmaryblazertlrnoos-grey (1).webp',
                    'jjxx-jxmaryblazertlrnoos-grey (2).webp',
                    'jjxx-jxmaryblazertlrnoos-grey.webp',
                    '£65.00 copy.webp'
                ],
            ],

                [
                    'product_name' => 'JXSOFIE Blazer',
                    'brand' => 'JJXX',
                    'type' => 'blazer',
                    'images' => ['JXSOFIE Blazer.webp',
            'jjxx-jxsofiecutoutblazertlr-black (1).webp',
            'jjxx-jxsofiecutoutblazertlr-black (2).webp',
            'jjxx-jxsofiecutoutblazertlr-black.webp','£65.00 copy 2.webp'
            ],
                ],

            // Hoodie

            [
                'product_name' => 'JXABBIE Hoodie',
                'brand' => 'JJXX',
                'type' => 'hoodie',
                'images' => ['JXABBIE Hoodie.webp',
        'jjxx-jxabbierlxlseveryhoodswtnoos-blue (1).webp',
        'jjxx-jxabbierlxlseveryhoodswtnoos-blue (2).webp',
        'jjxx-jxabbierlxlseveryhoodswtnoos-blue.webp','£30.00.webp'],
            ],
            [
                'product_name' => 'JXABBIE Zip Hoodie',
                'brand' => 'JJXX',
                'type' => 'hoodie',
                'images' => ['JXABBIE Zip Hoodie.webp',
        'jjxx-jxabbierlxlseveryziphoodswtnoos-black (1).webp',
        'jjxx-jxabbierlxlseveryziphoodswtnoos-black (2).webp',
        'jjxx-jxabbierlxlseveryziphoodswtnoos-black.webp','£35.00.webp'],
            ],
            [
                'product_name' => 'JXEMMA Hoodie',
                'brand' => 'JJXX',
                'type' => 'hoodie',
                'images' => ['JXEMMA Hoodie.webp',
        'jjxx-jxemmalsscubahoodswt-grey (1).webp',
        'jjxx-jxemmalsscubahoodswt-grey (2).webp',
        'jjxx-jxemmalsscubahoodswt-grey.webp','£45.00.webp'],
            ],
            [
                'product_name' => 'JXPALMA Hoodie',
                'brand' => 'JJXX',
                'type' => 'hoodie',
                'images' => ['JXPALMA Hoodie.webp',
        'jjxx-jxpalmarlxshortziphoodswt-black (1).webp',
        'jjxx-jxpalmarlxshortziphoodswt-black (2).webp',
        'jjxx-jxpalmarlxshortziphoodswt-black.webp','£35.00 copy.webp'],
            ],

            // jacket

            [
                'product_name' => 'JXELLA Bomber jacket',
                'brand' => 'JJXX',
                'type' => 'jacket',
                'images' => ['JXELLA Bomber jacket.webp',
        'jjxx-jxellabomberjacketotwnoos-black (1).webp',
        'jjxx-jxellabomberjacketotwnoos-black (2).webp',
        'jjxx-jxellabomberjacketotwnoos-black.webp','£25.00.webp']
            ],
            [
                'product_name' => 'JXESSI Bomber jacket',
                'brand' => 'JJXX',
                'type' => 'jacket',
                'images' => ['JXESSI Bomber jacket.webp',
        'jjxx-jxessicollegebomberjacketotwln-purple (1).webp',
        'jjxx-jxessicollegebomberjacketotwln-purple (2).webp',
        'jjxx-jxessicollegebomberjacketotwln-purple.webp','£95.00.webp'
        ],
            ],
            [
                'product_name' => 'JXGAIL Leather look biker jacket',
                'brand' => 'JJXX',
                'type' => 'jacket',
                'images' => ['JXGAIL Leather look biker jacket.webp',
        'jjxx-jxgailfauxleatherbikerjacketnoos-black (1).webp',
        'jjxx-jxgailfauxleatherbikerjacketnoos-black (2).webp',
        'jjxx-jxgailfauxleatherbikerjacketnoos-black.webp','£45.00.webp'
        ],
            ],
            [
                'product_name' => 'JXLEILA Bomber jacket',
                'brand' => 'JJXX',
                'type' => 'jacket',
                'images' => ['JXLEILA Bomber jacket.webp',
        'jjxx-jxleilabomberjacketotwnoos-grey (1).webp',
        'jjxx-jxleilabomberjacketotwnoos-grey (2).webp',
        'jjxx-jxleilabomberjacketotwnoos-grey.webp',
          '£45.00 copy.webp' ],
            ],

            // cap
            [
                'product_name' => 'JJXX JXSUZANNE Baseball Cap',
                'brand' => 'JJXX',
                'type' => 'cap',
                'images' => ['£15.00.webp','JJXX JXSUZANNE Baseball cap -Persimmon Orange - 12274657.webp','jjxx-jxsuzannewashedcapacc-orange (1).webp','jjxx-jxsuzannewashedcapacc-orange (2).webp'],
            ],
            [
                'product_name' => 'JXBASIC Baseball cap',
                'brand' => 'JJXX',
                'type' => 'cap',
                'images' => ['£15.00.webp','jjxx-jxbasicbiglogobaseballdenimcapnoos-blue (1).webp','jjxx-jxbasicbiglogobaseballdenimcapnoos-blue (2).webp','JXBASIC Baseball cap.webp'],
            ],
            [
                'product_name' => 'JXLU Baseball cap',
                'brand' => 'JJXX',
                'type' => 'cap',
                'images' => ['£18.00.webp','jjxx-jxlubroiderieanglaisecapacc-white (1).webp','jjxx-jxlubroiderieanglaisecapacc-white (2).webp','JXLU Baseball cap.webp'],
            ],
            [
                'product_name' => 'JXMORA Baseball cap',
                'brand' => 'JJXX',
                'type' => 'cap',
                'images' => ['£15.00.webp','jjxx-jxmoraseersuckercapacc-turquiose (1).webp','jjxx-jxmoraseersuckercapacc-turquiose (2).webp','JXMORA Baseball cap.webp'],
            ],

            // hat

            [
                'product_name' => 'JXLU Bucket hat',
                'brand' => 'JJXX',
                'type' => 'hat',
                'images' => ['£18.00.webp','jjxx-jxlubroiderieanglaisebuckethatacc-white (1).webp','jjxx-jxlubroiderieanglaisebuckethatacc-white (2).webp','JXLU Bucket hat.webp'],
            ],
            [
                'product_name' => 'JXMORA Bucket hat',
                'brand' => 'JJXX',
                'type' => 'hat',
                'images' => ['£18.00.webp','jjxx-jxmoraseersuckerbuckethatacc-turquiose (1).webp','jjxx-jxmoraseersuckerbuckethatacc-turquiose (2).webp','JXMORA Bucket hat.webp'],
            ],

            //sunglasses
            [
                'product_name' => 'JJXX JXRACHEL Sunglasses',
                'brand' => 'JJXX',
                'type' => 'sunglasses',
                'images' => ['£15.00.webp','JJXX JXRACHEL Sunglasses -Black - 12274702.webp','jjxx-jxrachelcateyesunglassesacc-black (2).webp','jjxx-jxrachelcateyesunglassesacc-black.webp'],
            ],
            [
                'product_name' => 'JXKENT Sunglasses',
                'brand' => 'JJXX',
                'type' => 'sunglasses',
                'images' => ['£15.00.webp','jjxx-jxkentcateyesunglassesacc-black (2).webp','jjxx-jxkentcateyesunglassesacc-black.webp','JXKENT Sunglasses.webp'],
            ],
            [
                'product_name' => 'JXKRISTINA Sunglasses',
                'brand' => 'JJXX',
                'type' => 'sunglasses',
                'images' => ['JXKRISTINA Sunglasses.webp','jjxx-jxkristinasunglassesacc-black.webp','jjxx-jxkristinasunglassesacc-black (2).webp','jjxx-jxkristinasunglassesacc-black (1).webp'],
            ],
            [
                'product_name' => 'JXPHEOBE Sunglasses',
                'brand' => 'JJXX',
                'type' => 'sunglasses',
                'images' => ['£15.00.webp','jjxx-jxpheobesunglassesacc-orange (2).webp','jjxx-jxpheobesunglassesacc-orange.webp','JXPHEOBE Sunglasses.webp'],
            ],
            [
                'product_name' => 'JXROSANNA Sunglasses',
                'brand' => 'JJXX',
                'type' => 'sunglasses',
                'images' => ['£15.00.webp','jjxx-jxrosannasunglassesacc-brown (1).webp','jjxx-jxrosannasunglassesacc-brown.webp','JXROSANNA Sunglasses.webp'],
            ],

            //bag
            //Bags
[
    'product_name' => 'JJXX JXATHENA Crossover bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       '£35.00.webp' ,
        'jjxx-jxathenacrossoverbagacc-grey (1).webp',
        'jjxx-jxathenacrossoverbagacc-grey (2).webp',
        'jjxx-jxathenacrossoverbagacc-grey.webp'],
    ],
[
    'product_name' => 'JJXX JXKENYA Shoulder bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       '£35.00.webp' ,
        'JJXX JXKENYA Shoulder bag -Grey Denim - 12261616.webp',
        'jjxx-jxkenyadenimbagacc-grey (2).webp',
        'jjxx-jxkenyadenimbagacc-grey.webp'],
    ],
[
    'product_name' => 'JXATHENA Bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       'JXATHENA Bag.webp',
        'jjxx-jxathenabagacc-black.webp',
        'jjxx-jxathenabagacc-black (2).webp',
        '£45.00.webp'],
    ],
[
    'product_name' => 'JXBEATA Bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       '£35.00.webp' ,
        'jjxx-jxbeatawashedpubucklebagacc-grey (2).webp',
        'jjxx-jxbeatawashedpubucklebagacc-grey.webp',
        'JXBEATA Bag.webp'],
    ],
[
    'product_name' => 'JXMESA Crossover bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       'JXMESA Crossover bag.webp' ,
        'jjxx-jxmesabag-black.webp',
        'jjxx-jxmesabag-black (3).webp',
        '£40.00.webp'],
    ],
[
    'product_name' => 'JXPATTY Bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       '£22.00.webp' ,
        'jjxx-jxpattypuphonebag-black (2).webp',
        'jjxx-jxpattypuphonebag-black (3).webp',
        'JXPATTY Bag.webp'],
    ],
[
    'product_name' => 'JXTAMPA Shoulder bag',
    'brand' => 'JJXX',
    'type' => 'Bags',
    'images' => [
       '£25.00.webp' ,
        'jjxx-jxtampashoulderbagnoos-black (1).webp',
        'jjxx-jxtampashoulderbagnoos-black (3).webp',
        'JXTAMPA Shoulder bag.webp'],
    ],

        ];



        foreach ($productsData as $data) {
            $productName = $data['product_name'];
            $brand = $data['brand'];
            $type = $data['type'];
            $images = $data['images'];

            // Find product by name
            $product = Product::where('product_name', $productName)->first();

            if (!$product) {
                echo " Product not found: {$productName}\n";
                continue;
            }

            foreach ($images as $imageFileName) {

                $originalPath = storage_path("app/public/product_images/{$brand}/{$type}/" . $imageFileName);


                if (!file_exists($originalPath)) {
                    dd('Image not found at path:', $originalPath);
                    continue;
                }

                $image = $imageManager->read($originalPath);
                $uuid = Str::uuid()->toString();

                $extension = pathinfo($imageFileName, PATHINFO_EXTENSION);
                $originalName = $imageFileName;

                // Save large (original)
                $largeFileName = $uuid . '.' . $extension;
                $largePath = 'product_images/large/' . $largeFileName;
                Storage::disk('public')->put($largePath, file_get_contents($originalPath));

                //  Save preview (1000x1000 resize)
                $previewImage = $image->resize(1000, 1000, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
                $previewPath = 'product_images/preview/' . $uuid . '.jpg';
                Storage::disk('public')->put($previewPath, $previewImage->encode());

                //  Save thumbnail (200x200 crop)
                $thumbnailImage = $image->cover(200, 200);
                $thumbnailPath = 'product_images/thumbnail/' . $uuid . '.jpg';
                Storage::disk('public')->put($thumbnailPath, $thumbnailImage->encode());

                //  Insert into ProductImage table
                ProductImage::create([
                    'product_id'    => $product->id,
                    'original_name' => $originalName,
                    'large'         => $largePath,
                    'preview'       => $previewPath,
                    'thumbnail'     => $thumbnailPath,
                ]);

            }
        }
    }
}
