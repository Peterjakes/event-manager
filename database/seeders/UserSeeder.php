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
         // Seed admin user
    \App\Models\User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Seed organizer user
    \App\Models\User::create([
        'name' => 'Organizer One',
        'email' => 'organizer@example.com',
        'password' => bcrypt('password'),
        'role' => 'organizer',
    ]);

    // Seed customer user
    \App\Models\User::create([
        'name' => 'Customer One',
        'email' => 'customer@example.com',
        'password' => bcrypt('password'),
        'role' => 'customer',
    ]);
    
    }
}
