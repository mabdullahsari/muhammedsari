<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Publishing\UrlGenerator;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendTweetAboutNewPost implements ShouldQueue
{
    public function __construct(
        private readonly PublishedPostProvider $posts,
        private readonly Twitter $twitter,
        private readonly UrlGenerator $url,
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
