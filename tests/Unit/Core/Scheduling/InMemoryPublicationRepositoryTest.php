<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use Core\Scheduling\InMemoryPublicationRepository;
use Core\Scheduling\Publication;
use Core\Scheduling\PublicationRepository;
use PHPUnit\Framework\TestCase;

final class InMemoryPublicationRepositoryTest extends TestCase
{
    use PublicationRepositoryContractTests;

    private function getInstance(): PublicationRepository
    {
        return new InMemoryPublicationRepository([
            1 => new Publication(1, 1453, $this->date('2022-10-30')),
            2 => new Publication(2, 1454, $this->date('2022-10-29')),
            3 => new Publication(3, 1455, $this->date('2022-10-28')),
            4 => new Publication(4, 1456, $this->date('2022-10-27')),
        ]);
    }
}
