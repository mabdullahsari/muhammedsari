<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Events;

use Dive\Utils\Makeable;

final class PostWasDeleted
{
    use Makeable;

    private function __construct(
        public readonly int $id,
    ) {}
}
