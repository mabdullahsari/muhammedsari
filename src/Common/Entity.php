<?php declare(strict_types=1);

namespace Core\Common;

abstract class Entity
{
    private array $events = [];

    private bool $wasRecentlyCreated = true;

    public function flushEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    public function markAsPersisted(): static
    {
        $this->wasRecentlyCreated = false;

        return $this;
    }

    public function wasRecentlyCreated(): bool
    {
        return $this->wasRecentlyCreated;
    }

    protected function raise(object $event): void
    {
        $this->events[] = $event;
    }
}
