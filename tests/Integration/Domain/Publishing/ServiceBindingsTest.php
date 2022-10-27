<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing;

use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Publishing\RSS\FeedRepository;
use Domain\Publishing\PostUrlGenerator;
use Domain\Publishing\RSS\SQLiteFeedRepository;
use Domain\Publishing\Twitter\PostRepository;
use Domain\Publishing\Twitter\SendTweetAboutNewPost;
use Domain\Publishing\Twitter\SQLitePostRepository;
use Domain\Publishing\Twitter\Twitter;
use Domain\Publishing\Twitter\TwitterManager;
use Domain\Publishing\UrlGenerator;
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
        $this->assertTrue($this->app->isShared(FeedRepository::class));
        $this->assertInstanceOf(SQLiteFeedRepository::class, $this->app->make(FeedRepository::class));

        // Twitter
        $this->assertTrue($this->app->isShared(PostRepository::class));
        $this->assertInstanceOf(SQLitePostRepository::class, $this->app->make(PostRepository::class));

        $this->assertTrue($this->app->isShared(Twitter::class));
        $this->assertInstanceOf(TwitterManager::class, $this->app->make(Twitter::class));
    }

    /** @test */
    public function it_registers_listeners_for_blogging_events(): void
    {
        /** @var Dispatcher $events */
        $events = $this->app->make(Dispatcher::class);
        $listeners = $events->getRawListeners()[PostWasPublished::class];

        // Twitter
        $this->assertContains(SendTweetAboutNewPost::class, $listeners);
    }
}
