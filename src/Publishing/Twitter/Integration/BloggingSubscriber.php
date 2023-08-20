<?php declare(strict_types=1);

namespace Publishing\Twitter\Integration;

use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Events\Dispatcher;
use Publishing\Twitter\SendTweetAboutNewPost;

final readonly class BloggingSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(PostPublished::class, $this->whenPostPublished(...));
    }

    private function whenPostPublished(PostPublished $event): void
    {
        SendTweetAboutNewPost::dispatch($event->id, $event->slug, $event->tags, $event->title);
    }
}
