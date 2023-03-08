<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            UserRoleSeeder::class,
            DivisionSeeder::class,
            PositionSeeder::class,
            StructuralSeeder::class,
            ProfileSeeder::class,
            SalarySeeder::class,
            TerminationCategorySeeder::class,
        ]);
    }
}
