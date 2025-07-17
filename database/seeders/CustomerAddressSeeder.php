<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get all customers
         $customers = Customer::all();

         foreach ($customers as $customer) {
             CustomerAddress::create([
                 'customer_id' => $customer->id,
                 'phone_number' => '09' . rand(100000000, 999999999),
                 'city' => 'Yangon',
                 'township' => 'Hlaing',
                 'address_detail' => 'No.456, Example Street, near XYZ market',
             ]);
         }
    }
}
