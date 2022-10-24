<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Publishing;

use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Publishing\RSS\FeedRepository;
use Domain\Contracts\Publishing\Twitter\Twitter;
use Domain\Publishing\PostUrlGenerator;
use Domain\Publishing\RSS\SQLiteFeedRepository;
use Domain\Publishing\Twitter\Listeners\SendTweetAboutNewPost;
use Domain\Publishing\Twitter\PostRepository;
use Domain\Publishing\Twitter\SQLitePostRepository;
use Domain\Publishing\Twitter\TwitterManager;
use Domain\Publishing\UrlGenerator;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

final class ServiceBindingsTest extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $app = $this->createApplication();

        // Publishing
        $this->assertTrue($app->isShared(UrlGenerator::class));
        $this->assertInstanceOf(PostUrlGenerator::class, $app->make(UrlGenerator::class));

        // RSS
        $this->assertTrue($app->isShared(FeedRepository::class));
        $this->assertInstanceOf(SQLiteFeedRepository::class, $app->make(FeedRepository::class));

        // Twitter
        $this->assertTrue($app->isShared(PostRepository::class));
        $this->assertInstanceOf(SQLitePostRepository::class, $app->make(PostRepository::class));

        $this->assertTrue($app->isShared(Twitter::class));
        $this->assertInstanceOf(TwitterManager::class, $app->make(Twitter::class));
    }

    /** @test */
    public function it_registers_listeners_for_blogging_events(): void
    {
        $app = $this->createApplication();

        /** @var Dispatcher $events */
        $events = $app->make(Dispatcher::class);
        $listeners = $events->getRawListeners()[PostWasPublished::class];

        // Twitter
        $this->assertContains(SendTweetAboutNewPost::class, $listeners);
    }
}
