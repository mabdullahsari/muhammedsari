<?php declare(strict_types=1);

namespace Domain\Common;

trait HasEvents
{
    private array $events = [];

    public function flushEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    protected function raise(object $event): void
    {
        $this->events[] = $event;
    }
}
