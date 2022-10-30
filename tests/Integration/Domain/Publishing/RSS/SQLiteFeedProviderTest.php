<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing\RSS;

use Domain\Contracts\Publishing\RSS\FeedProvider;
use Domain\Publishing\PostUrlGenerator;
use Domain\Publishing\RSS\FeedItemMapper;
use Domain\Publishing\RSS\SQLiteFeedProvider;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\KernelTestCase;
use Tests\Unit\Domain\Publishing\RSS\FeedProviderContractTests;

final class SQLiteFeedProviderTest extends KernelTestCase
{
    use FeedProviderContractTests;
    use RefreshDatabase;

    private function getInstance(): FeedProvider
    {
        return new SQLiteFeedProvider($this->setUpDatabase(),
            new FeedItemMapper(new PostUrlGenerator('https://localhost'))
        );
    }

    private function setUpDatabase(): SQLiteConnection
    {
        $db = $this->app['db.connection'];

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
            'slug' => 'integration-testing',
            'title' => 'Integration Testing',
            'body' => 'Lorem ipsum dolor sit amet.',
            'summary' => 'Lorem ipsum',
            'state' => 'published',
            'published_at' => '1970-01-01 00:00:00',
            'created_at' => '1970-01-01 00:00:00',
            'updated_at' => '1970-01-01 00:00:00',
        ]);

        return $db;
    }
}
