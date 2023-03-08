<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salaries = [
            [
                'position_id' => '1',
                'nominal' => 5000001,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '2',
                'nominal' => 5000002,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '3',
                'nominal' => 5000003,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '4',
                'nominal' => 5000004,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '5',
                'nominal' => 5000005,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '6',
                'nominal' => 5000006,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '7',
                'nominal' => 5000007,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '8',
                'nominal' => 5000008,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '9',
                'nominal' => 5000009,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '10',
                'nominal' => 5000010,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '11',
                'nominal' => 5000011,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '12',
                'nominal' => 5000012,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '13',
                'nominal' => 5000013,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '14',
                'nominal' => 5000014,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '15',
                'nominal' => 5000015,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '16',
                'nominal' => 5000016,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '17',
                'nominal' => 5000017,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '18',
                'nominal' => 5000018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position_id' => '19',
                'nominal' => 5000019,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('salaries')) {
            Salary::insert($salaries);
        }
    }
}
