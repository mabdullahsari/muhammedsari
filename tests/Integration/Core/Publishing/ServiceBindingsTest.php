<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing;

use Contract\Blogging\Event\PostWasPublished;
use Contract\Publishing\RSS\FeedProvider;
use Publishing\PostUrlGenerator;
use Publishing\RSS\SQLiteFeedProvider;
use Publishing\Twitter\PublishedPostProvider;
use Publishing\Twitter\SendTweetAboutNewPost;
use Publishing\Twitter\SQLitePublishedPostProvider;
use Publishing\Twitter\Twitter;
use Publishing\Twitter\TwitterManager;
use Publishing\UrlGenerator;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\Attributes\Test;
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
        $this->assertTrue($this->app->isShared(PublishedPostProvider::class));
        $this->assertInstanceOf(SQLitePublishedPostProvider::class, $this->app->make(PublishedPostProvider::class));

        $this->assertTrue($this->app->isShared(Twitter::class));
        $this->assertInstanceOf(TwitterManager::class, $this->app->make(Twitter::class));
    }

    #[Test]
    public function it_registers_listeners_for_blogging_events(): void
    {
        $events = $this->app->make(Dispatcher::class);
        $listeners = $events->getRawListeners()[PostWasPublished::class];

        // Twitter
        $this->assertContains(SendTweetAboutNewPost::class, $listeners);
    }
}
