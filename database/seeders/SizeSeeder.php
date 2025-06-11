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
       $sizes = [ 'XS', 'S', 'M', 'L', 'XL', 'XXL','28', '30', '32', '34', '36', '38', '40','EU-35', 'EU-36', 'EU-37', 'EU-38', 'EU-39',
       'EU-40', 'EU-41', 'EU-42', 'EU-43', 'EU-44',
       'EU-45', 'EU-46', 'EU-47', 'EU-48'];

       $now = Carbon::now();
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
