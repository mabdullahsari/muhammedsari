<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\Twitter;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Publishing\PostUrlGenerator;
use Publishing\Twitter\ArrayTwitter;
use Publishing\Twitter\SendTweetAboutNewPost;

final class SendTweetAboutNewPostTest extends TestCase
{
    #[Test]
    public function it_can_send_a_tweet_about_a_newly_published_blog_post(): void
    {
        $command = new SendTweetAboutNewPost('this-is-a-test', [], 'This is a test');

        $command->handle($twitter = $this->aTwitter(), $this->aUrlGenerator());

        $this->assertCount(1, $twitter->outbox());
    }

    private function aUrlGenerator(): PostUrlGenerator
    {
        return new PostUrlGenerator('https://localhost');
    }

    private function aTwitter(): ArrayTwitter
    {
        return new ArrayTwitter();
    }
}
