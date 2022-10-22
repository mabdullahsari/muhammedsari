<?php declare(strict_types=1);

namespace Domain\Blogging\Handlers;

use Domain\Blogging\Contracts\Commands\PublishPost;
use Domain\Blogging\PostRepository;
use Domain\Clock\Contracts\Clock;
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
