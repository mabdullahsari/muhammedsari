<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\Twitter;

use Blogging\Contract\PostPublished;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Publishing\PostUrlGenerator;
use Publishing\Twitter\InMemoryPublishedPostProvider;
use Publishing\Twitter\InMemoryTwitter;
use Publishing\Twitter\PublishedPost;
use Publishing\Twitter\SendTweetAboutNewPost;

final class SendTweetAboutNewPostTest extends TestCase
{
    #[Test]
    public function it_can_send_a_tweet_about_a_newly_published_blog_post(): void
    {
        $listener = new SendTweetAboutNewPost(
            $this->aPostProvider($id = 123),
            $twitter = $this->aTwitter(),
            $this->aUrlGenerator(),
        );

        $listener->handle(new PostPublished($id));

        $this->assertCount(1, $twitter->outbox());
    }

    private function aPostProvider(int $id): InMemoryPublishedPostProvider
    {
        return new InMemoryPublishedPostProvider([
            $id => new PublishedPost('Unit Testing in PHP', 'unit-testing-in-php', ['php'])
        ]);
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
