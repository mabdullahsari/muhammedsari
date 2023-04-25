<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing\Twitter;

use Publishing\Twitter\PublishedPostProvider;
use Publishing\Twitter\SQLitePublishedPostProvider;
use Tests\KernelTestCase;
use Tests\PostSeeder;
use Tests\Unit\Core\Publishing\Twitter\PostProviderContractTests;

final class SQLitePostProviderTest extends KernelTestCase
{
    use PostProviderContractTests;

    protected bool $seed = true;

    protected string $seeder = PostSeeder::class;

    private function getInstance(): PublishedPostProvider
    {
        return new SQLitePublishedPostProvider($this->app['db.connection']);
    }
}
