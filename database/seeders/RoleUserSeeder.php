<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'jenis_kelamin' => 'L',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mekanik@gmail.com'],
            [
                'name' => 'Mekanik',
                'password' => Hash::make('123456'),
                'jenis_kelamin' => 'L',
                'role' => 'mekanik',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pengguna@gmail.com'],
            [
                'name' => 'Pengguna',
                'password' => Hash::make('123456'),
                'jenis_kelamin' => 'P',
                'role' => 'pengguna',
            ]
        );
    }
}
