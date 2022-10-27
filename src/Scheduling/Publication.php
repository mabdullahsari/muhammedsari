<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;

final class Publication
{
    public function __construct(
        public readonly int $id,
        public readonly int $postId,
        public readonly CarbonImmutable $publishAt,
    ) {}
}
