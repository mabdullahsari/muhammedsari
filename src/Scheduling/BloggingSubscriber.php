<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class BloggingSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(PostDeleted::class, $this->whenPostDeleted(...));
        $events->listen(PostPublished::class, $this->whenPostPublished(...));
    }

    protected function whenPostDeleted(PostDeleted $event): void
    {
        RemoveScheduledPublication::dispatch($event->id);
    }

    protected function whenPostPublished(PostPublished $event): void
    {
        RemoveScheduledPublication::dispatch($event->id);
    }
}
