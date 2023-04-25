<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing\RSS;

use Contract\Publishing\RSS\FeedProvider;
use Publishing\PostUrlGenerator;
use Publishing\RSS\FeedItemMapper;
use Publishing\RSS\SQLiteFeedProvider;
use Tests\KernelTestCase;
use Tests\PostSeeder;
use Tests\Unit\Core\Publishing\RSS\FeedProviderContractTests;

final class SQLiteFeedProviderTest extends KernelTestCase
{
    use FeedProviderContractTests;

    protected bool $seed = true;

    protected string $seeder = PostSeeder::class;

    private function getInstance(): FeedProvider
    {
        return new SQLiteFeedProvider($this->app['db.connection'],
            new FeedItemMapper(new PostUrlGenerator('https://localhost'))
        );
    }
}
