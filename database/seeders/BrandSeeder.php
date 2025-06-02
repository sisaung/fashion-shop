<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ["brand_name" => "Boss", "brand_image" => null],
            ["brand_name" => "Gucci", "brand_image" => null],
            ["brand_name" => "Prada", "brand_image" => null],
            ["brand_name" => "Louis Vuitton", "brand_image" => null],
            ["brand_name" => "Chanel", "brand_image" => null],
            ["brand_name" => "Dior", "brand_image" => null],
            ["brand_name" => "Versace", "brand_image" => null],
            ["brand_name" => "Armani", "brand_image" => null],
            ["brand_name" => "Hermès", "brand_image" => null],
            ["brand_name" => "Balenciaga", "brand_image" => null],
            ["brand_name" => "Fendi", "brand_image" => null],
            ["brand_name" => "Givenchy", "brand_image" => null],
            ["brand_name" => "Valentino", "brand_image" => null],
            ["brand_name" => "Burberry", "brand_image" => null],
            ["brand_name" => "Saint Laurent", "brand_image" => null],
        ];

     $brands =  array_map(fn($brand) => [

        'brand_name' => $brand['brand_name'],
        'brand_image' => $brand['brand_image'],
        'user_id' => 1,
        'created_at' => now(),
        'updated_at' => now()

     ] , $brands);

       foreach($brands as $brand) {
        DB::table('brands')->insert($brand);
       }
    }
}
