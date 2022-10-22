<?php declare(strict_types=1);

namespace Domain\Common\Model;

trait HasEvents
{
    private array $events = [];

    public function flushEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    private function raise(object $event): void
    {
        $this->events[] = $event;
    }
}
