<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('asdffdsa'),
                'is_admin' => 'admin',
            ],
            [
                'name' => 'mgmg',
                'email' => 'mgmg@gmail.com',
                'password' => Hash::make('asdffdsa'),
                'is_admin' => 'user',
            ],
            [
                'name' => 'aungaung',
                'email' => 'aungaung@gmail.com',
                'password' => Hash::make('asdffdsa'),
                'is_admin' => 'user',
            ],
            [
                'name' => 'zawzaw',
                'email' => 'zawzaw@gmail.com',
                'password' => Hash::make('asdffdsa'),
                'is_admin' => 'user',
            ]
        ];

        foreach ($user as $key => $value) {


            User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
                'is_admin' => $value['is_admin'],
            ]);
        }
    }
}
