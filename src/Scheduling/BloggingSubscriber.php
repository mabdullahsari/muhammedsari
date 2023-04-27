<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Bus\Dispatcher as CommandBus;
use Illuminate\Contracts\Events\Dispatcher as EventBus;

final readonly class BloggingSubscriber
{
    public function __construct(private CommandBus $commands) {}

    public function subscribe(EventBus $events): void
    {
        $events->listen(PostDeleted::class, $this->whenPostDeleted(...));
        $events->listen(PostPublished::class, $this->whenPostPublished(...));
    }

    protected function whenPostDeleted(PostDeleted $event): void
    {
        $this->commands->dispatch(
            new RemoveScheduledPublication($event->id)
        );
    }

    protected function whenPostPublished(PostPublished $event): void
    {
        $this->commands->dispatch(
            new RemoveScheduledPublication($event->id)
        );
    }
}
