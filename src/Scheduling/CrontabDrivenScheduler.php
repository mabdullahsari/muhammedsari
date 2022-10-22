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
        private readonly EntryRepository $entries,
    ) {}

    public function tick(): void
    {
        $this
            ->entries
            ->getBefore($this->clock->now())
            ->each($this->process(...));
    }

    private function process(Entry $entry): void
    {
        $this->entries->remove($entry);

        $this->commands->dispatch(PublishPost::make($entry->postId));
    }
}
