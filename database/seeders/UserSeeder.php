<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Ahli Gizi Test',
            'email' => 'gizi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ahli_gizi',
        ]);

        User::updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin Kantin Test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
