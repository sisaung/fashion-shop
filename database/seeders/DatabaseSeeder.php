<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(FitSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerAddressSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
