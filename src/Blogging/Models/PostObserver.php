<?php declare(strict_types=1);

namespace Blogging\Models;

use Blogging\Contract\PostDeleted;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class PostObserver
{
    public function __construct(private Dispatcher $events) {}

    public function deleted(Post $post): void
    {
        $this->events->dispatch(
            new PostDeleted($post->id)
        );
    }
}
