<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\InMemoryPostProvider;
use Domain\Publishing\Twitter\Post;
use Domain\Publishing\Twitter\PostProvider;
use PHPUnit\Framework\TestCase;

final class InMemoryPostProviderTest extends TestCase
{
    use PostProviderContractTests;

    private function getInstance(): PostProvider
    {
        return new InMemoryPostProvider([
            1 => new Post('Never Gonna Give You Up', 'never-gonna-give-you-up', ['rick', 'roll']),
        ]);
    }
}
