<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Izzan',
                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ]
        );

        // Create or update test user
        User::updateOrCreate(
            ['email' => 'izzanathmar.m@gmail.com'],
            [
                'name' => 'Izzan',
                'password' => bcrypt('12345678'),
                'role' => 'user'
            ]
        );

        // Create additional test users with unique emails
        User::factory()->count(8)->create([
            'role' => 'user'
        ]);

        // Run other seeders
        $this->call([
            BookSeeder::class,
            // Add other seeders here
        ]);
    }
}