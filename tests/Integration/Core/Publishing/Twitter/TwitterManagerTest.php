<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing\Twitter;

use Core\Publishing\Twitter\InMemoryTwitter;
use Core\Publishing\Twitter\LogTwitter;
use Core\Publishing\Twitter\TwitterManager;
use Core\Publishing\Twitter\TwitterOAuth2;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class TwitterManagerTest extends KernelTestCase
{
    #[DataProvider('concretions')]
    #[Test]
    public function it_can_create_the_drivers(string $driver, string $implementation): void
    {
        $manager = new TwitterManager($this->app);

        $instance = $manager->driver($driver);

        $this->assertInstanceOf($implementation, $instance);
    }

    public static function concretions(): array
    {
        return [
            ['array', InMemoryTwitter::class],
            ['log', LogTwitter::class],
            ['oauth2', TwitterOAuth2::class],
        ];
    }
}
