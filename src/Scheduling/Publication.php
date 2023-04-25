<?php declare(strict_types=1);

namespace Scheduling;

use Carbon\CarbonImmutable;

final readonly class Publication
{
    public function __construct(
        public int $id,
        public int $postId,
        public CarbonImmutable $publishAt,
    ) {}
}
