<?php declare(strict_types=1);

namespace Tests\Integration\Core\Blogging;

use Core\Blogging\PostRepository;
use Core\Blogging\SQLitePostRepository;
use Tests\KernelTestCase;
use Tests\Unit\Core\Blogging\PostRepositoryContractTests;

final class SQLitePostRepositoryTest extends KernelTestCase
{
    use PostRepositoryContractTests;

    private function getInstance(): PostRepository
    {
        return new SQLitePostRepository($this->aClock(), $this->app['db.connection']);
    }
}
