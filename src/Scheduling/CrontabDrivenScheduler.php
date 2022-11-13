<?php declare(strict_types=1);

namespace Core\Scheduling;

use Core\Contract\Blogging\Command\PublishPost;
use Core\Contract\Clock\Clock;
use Core\Contract\Scheduling\Scheduler;
use Illuminate\Contracts\Bus\Dispatcher;

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
