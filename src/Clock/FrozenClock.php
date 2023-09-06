<?php declare(strict_types=1);

namespace Clock;

use Clock\Contract\Clock;
use DateTimeImmutable;
use Webmozart\Assert\Assert;

final class FrozenClock implements Clock
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
