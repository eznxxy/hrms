<?php

namespace Database\Seeders;

use App\Models\TerminationCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TerminationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => '1',
                'name' => 'PHK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'name' => 'Perilaku Tercela',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'name' => 'Kinerja Buruk',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('termination_categories')) {
            TerminationCategory::insert($categories);
        }
    }
}
