<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Contracts\Commands\PublishPost;
use Domain\Blogging\Contracts\Events\PostWasPublished;
use Domain\Blogging\Exceptions\CouldNotFindPost;
use Illuminate\Contracts\Events\Dispatcher;

final class PublishPostHandler
{
    public function __construct(
        private readonly Dispatcher $events,
        private readonly Post $model,
    ) {}

    public function handle(PublishPost $command): void
    {
        /** @var Post $post */
        $post = $this->model
            ->newQuery()
            ->findOr($command->id, fn () => CouldNotFindPost::withId($command->id));

        $post->publish();

        $this->events->dispatch(PostWasPublished::make($post));
    }
}
