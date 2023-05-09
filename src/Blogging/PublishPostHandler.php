<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\PublishPost;
use Illuminate\Contracts\Events\Dispatcher;
use Psr\Clock\ClockInterface;

final readonly class PublishPostHandler
{
    public function __construct(
        private ClockInterface $clock,
        private Dispatcher $events,
        private Post $posts,
    ) {}

    public function handle(PublishPost $command): void
    {
        $post = $this->posts->find($command->id);

        $post->publish($this->clock);
        $post->save();

        [$event] = $post->flushEvents();
        $this->events->dispatch($event);
    }
}
