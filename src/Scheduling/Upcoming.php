<?php declare(strict_types=1);

namespace Scheduling;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Builder;

final readonly class Upcoming
{
    public function __construct(private DateTimeImmutable $now) {}

    public function __invoke(Builder $builder): void
    {
        $builder->where('publish_at', '<', $this->now);
    }
}
