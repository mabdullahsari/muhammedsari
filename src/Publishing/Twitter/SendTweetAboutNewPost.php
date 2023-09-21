<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Publishing\Twitter\Contract\TweetSent;
use Publishing\UrlGenerator;

final readonly class SendTweetAboutNewPost implements ShouldQueue
{
    use Dispatchable;

    public function __construct(private int $id, private string $slug, private array $tags, private string $title) {}

    public function handle(Dispatcher $events, Twitter $twitter, UrlGenerator $url): void
    {
        $tweet = TweetBuilder::create("I've just published")
            ->useEmoji('✍️')
            ->useTitle($this->title)
            ->useUrl($url->generate($this->slug))
            ->useHashtags($this->tags)
            ->get();

        $url = $twitter->send($tweet);

        $events->dispatch(new TweetSent($this->id, (string) $url));
    }
}
