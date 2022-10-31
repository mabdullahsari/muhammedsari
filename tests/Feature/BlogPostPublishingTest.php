<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\PostFactory;
use Domain\Blogging\Models\Post;
use Domain\Blogging\PostState;
use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Publishing\Twitter\InMemoryTwitter;
use Domain\Publishing\Twitter\Twitter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Tests\KernelTestCase;

final class BlogPostPublishingTest extends KernelTestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_publish_blog_post(): void
    {
        /** @var Post $post */
        $post = PostFactory::new()->createQuietly();

        /** @var InMemoryTwitter $twitter */
        $twitter = $this->app->make(Twitter::class);

        $this->assertSame(PostState::Draft, $post->state);

        // Act
        Bus::dispatch(new PublishPost($post->id));

        // Assert
        $this->assertSame(PostState::Published, $post->refresh()->state);
        $this->assertInstanceOf(Carbon::class, $post->published_at);

        $this->assertCount(1, $tweets = $twitter->outbox());

        $tweet = (string) $tweets[0];
        $this->assertStringContainsString($post->title, $tweet);
        $this->assertStringContainsString($post->slug, $tweet);
    }
}
