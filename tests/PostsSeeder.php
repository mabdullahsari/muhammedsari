<?php declare(strict_types=1);

namespace Tests;

use Illuminate\Database\Seeder;
use Illuminate\Database\SQLiteConnection;

final class PostsSeeder extends Seeder
{
    public function run(SQLiteConnection $db): void
    {
        $db->table('users')->insert([
            'id' => 1,
            'first_name' => 'Rick',
            'last_name' => 'Astley',
            'email' => 'rick@roll.com',
            'username' => 'rickastley',
            'password' => '1234567890',
            'timezone' => 'Europe/London',
        ]);

        $db->table('posts')->insert([
            'id' => 1,
            'author_id' => 1,
            'slug' => 'never-gonna-give-you-up',
            'title' => 'Never Gonna Give You Up',
            'body' => 'Lorem ipsum dolor sit amet.',
            'summary' => 'Lorem ipsum',
            'state' => 'published',
            'published_at' => '1970-01-01 00:00:00',
            'created_at' => '1970-01-01 00:00:00',
            'updated_at' => '1970-01-01 00:00:00',
        ]);

        $db->table('tags')->insert([
            ['id' => 1, 'name' => 'Rick', 'slug' => 'rick'],
            ['id' => 2, 'name' => 'Roll', 'slug' => 'roll'],
        ]);

        $db->table('post_tag')->insert([
            ['post_id' => 1, 'tag_id' => 1],
            ['post_id' => 1, 'tag_id' => 2],
        ]);
    }
}
