<?php declare(strict_types=1);

namespace Blogging\Models;

use Contract\Blogging\Event\PostWasDeleted;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class PostObserver
{
    public function __construct(private Dispatcher $events) {}

    public function deleted(Post $post): void
    {
        $this->events->dispatch(
            new PostWasDeleted($post->id)
        );
    }
}
