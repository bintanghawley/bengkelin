<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $seeders = [
            ServiceSeeder::class,
            TireSeeder::class,
            OilSeeder::class,
            SparepartSeeder::class,
        ];

        if (! app()->environment('production')) {
            array_unshift($seeders, RoleUserSeeder::class);
        }

        $this->call($seeders);
    }
}
