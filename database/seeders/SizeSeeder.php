<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //    $sizes = [ 'XXS','XS', 'S', 'M', 'L', 'XL', 'XXL','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','28','29', '30','31', '32', '34','35', '36','37','39', '38', '40','41','42','43','44','45','46','EU-35', 'EU-36', 'EU-37', 'EU-38', 'EU-39',
    //    'EU-40', 'EU-41', 'EU-42', 'EU-43', 'EU-44',
    //    'EU-45', 'EU-46', 'EU-47', 'EU-48','one size','free size'];

       $sizes = [ 'XXS','XS', 'S', 'M', 'L', 'XL', 'XXL','3XL','4XL','3','3.5','4','4.5','5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','12.5','13','14','15','16','17','18','19','20','28','29', '30','31', '32','33', '34','35', '36','37','38','39', '40','41','42','43','44','45','46','48','50','52','54','EU-35', 'EU-36', 'EU-37', 'EU-38', 'EU-39',
       'EU-40', 'EU-41', 'EU-42', 'EU-43', 'EU-44','1xl','1xbig','2xbig','3xbig','4xbig','5xbig','6xbig','m tall','l tall','xl tall','2l tall','3l tall','4l tall','5l tall',

       'EU-45', 'EU-46', 'EU-47', 'EU-48','one size','free size'];



       $now = now();
       foreach ($sizes as $size) {
        DB::table('sizes')->insert([
            'size_name' => $size,
            'user_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
       }
    }
}
