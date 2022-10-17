<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Seeder;

final class TagSeeder extends Seeder
{
    public function run(ConnectionInterface $db): void
    {
        $db->table('tags')->insert([
            ['id' => 1, 'name' => 'CSS', 'slug' => 'css'],
            ['id' => 2, 'name' => 'JavaScript', 'slug' => 'javascript'],
            ['id' => 3, 'name' => 'Laravel', 'slug' => 'laravel'],
            ['id' => 4, 'name' => 'PHP', 'slug' => 'php'],
            ['id' => 5, 'name' => 'React', 'slug' => 'react'],
            ['id' => 6, 'name' => 'Tailwind', 'slug' => 'tailwind'],
        ]);
    }
}
