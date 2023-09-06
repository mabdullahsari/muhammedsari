<?php declare(strict_types=1);

namespace Scheduling;

use Blogging\Contract\PublishPost;
use Clock\Contract\Clock;
use Illuminate\Contracts\Bus\Dispatcher;
use Scheduling\Contract\Scheduler;

final readonly class CrontabScheduler implements Scheduler
{
    public function __construct(
        private Clock $clock,
        private Dispatcher $commands,
        private Publication $publications,
    ) {}

    public function tick(): void
    {
        $this->publications
            ->getUpcomingPosts($this->clock->now())
            ->mapInto(PublishPost::class)
            ->each($this->commands->dispatch(...));
    }
}
