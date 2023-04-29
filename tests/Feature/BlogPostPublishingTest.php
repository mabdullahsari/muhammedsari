<?php declare(strict_types=1);

namespace Tests\Feature;

use Blogging\Contract\PublishPost;
use Blogging\Post;
use Blogging\PostState;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Bus;
use PHPUnit\Framework\Attributes\Test;
use Publishing\Twitter\Twitter;
use Tests\KernelTestCase;

final class BlogPostPublishingTest extends KernelTestCase
{
    #[Test]
    public function user_can_publish_blog_post(): void
    {
        // Arrange
        $post = Post::factory()->publishable()->createQuietly();

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
