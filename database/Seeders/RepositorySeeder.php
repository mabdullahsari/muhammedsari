<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;

final class RepositorySeeder extends Seeder
{
    public function run(SQLiteConnection $db): void
    {
        $db->table('repositories')->insert([
            [
                'id' => 1,
                'name' => 'muhammedsari',
                'description' => 'The source code of this very website - built with Laravel.',
                'url' => 'https://github.com/mabdullahsari/muhammedsari',
                'sort' => 1,
            ],
            [
                'id' => 2,
                'name' => 'laravel-expo-channel',
                'description' => 'Expo / React Native notifications channel for Laravel.',
                'url' => 'https://github.com/dive-be/laravel-expo-channel',
                'sort' => 2,
            ],
            [
                'id' => 3,
                'name' => 'php-enum-utils',
                'description' => 'Some utilities you always need when dealing with native enumerations in PHP.',
                'url' => 'https://github.com/dive-be/php-enum-utils',
                'sort' => 3,
            ],
            [
                'id' => 4,
                'name' => 'laravel-dry-requests',
                'description' => "The inspiration source for, the now built-in, Laravel Precognition.",
                'url' => 'https://github.com/dive-be/laravel-dry-requests',
                'sort' => 4,
            ],
            [
                'id' => 5,
                'name' => 'laravel-fez',
                'description' => 'No-nonsense, (almost) zero config document head manager.',
                'url' => 'https://github.com/dive-be/laravel-fez',
                'sort' => 5,
            ],
            [
                'id' => 6,
                'name' => 'laravel-wishlist',
                'description' => 'Multipotent wishlist management.',
                'url' => 'https://github.com/dive-be/laravel-wishlist',
                'sort' => 6,
            ],
            [
                'id' => 7,
                'name' => 'php-crowbar',
                'description' => 'Accessor for class properties with a restrictive access modifier.',
                'url' => 'https://github.com/dive-be/php-crowbar',
                'sort' => 7,
            ],
            [
                'id' => 8,
                'name' => 'laravel-snowflake',
                'description' => 'Identity generator using Twitter Snowflake.',
                'url' => 'https://github.com/dive-be/laravel-snowflake',
                'sort' => 8,
            ],
            [
                'id' => 9,
                'name' => 'eloquent-utils',
                'description' => 'Declarative Eloquent utilities for an improved DX.',
                'url' => 'https://github.com/dive-be/eloquent-utils',
                'sort' => 9,
            ],
            [
                'id' => 10,
                'name' => 'laravel-geo',
                'description' => 'Geolocation translator.',
                'url' => 'https://github.com/dive-be/laravel-geo',
                'sort' => 10,
            ],
            [
                'id' => 11,
                'name' => 'eloquent-super',
                'description' => 'Lightweight MTI support for Eloquent models.',
                'url' => 'https://github.com/dive-be/eloquent-super',
                'sort' => 11,
            ],
        ]);
    }
}
