<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\InMemoryTwitter;
use Domain\Publishing\Twitter\LogTwitter;
use Domain\Publishing\Twitter\TwitterManager;
use Domain\Publishing\Twitter\TwitterOAuth2;
use Tests\KernelTestCase;

final class TwitterManagerTest extends KernelTestCase
{
    /**
     * @dataProvider concretions
     * @test
     */
    public function it_can_create_the_drivers(string $driver, string $implementation): void
    {
        $manager = new TwitterManager($this->app);

        $instance = $manager->driver($driver);

        $this->assertInstanceOf($implementation, $instance); // @phpstan-ignore-line
    }

    private function concretions(): array
    {
        return [
            ['array', InMemoryTwitter::class],
            ['log', LogTwitter::class],
            ['oauth2', TwitterOAuth2::class],
        ];
    }
}
