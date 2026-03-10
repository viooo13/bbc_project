<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Bakso Urat',
                'description' => 'Bakso urat gurih dengan kuah kaldu hangat.',
                'price' => 15000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Telur',
                'description' => 'Bakso isi telur, cocok untuk yang suka porsi lebih.',
                'price' => 18000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Tulang',
                'description' => 'Bakso tulang dengan cita rasa autentik.',
                'price' => 25000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Original',
                'description' => 'Mie ayam dengan topping ayam manis gurih.',
                'price' => 14000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Bakso',
                'description' => 'Mie ayam ditambah bakso, lebih kenyang.',
                'price' => 18000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 1',
                'description' => '1 Bakso + 1 Es Teh.',
                'price' => 22000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 2',
                'description' => '1 Mie Ayam + 1 Es Jeruk.',
                'price' => 24000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Es teh manis segar.',
                'price' => 5000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Es jeruk segar.',
                'price' => 6000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
        ];

        foreach ($items as $item) {
            Menu::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
