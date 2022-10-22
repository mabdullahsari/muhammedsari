<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Events;

use Dive\Utils\Makeable;

final class PostWasPublished
{
    use Makeable;

    private function __construct(
        public readonly int $id,
    ) {}
}
