<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Listeners;

use Domain\Blogging\Contracts\Events\PostWasPublished;
use Domain\Publishing\Twitter\Contracts\Tweet;
use Domain\Publishing\Twitter\Contracts\Twitter;
use Domain\Publishing\UrlGenerator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

final class SendTweetAboutNewPost implements ShouldQueue
{
    private const CONTENT = "✍️ I've just published: \"%title%\"\n\n%url%";

    public function __construct(
        private readonly Twitter $twitter,
        private readonly UrlGenerator $url,
    ) {}

    public function handle(PostWasPublished $event): void
    {
        $tweet = $this->createTweet($event->slug(), $event->title());

        $this->twitter->send($tweet);
    }

    private function createTweet(string $slug, string $title): Tweet
    {
        $message = Str::of(self::CONTENT)
            ->replace('%title%', $title)
            ->replace('%url%', $this->url->generate($slug))
            ->value();

        return Tweet::make($message);
    }
}
