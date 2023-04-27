<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Bus\Dispatcher as CommandBus;
use Illuminate\Contracts\Events\Dispatcher as EventBus;

final readonly class BloggingSubscriber
{
    public function __construct(private CommandBus $commands) {}

    public function subscribe(EventBus $events): void
    {
        $events->listen(PostPublished::class, $this->whenPostPublished(...));
    }

    private function whenPostPublished(PostPublished $event): void
    {
        $this->commands->dispatch(
            new SendTweetAboutNewPost($event->slug, $event->tags, $event->title)
        );
    }
}
