<?php declare(strict_types=1);

namespace Domain\Clock;

use Carbon\CarbonImmutable;
use Domain\Contracts\Clock\Clock;
use InvalidArgumentException;

final class FrozenClock implements Clock
{
    private CarbonImmutable $time;

    public function __construct(string $datetime)
    {
        $this->travelTo($datetime);
    }

    public function now(): CarbonImmutable
    {
        return $this->time;
    }

    public function travelTo(string $datetime, string $format = 'Y-m-d H:i'): void
    {
        $time = CarbonImmutable::createFromFormat($format, $datetime);

        if ($time === false) {
            throw new InvalidArgumentException("{$datetime}|{$format} is not a valid point in time.");
        }

        $this->time = $time;
    }
}