<?php declare(strict_types=1);

namespace Domain\Scheduling\Clock;

use DateTimeImmutable;
use DateTimeZone;

final class NativeClock implements Clock
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable(timezone: new DateTimeZone('UTC'));
    }
}
