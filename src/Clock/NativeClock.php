<?php declare(strict_types=1);

namespace Domain\Clock;

use Carbon\CarbonImmutable;
use DateTimeZone;
use Domain\Contracts\Clock\Clock;

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
