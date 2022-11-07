<?php declare(strict_types=1);

namespace Tests\Integration\Core\Publishing;

use Core\Contracts\Blogging\Events\PostWasPublished;
use Core\Contracts\Publishing\RSS\FeedProvider;
use Core\Publishing\PostUrlGenerator;
use Core\Publishing\RSS\SQLiteFeedProvider;
use Core\Publishing\Twitter\PublishedPostProvider;
use Core\Publishing\Twitter\SendTweetAboutNewPost;
use Core\Publishing\Twitter\SQLitePublishedPostProvider;
use Core\Publishing\Twitter\Twitter;
use Core\Publishing\Twitter\TwitterManager;
use Core\Publishing\UrlGenerator;
use Illuminate\Contracts\Events\Dispatcher;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
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

    /** @test */
    public function it_registers_listeners_for_blogging_events(): void
    {
        $events = $this->app->make(Dispatcher::class);
        $listeners = $events->getRawListeners()[PostWasPublished::class];

        // Twitter
        $this->assertContains(SendTweetAboutNewPost::class, $listeners);
    }
}
