<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing\RSS;

use Core\Contract\Publishing\RSS\FeedProvider;
use Core\Publishing\PostUrlGenerator;
use Core\Publishing\RSS\FeedItemMapper;
use Core\Publishing\RSS\SQLiteFeedProvider;
use Tests\KernelTestCase;
use Tests\PostsSeeder;
use Tests\Unit\Core\Publishing\RSS\FeedProviderContractTests;

final class SQLiteFeedProviderTest extends KernelTestCase
{
    use FeedProviderContractTests;

    protected bool $seed = true;

    protected string $seeder = PostsSeeder::class;

    private function getInstance(): FeedProvider
    {
        return new SQLiteFeedProvider($this->app['db.connection'],
            new FeedItemMapper(new PostUrlGenerator('https://localhost'))
        );
    }
}
