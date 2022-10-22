<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Listeners;

use Domain\Blogging\Contracts\Events\PostWasPublished;
use Domain\Publishing\Twitter\Builder\TweetBuilder;
use Domain\Publishing\Twitter\Contracts\Twitter;
use Domain\Publishing\Twitter\PostRepository;
use Domain\Publishing\UrlGenerator;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendTweetAboutNewPost implements ShouldQueue
{
    public function __construct(
        private readonly PostRepository $posts,
        private readonly Twitter $twitter,
        private readonly UrlGenerator $url,
    ) {}

    public function handle(PostWasPublished $event): void
    {
        $post = $this->posts->find($event->id);

        $tweet = TweetBuilder::create("I've just published")
            ->useEmoji('✍️')
            ->useTitle($post->title)
            ->useUrl($this->url->generate($post->slug))
            ->useTags($post->tags)
            ->toTweet();

        $this->twitter->send($tweet);
    }
}
