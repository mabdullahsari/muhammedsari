<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing;

use PHPUnit\Framework\Attributes\Test;
use Publishing\Contract\FeedProvider;
use Publishing\PostUrlGenerator;
use Publishing\RSS\SQLiteFeedProvider;
use Publishing\Twitter\Twitter;
use Publishing\Twitter\TwitterManager;
use Publishing\UrlGenerator;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_singleton_bindings(): void
    {
        // Publishing
        $this->assertTrue($this->app->isShared(UrlGenerator::class));
        $this->assertInstanceOf(PostUrlGenerator::class, $this->app->make(UrlGenerator::class));

        // RSS
        $this->assertTrue($this->app->isShared(FeedProvider::class));
        $this->assertInstanceOf(SQLiteFeedProvider::class, $this->app->make(FeedProvider::class));

        // Twitter
        $this->assertTrue($this->app->isShared(Twitter::class));
        $this->assertInstanceOf(TwitterManager::class, $this->app->make(Twitter::class));
    }
}
