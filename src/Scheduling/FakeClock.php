<?php declare(strict_types=1);

namespace Domain\Scheduling;

use DateTimeImmutable;
use InvalidArgumentException;

final class FakeClock implements Clock
{
    private DateTimeImmutable $time;

    public function __construct(string $datetime)
    {
        $this->travelTo($datetime);
    }

    public function now(): DateTimeImmutable
    {
        return $this->time;
    }

    public function travelTo(string $datetime, string $format = 'Y-m-d H:i'): void
    {
        $time = DateTimeImmutable::createFromFormat($format, $datetime);

        if ($time === false) {
            throw new InvalidArgumentException("{$datetime}|{$format} is not a valid point in time.");
        }

        $this->time = $time;
    }
}
