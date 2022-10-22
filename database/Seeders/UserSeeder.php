<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public function run(ConnectionInterface $db): void
    {
        $db->table('users')->insert([
            'id' => 1,
            'email' => 'hi@muhammedsari.me',
            'first_name' => 'Muhammed',
            'last_name' => 'Sari',
            'password' => '$2y$10$sh2vvZLfwoT60pnup/8zceQLo/93o2IzNdtrXJ.WUKPsoX2TSmPXm',
            'timezone' => 'Europe/Brussels',
            'username' => 'mabdullahsari',
        ]);
    }
}
