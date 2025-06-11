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
        ];

        $now = Carbon::now();

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
