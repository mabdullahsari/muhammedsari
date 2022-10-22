<?php declare(strict_types=1);

namespace Domain\Blogging\Contracts\Events;

use Dive\Utils\Makeable;

final class PostWasPublished
{
    use Makeable;

    private function __construct(
        public readonly int $id,
    ) {}

    public function slug(): string
    {
        return 'wip';
    }

    public function title(): string
    {
        return 'wip';
    }
}
