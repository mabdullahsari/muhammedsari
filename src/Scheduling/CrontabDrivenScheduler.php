<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PublishPost;
use Clock\Contract\Clock;
use Illuminate\Contracts\Bus\Dispatcher;
use Scheduling\Contract\Scheduler;

final readonly class CrontabDrivenScheduler implements Scheduler
{
    public function __construct(
        private Clock $clock,
        private Dispatcher $commands,
        private PublicationRepository $publications,
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
