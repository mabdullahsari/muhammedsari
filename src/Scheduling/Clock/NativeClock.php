<?php declare(strict_types=1);

namespace Domain\Scheduling\Clock;

use Carbon\CarbonImmutable;
use DateTimeZone;

final class NativeClock implements Clock
{
    public function now(): CarbonImmutable
    {
        return new CarbonImmutable('now', new DateTimeZone('UTC'));
    }
}
