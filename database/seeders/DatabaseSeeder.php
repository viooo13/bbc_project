<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (credentials requested)
        User::updateOrCreate(
            ['email' => 'admin@bbc.com'],
            [
                'name' => 'bbcjaya123',
                'phone' => '08123456789',
                'password' => bcrypt('bbcjaya123'),
                'role' => 'admin',
            ]
        );

        // Create regular user
        User::updateOrCreate(
            ['email' => 'user@bbc.com'],
            [
                'name' => 'Regular User',
                'phone' => '08987654321',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ]
        );

        $this->call(MenuSeeder::class);
    }
}
