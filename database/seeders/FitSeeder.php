<?php

namespace Database\Seeders;

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

        // Insert fits and store their IDs
        $fitIds = [];
        foreach ($fits as $fit) {
            $fitId = DB::table('fits')->updateOrInsert(
                ['fit_name' => $fit],
                ['user_id' => 1 ],
                ['created_at' => now(), 'updated_at' => now()]
            );

            $fitIds[$fit] = DB::table('fits')->where('fit_name', $fit)->value('id');
        }

        // Define product types and their related fits
        $productFits = [
            'T-Shirt' => ['Slim Fit', 'Regular Fit', 'Oversized Fit'],
            'Jeans' => ['Slim Fit', 'Relaxed Fit', 'Straight Fit'],
            'Shirt' => ['Regular Fit', 'Tailored Fit', 'Slim Fit'],
            'Jacket' => ['Regular Fit', 'Boxy Fit', 'Oversized Fit'],
            'Dress' => ['Bodycon Fit', 'A-Line Fit', 'Wrap Fit'],
            'Hoodie' => ['Relaxed Fit', 'Oversized Fit'],
        ];

        foreach ($productFits as $productType => $fits) {
            // Find product_type ID (assumes already seeded)
            $productTypeId = DB::table('product_types')->where('name', $productType)->value('id');

            if ($productTypeId) {
                foreach ($fits as $fitName) {
                    $fitId = $fitIds[$fitName] ?? null;

                    if ($fitId) {
                        // Insert relation into pivot table
                        DB::table('fit_product_type')->updateOrInsert([
                            'fit_id' => $fitId,
                            'product_type_id' => $productTypeId
                        ]);
                    }
                }
            }
        }
    }
}
