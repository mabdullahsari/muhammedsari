<?php declare(strict_types=1);

namespace Tests\Unit\Publishing\Twitter;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Testing\Fakes\EventFake;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Publishing\Contract\TweetSent;
use Publishing\PostUrlGenerator;
use Publishing\Twitter\ArrayTwitter;
use Publishing\Twitter\SendTweetAboutNewPost;

final class SendTweetAboutNewPostTest extends TestCase
{
    #[Test]
    public function it_can_send_a_tweet_about_a_newly_published_blog_post(): void
    {
        $command = new SendTweetAboutNewPost(1, 'this-is-a-test', [], 'This is a test');

        $command->handle($events = $this->aDispatcher(), $twitter = $this->aTwitter(), $this->aUrlGenerator());

        $this->assertCount(1, $twitter->outbox());
        $events->assertDispatched(TweetSent::class);
    }

    private function aDispatcher(): EventFake
    {
        return new EventFake(new Dispatcher());
    }

    private function aTwitter(): ArrayTwitter
    {
        return new ArrayTwitter();
    }

    private function aUrlGenerator(): PostUrlGenerator
    {
        return new PostUrlGenerator('https://localhost');
    }
}
