<?php

namespace Database\Seeders;

use App\Models\Structural;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StructuralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $structurals = [
            [
                'employee_id' => '1',
                'position_id' => '3',
                'code' => 'new',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => '2',
                'position_id' => '4',
                'code' => 'new',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => '3',
                'position_id' => '5',
                'code' => 'new',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => '4',
                'position_id' => '6',
                'code' => 'new',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => '5',
                'position_id' => '7',
                'code' => 'new',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => '6',
                'position_id' => '8',
                'code' => 'new',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('structurals')) {
            Structural::insert($structurals);
        }
    }
}
