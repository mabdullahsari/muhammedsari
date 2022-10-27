<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Blogging;

use Domain\Blogging\PostRepository;
use Domain\Blogging\SQLitePostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\KernelTestCase;
use Tests\Unit\Domain\Blogging\PostRepositoryContractTests;

final class SQLitePostRepositoryTest extends KernelTestCase
{
    use PostRepositoryContractTests;
    use RefreshDatabase;

    private function getInstance(): PostRepository
    {
        return new SQLitePostRepository($this->aClock(), $this->app['db.connection']);
    }
}
