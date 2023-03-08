<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        $employees = [
            [
                'user_id' => 2,
                'code' => 'ECQA-1-' . $timestamp->format('myHi'),
                'nik' => '3321062208990001',
                'first_name' => 'Monica',
                'last_name' => 'Khalitsa',
                'date_of_birth' => '1995-02-06 21:43:38.000',
                'place_of_birth' => 'Jakarta',
                'gender' => 'female',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'code' => 'ECQA-2-' . $timestamp->format('myHi'),
                'nik' => '3321062208990002',
                'first_name' => 'Arif Dwi',
                'last_name' => 'Laksana',
                'date_of_birth' => '1996-02-06 21:43:38.000',
                'place_of_birth' => 'Sidoarjo',
                'gender' => 'male',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'code' => 'ECQA-3-' . $timestamp->format('myHi'),
                'nik' => '3321062208990003',
                'first_name' => 'Bagas',
                'last_name' => 'Kurniawan',
                'date_of_birth' => '1997-02-06 21:43:38.000',
                'place_of_birth' => 'Sidoarjo',
                'gender' => 'male',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'code' => 'ECQA-4-' . $timestamp->format('myHi'),
                'nik' => '3321062208990004',
                'first_name' => 'Bonggo',
                'last_name' => 'Prasetyanto',
                'date_of_birth' => '1998-02-06 21:43:38.000',
                'place_of_birth' => 'Sidoarjo',
                'gender' => 'male',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'code' => 'ECQA-5-' . $timestamp->format('myHi'),
                'nik' => '3321062208990005',
                'first_name' => 'Fillian',
                'last_name' => 'Adriyansah',
                'date_of_birth' => '1999-02-06 21:43:38.000',
                'place_of_birth' => 'Sidoarjo',
                'gender' => 'male',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'code' => 'ECQA-6-' . $timestamp->format('myHi'),
                'nik' => '3321062208990006',
                'first_name' => 'Mikha',
                'last_name' => 'Junior',
                'date_of_birth' => '2000-02-06 21:43:38.000',
                'place_of_birth' => 'Sidoarjo',
                'gender' => 'male',
                'address' => 'Jl. Berdua',
                'phonecode' => 62,
                'phone' => '089638181254',
                'religion' => 'Islam',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('employees')) {
            Employee::insert($employees);
        }
    }
}
