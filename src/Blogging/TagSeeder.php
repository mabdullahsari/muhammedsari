<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;

final class TagSeeder extends Seeder
{
    public function run(SQLiteConnection $db): void
    {
        $db->table('blogging_tags')->insert([
            ['id' => 1, 'name' => 'CSS', 'slug' => 'css'],
            ['id' => 2, 'name' => 'JavaScript', 'slug' => 'javascript'],
            ['id' => 3, 'name' => 'Laravel', 'slug' => 'laravel'],
            ['id' => 4, 'name' => 'PHP', 'slug' => 'php'],
            ['id' => 5, 'name' => 'React', 'slug' => 'react'],
            ['id' => 6, 'name' => 'Tailwind', 'slug' => 'tailwind'],
        ]);
    }
}
