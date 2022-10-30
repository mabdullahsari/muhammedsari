<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Publishing\Twitter;

use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Publishing\PostUrlGenerator;
use Domain\Publishing\Twitter\InMemoryPostProvider;
use Domain\Publishing\Twitter\InMemoryTwitter;
use Domain\Publishing\Twitter\Post;
use Domain\Publishing\Twitter\SendTweetAboutNewPost;
use PHPUnit\Framework\TestCase;

final class SendTweetAboutNewPostTest extends TestCase
{
    /** @test */
    public function it_can_send_a_tweet_about_a_newly_published_blog_post(): void
    {
        $listener = new SendTweetAboutNewPost(
            $this->aPostProvider($id = 123),
            $twitter = $this->aTwitter(),
            $this->aUrlGenerator(),
        );

        $listener->handle(new PostWasPublished($id));

        $this->assertCount(1, $twitter->outbox());
    }

    private function aPostProvider(int $id): InMemoryPostProvider
    {
        return new InMemoryPostProvider([$id => new Post('Unit Testing in PHP', 'unit-testing-in-php', ['php'])]);
    }

    private function aUrlGenerator(): PostUrlGenerator
    {
        return new PostUrlGenerator('https://localhost');
    }

    private function aTwitter(): InMemoryTwitter
    {
        return new InMemoryTwitter();
    }
}
