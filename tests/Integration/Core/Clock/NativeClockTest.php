<?php declare(strict_types=1);

namespace Tests\Integration\Core\Clock;

use Clock\NativeClock;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NativeClockTest extends TestCase
{
    #[Test]
    public function it_can_get_now_from_the_system_clock(): void
    {
        $clock = new NativeClock('Europe/Brussels');

        $before = new DateTimeImmutable();
        usleep(5);
        $now = $clock->now();
        usleep(5);
        $after = new DateTimeImmutable();

        $this->assertGreaterThan($before, $now);
        $this->assertLessThan($after, $now);
    }

    #[Test]
    public function it_does_not_accept_an_invalid_timezone(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown or bad timezone (OMG)');

        new NativeClock('OMG');
    }
}
