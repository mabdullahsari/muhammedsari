<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Events;

final class PostWasDeleted
{
    public function __construct(
        public readonly int $id,
    ) {}
}
