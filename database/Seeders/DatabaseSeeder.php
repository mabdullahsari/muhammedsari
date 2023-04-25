<?php declare(strict_types=1);

namespace Database\Seeders;

use Blogging\TagSeeder;
use Identity\UserSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TagSeeder::class,
            UserSeeder::class,
        ]);
    }
}
