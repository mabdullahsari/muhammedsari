<?php declare(strict_types=1);

namespace Clock;

use DateTimeImmutable;
use Psr\Clock\ClockInterface;
use Webmozart\Assert\Assert;

final class FrozenClock implements ClockInterface
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

    public function travelTo(string $datetime, string $format = 'Y-m-d H:i:s'): void
    {
        $time = DateTimeImmutable::createFromFormat($format, $datetime);

        Assert::isInstanceOf($time, DateTimeImmutable::class);

        $this->time = $time;
    }
}
