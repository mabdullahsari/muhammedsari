<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\InMemoryPublishedPostProvider;
use Domain\Publishing\Twitter\PublishedPost;
use Domain\Publishing\Twitter\PublishedPostProvider;
use PHPUnit\Framework\TestCase;

final class InMemoryPostProviderTest extends TestCase
{
    use PostProviderContractTests;

    private function getInstance(): PublishedPostProvider
    {
        return new InMemoryPublishedPostProvider([
            1 => new PublishedPost('Never Gonna Give You Up', 'never-gonna-give-you-up', ['rick', 'roll']),
        ]);
    }
}
