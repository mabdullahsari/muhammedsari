<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Contract\Blogging\Event\PostWasPublished;
use Publishing\UrlGenerator;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class SendTweetAboutNewPost implements ShouldQueue
{
    public function __construct(
        private PublishedPostProvider $posts,
        private Twitter $twitter,
        private UrlGenerator $url,
    ) {}

    public function handle(PostWasPublished $event): void
    {
        $post = $this->posts->getById($event->id);

        $tweet = TweetBuilder::create("I've just published")
            ->useEmoji('✍️')
            ->useTitle($post->title)
            ->useUrl($this->url->generate($post->slug))
            ->useHashtags($post->tags)
            ->get();

        $this->twitter->send($tweet);
    }
}
