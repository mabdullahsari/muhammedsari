<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging;

use Core\Blogging\InMemoryPostRepository;
use Core\Blogging\PostRepository;
use PHPUnit\Framework\TestCase;

final class InMemoryPostRepositoryTest extends TestCase
{
    use PostRepositoryContractTests;

    private function getInstance(): PostRepository
    {
        return new InMemoryPostRepository();
    }
}
