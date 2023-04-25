<?php declare(strict_types=1);

namespace Clock;

use Carbon\CarbonImmutable;
use Clock\Contract\Clock;
use DateTimeZone;

final readonly class NativeClock implements Clock
{
    private DateTimeZone $timezone;

    public function __construct(string $timezone)
    {
        $this->timezone = new DateTimeZone($timezone);
    }

    public function now(): CarbonImmutable
    {
        return new CarbonImmutable('now', $this->timezone);
    }
}
