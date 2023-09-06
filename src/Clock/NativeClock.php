<?php declare(strict_types=1);

namespace Clock;

use Clock\Contract\Clock;
use DateTimeImmutable;
use DateTimeZone;

final readonly class NativeClock implements Clock
{
    private DateTimeZone $timezone;

    public function __construct(string $timezone)
    {
        $this->timezone = new DateTimeZone($timezone);
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->timezone);
    }
}
