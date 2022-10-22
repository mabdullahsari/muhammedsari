<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Domain\Blogging\Contracts\Commands\PublishPost;
use Domain\Clock\Contracts\Clock;
use Illuminate\Contracts\Bus\Dispatcher;

final class Scheduler
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
