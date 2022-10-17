<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(ConnectionInterface $db): void
    {
        $db->table('users')->insert([
            'id' => 1,
            'email' => 'hello@muhammedsari.me',
            'first_name' => 'Muhammed',
            'last_name' => 'Sari',
            'password' => '$2y$10$TyAyNugEKR8Fh9dokkPhTusxPu1g7kCiw6A4PLlv6jeYBA15jHDLO',
        ]);
    }
}
