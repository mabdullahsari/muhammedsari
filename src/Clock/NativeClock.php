<?php declare(strict_types=1);

namespace Domain\Clock;

use Carbon\CarbonImmutable;

final class NativeClock implements Clock
{
    public function __construct(
        private readonly string $timezone,
    ) {}

    public function now(): CarbonImmutable
    {
        return new CarbonImmutable('now', $this->timezone);
    }
}
