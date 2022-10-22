<?php declare(strict_types=1);

namespace Domain\Blogging\Models\Observers;

use Domain\Blogging\Models\Post;
use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Illuminate\Contracts\Events\Dispatcher;

final class PostObserver
{
    public function __construct(
        private readonly Dispatcher $events,
    ) {}

    public function deleted(Post $post): void
    {
        $this->events->dispatch(
            PostWasDeleted::make($post->id)
        );
    }
}
