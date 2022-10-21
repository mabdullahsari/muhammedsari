<?php declare(strict_types=1);

namespace Domain\Clock;

use Carbon\CarbonImmutable;
use DateTimeZone;
use Domain\Clock\Contracts\Clock;

final class NativeClock implements Clock
{
    private readonly DateTimeZone $timezone;

    public function __construct(string $timezone)
    {
        $this->timezone = new DateTimeZone($timezone);
    }

    public function now(): CarbonImmutable
    {
        return new CarbonImmutable('now', $this->timezone);
    }
}
