<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Contracts\Clock\Clock;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class PublishPostHandler
{
    public function __construct(
        private Clock $clock,
        private Dispatcher $events,
        private PostRepository $posts,
    ) {}

    public function handle(PublishPost $command): void
    {
        $post = $this->posts->find(PostId::fromInt($command->id));

        $post->publish($this->clock);

        $this->posts->save($post);

        [$event] = $post->flushEvents();
        $this->events->dispatch($event);
    }
}
