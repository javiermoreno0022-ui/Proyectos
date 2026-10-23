<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Ana López',
            'email' => 'ana@taskboard.test',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Carlos Pérez',
            'email' => 'carlos@taskboard.test',
            'password' => Hash::make('password123'),
        ]);

        $this->call([
            ComercioSeeder::class,
        ]);
    }
}
