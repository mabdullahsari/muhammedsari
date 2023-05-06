<?php declare(strict_types=1);

namespace SharedKernel;

trait RecordsEvents
{
    private array $pendingEvents = [];

    public function flushEvents(): array
    {
        $events = $this->pendingEvents;

        $this->pendingEvents = [];

        return $events;
    }

    private function recordThat(object $event): void
    {
        $this->pendingEvents[] = $event;
    }
}
