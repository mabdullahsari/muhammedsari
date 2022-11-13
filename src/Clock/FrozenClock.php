<?php declare(strict_types=1);

namespace Core\Clock;

use Carbon\CarbonImmutable;
use Core\Contract\Clock\Clock;
use Webmozart\Assert\Assert;

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

    public function travelTo(string $datetime, string $format = 'Y-m-d H:i:s'): void
    {
        $time = CarbonImmutable::createFromFormat($format, $datetime);

        Assert::isInstanceOf($time, CarbonImmutable::class);

        $this->time = $time;
    }
}
