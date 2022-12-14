<?php declare(strict_types=1);

namespace Tests\Feature;

use Carbon\CarbonImmutable;
use Database\Factories\PostFactory;
use Core\Blogging\PostState;
use Core\Contract\Blogging\Command\PublishPost;
use Core\Publishing\Twitter\Twitter;
use Illuminate\Support\Facades\Bus;
use Tests\KernelTestCase;

final class BlogPostPublishingTest extends KernelTestCase
{
    /** @test */
    public function test_user_can_publish_blog_post(): void
    {
        // Arrange
        $post = PostFactory::new()
            ->hasBody()
            ->hasSummary()
            ->createQuietly();

        $twitter = $this->app->make(Twitter::class);

        $this->assertSame(PostState::Draft, $post->state);

        // Act
        Bus::dispatch(new PublishPost($post->id));

        // Assert
        $this->assertSame(PostState::Published, $post->refresh()->state);
        $this->assertInstanceOf(CarbonImmutable::class, $post->published_at);

        $this->assertCount(1, $tweets = $twitter->outbox());

        $tweet = (string) $tweets[0];
        $this->assertStringContainsString($post->title, $tweet);
        $this->assertStringContainsString($post->slug, $tweet);
    }
}
