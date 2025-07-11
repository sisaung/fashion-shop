<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define fits
        $fits = [
            'Slim Fit',
            'Regular Fit',
            'Oversized Fit',
            'Relaxed Fit',
            'Straight Fit',
            'Tailored Fit',
            'Bodycon Fit',
            'A-Line Fit',
            'Wrap Fit',
            'Boxy Fit',
            'Stretch Fit',
            'Slim-Stretch Fit',
            'Flared Fit',
            'Wide-Leg Fit',
            'Comfort Fit',
            'Short-Skirt Fit',
            'Long-Skirt Fit',
            'Mini-Skirt Fit',
            'Wide Fit',
            'Rib Fit',
            'Classic Fit',
            'Loose Fit',
            'Volume Fit',
            'All Fit',
            'Bit Fit'

        ];

        $now = now();

        // Insert fits
        foreach ($fits as $fit) {
            DB::table('fits')->insert([
                'fit_name' => $fit,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }}
}
