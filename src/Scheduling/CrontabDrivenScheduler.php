<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Contracts\Blogging\Commands\PublishPost;
use Domain\Contracts\Clock\Clock;
use Domain\Contracts\Scheduling\Scheduler;
use Illuminate\Contracts\Bus\Dispatcher;

final class CrontabDrivenScheduler implements Scheduler
{
    public function __construct(
        private readonly Clock $clock,
        private readonly Dispatcher $commands,
        private readonly PublicationRepository $publications,
    ) {}

    public function tick(): void
    {
        $this->publications->getDue(
            $this->clock->now()
        )->each(
            $this->publishPost(...)
        );
    }

    private function publishPost(Publication $publication): void
    {
        $this->commands->dispatch(
            new PublishPost($publication->postId)
        );
    }
}
