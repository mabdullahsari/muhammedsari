<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\Twitter;

use Core\Publishing\Twitter\InMemoryPublishedPostProvider;
use Core\Publishing\Twitter\PublishedPost;
use Core\Publishing\Twitter\PublishedPostProvider;
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
