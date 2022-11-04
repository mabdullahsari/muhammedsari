<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Events;

final readonly class PostWasPublished
{
    public function __construct(
        public int $id,
    ) {}
}
