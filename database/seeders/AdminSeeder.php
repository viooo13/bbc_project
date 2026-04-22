<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        Admin::updateOrCreate(
            ['username' => 'bbcjaya123'],
            [
                'name' => 'Admin BBC',
                'email' => 'admin@bbc.com',
                'password' => bcrypt('bbcjaya123'),
                'role' => 'owner',
                'status' => 'active',
            ]
        );
    }
}
