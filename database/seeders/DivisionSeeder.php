<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            [
                'code' => 'DV-CF',
                'name' => 'Corporation Function',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DV-GW',
                'name' => 'Growth',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DV-IT',
                'name' => 'Information technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DV-L',
                'name' => 'Learning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'DV-PD',
                'name' => 'Product',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        if (Schema::hasTable('divisions')) {
            Division::insert($divisions);
        }
    }
}
