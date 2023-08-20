<?php declare(strict_types=1);

namespace Scheduling\Integration;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Events\Dispatcher;
use Scheduling\CancelPublication;

final readonly class BloggingSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(PostDeleted::class, $this->whenPostDeleted(...));
        $events->listen(PostPublished::class, $this->whenPostPublished(...));
    }

    protected function whenPostDeleted(PostDeleted $event): void
    {
        CancelPublication::dispatch($event->id);
    }

    protected function whenPostPublished(PostPublished $event): void
    {
        CancelPublication::dispatch($event->id);
    }
}
