<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleUserSeeder::class,
            ServiceSeeder::class,
            TireSeeder::class,
            OilSeeder::class,
            SparepartSeeder::class,
        ]);
    }
}
