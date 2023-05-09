<?php declare(strict_types=1);

namespace Tests\Unit\Core\Clock;

use Clock\FrozenClock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FrozenClockTest extends TestCase
{
    #[Test]
    public function it_returns_a_fixed_now(): void
    {
        $clock = new FrozenClock($dateTime = '2022-10-26 00:20:00');

        $result = $clock->now();
        $this->assertSame($dateTime, $result->format('Y-m-d H:i:s'));

        $clock->travelTo($dateTime = '2030-01-01 01:23:45');
        $result = $clock->now();
        $this->assertSame($dateTime, $result->format('Y-m-d H:i:s'));
    }
}
