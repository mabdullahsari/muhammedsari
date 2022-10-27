<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Contracts\Clock\Clock;
use Illuminate\Contracts\Events\Dispatcher;

final class PublishPostHandler
{
    public function __construct(
        private readonly Clock $clock,
        private readonly Dispatcher $events,
        private readonly PostRepository $posts,
    ) {}

    public function handle(PublishPost $command): void
    {
        $post = $this->posts->find($command->id);

        $post->publish($this->clock);

        $this->posts->save($post);

        [$event] = $post->flushEvents();
        $this->events->dispatch($event);
    }
}
