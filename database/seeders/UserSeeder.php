<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'System Admin',
            'username' => 'admin',
            'email' => 'admin@eduangle.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'admin'
        ]);

        \App\Models\User::create([
            'name' => 'Pak Guru Budi',
            'username' => 'teacher',
            'email' => 'teacher@eduangle.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'teacher'
        ]);

        \App\Models\User::create([
            'name' => 'Siswa Kreatif',
            'username' => 'siswa',
            'email' => 'siswa@eduangle.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'student'
        ]);
    }
}
