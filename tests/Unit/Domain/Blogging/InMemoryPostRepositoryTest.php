<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\InMemoryPostRepository;
use Domain\Blogging\PostRepository;
use PHPUnit\Framework\TestCase;

final class InMemoryPostRepositoryTest extends TestCase
{
    use PostRepositoryContractTests;

    private function getInstance(): PostRepository
    {
        return new InMemoryPostRepository();
    }
}
