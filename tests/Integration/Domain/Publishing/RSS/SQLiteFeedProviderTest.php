<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing\RSS;

use Domain\Contracts\Publishing\RSS\FeedProvider;
use Domain\Publishing\PostUrlGenerator;
use Domain\Publishing\RSS\FeedItemMapper;
use Domain\Publishing\RSS\SQLiteFeedProvider;
use Tests\KernelTestCase;
use Tests\PostsSeeder;
use Tests\Unit\Domain\Publishing\RSS\FeedProviderContractTests;

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
