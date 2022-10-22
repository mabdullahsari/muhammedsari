<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use Dive\Utils\Makeable;

final class Entry
{
    use Makeable;

    private function __construct(
        public readonly int $id,
        public readonly int $postId,
        public readonly CarbonImmutable $publishAt,
    ) {}
}
