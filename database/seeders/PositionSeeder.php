<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'division_id' => '1',
                'code' => 'PS-001',
                'name' => 'FAT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '1',
                'code' => 'PS-002',
                'name' => 'Legal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '1',
                'code' => 'PS-003',
                'name' => 'HR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '1',
                'code' => 'PS-004',
                'name' => 'Copr. Project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '2',
                'code' => 'PS-005',
                'name' => 'Digital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '2',
                'code' => 'PS-006',
                'name' => 'Creative',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '2',
                'code' => 'PS-007',
                'name' => 'Partnership',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '2',
                'code' => 'PS-008',
                'name' => 'Biz. Ops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '3',
                'code' => 'PS-009',
                'name' => 'Backend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '3',
                'code' => 'PS-010',
                'name' => 'Frontend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '3',
                'code' => 'PS-011',
                'name' => 'QA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '3',
                'code' => 'PS-012',
                'name' => 'Data Engineer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '4',
                'code' => 'PS-013',
                'name' => 'L. Design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '4',
                'code' => 'PS-014',
                'name' => 'L. Content',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '4',
                'code' => 'PS-015',
                'name' => 'L. Ops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '4',
                'code' => 'PS-016',
                'name' => 'Mon & Ev',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '5',
                'code' => 'PS-017',
                'name' => 'Product Dev',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '5',
                'code' => 'PS-018',
                'name' => 'UI/UX',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => '5',
                'code' => 'PS-019',
                'name' => 'Data Science',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('positions')) {
            Position::insert($positions);
        }
    }
}
