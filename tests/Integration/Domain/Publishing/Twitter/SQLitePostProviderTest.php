<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\PostProvider;
use Domain\Publishing\Twitter\SQLitePostProvider;
use Tests\KernelTestCase;
use Tests\PostsSeeder;
use Tests\Unit\Domain\Publishing\Twitter\PostProviderContractTests;

final class SQLitePostProviderTest extends KernelTestCase
{
    use PostProviderContractTests;

    protected bool $seed = true;

    protected string $seeder = PostsSeeder::class;

    private function getInstance(): PostProvider
    {
        return new SQLitePostProvider($this->app['db.connection']);
    }
}
