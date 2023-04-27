<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Illuminate\Contracts\Queue\ShouldQueue;
use Publishing\UrlGenerator;

final readonly class SendTweetAboutNewPost implements ShouldQueue
{
    public function __construct(private string $slug, private array $tags, private string $title) {}

    public function handle(Twitter $twitter, UrlGenerator $url): void
    {
        $tweet = TweetBuilder::create("I've just published")
            ->useEmoji('✍️')
            ->useTitle($this->title)
            ->useUrl($url->generate($this->slug))
            ->useHashtags($this->tags)
            ->get();

        $twitter->send($tweet);
    }
}
