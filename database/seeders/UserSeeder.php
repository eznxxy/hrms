<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'role_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'HRMS',
                'email' => 'admin@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'first_name' => 'Monica',
                'last_name' => 'Khalitsa',
                'email' => 'monica@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'first_name' => 'Arif Dwi',
                'last_name' => 'Laksana',
                'email' => 'arif@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'first_name' => 'Bagas',
                'last_name' => 'Kurniawan',
                'email' => 'bagas@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'first_name' => 'Bonggo',
                'last_name' => 'Prasetyanto',
                'email' => 'bonggo@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'first_name' => 'Fillian',
                'last_name' => 'Adriyansah',
                'email' => 'fillian@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 3,
                'first_name' => 'Mikha',
                'last_name' => 'Junior',
                'email' => 'mikha@mailinator.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('users')) {
            User::insert($users);
        }
    }
}
