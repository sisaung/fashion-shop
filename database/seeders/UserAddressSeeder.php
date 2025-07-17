<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Get all users
       $users = User::all();

       foreach ($users as $user) {
           UserAddress::create([
               'user_id' => $user->id,
               'name' => $user->name, // use user name or any default
               'phone_number' => '09' . rand(100000000, 999999999), // random Myanmar phone number
               'city' => 'Yangon',
               'township' => 'Hlaing',
               'address_detail' => 'No.123, Example Street, near ABC school',
           ]);
       }
    }
}
