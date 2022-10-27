<?php declare(strict_types=1);

namespace Domain\Common;

trait Persistable
{
    protected bool $wasRecentlyCreated = true;

    public function markAsPersisted(): static
    {
        $this->wasRecentlyCreated = false;

        return $this;
    }

    public function wasRecentlyCreated(): bool
    {
        return $this->wasRecentlyCreated;
    }
}
