<?php declare(strict_types=1);

namespace Core\Blogging\Models;

use Core\Contracts\Blogging\Events\PostWasDeleted;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class PostObserver
{
    public function __construct(
        private Dispatcher $events,
    ) {}

    public function deleted(Post $post): void
    {
        $this->events->dispatch(
            new PostWasDeleted($post->id)
        );
    }
}
