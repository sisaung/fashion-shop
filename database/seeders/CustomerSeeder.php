<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get all users
         $users = User::where('is_admin', '!=', 'admin')->get();

         foreach ($users as $user) {
             Customer::create([
                 'id' => $user->id,
                 'customer_name' => $user->name,
                 'customer_email' => $user->email, // or any fake email if needed

             ]);
         }

    }
}
