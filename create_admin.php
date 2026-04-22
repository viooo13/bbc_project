<?php

// Quick script to create admin account
require_once __DIR__ . '/../../vendor/autoload.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Admin;

$admin = Admin::updateOrCreate(
    ['username' => 'bbcjaya123'],
    [
        'name' => 'Admin BBC',
        'email' => 'admin@bbc.com',
        'password' => bcrypt('bbcjaya123'),
        'role' => 'owner',
        'status' => 'active',
    ]
);

echo "Admin account created/updated successfully!\n";
echo "Username: bbcjaya123\n";
echo "Password: bbcjaya123\n";