<?php declare(strict_types=1);

namespace Tests\Integration\Core\Clock;

use Carbon\CarbonImmutable;
use Core\Clock\NativeClock;
use Exception;
use PHPUnit\Framework\TestCase;

final class NativeClockTest extends TestCase
{
    /** @test */
    public function it_can_get_now_from_the_system_clock(): void
    {
        $clock = new NativeClock('Europe/Brussels');

        $before = new CarbonImmutable();
        usleep(5);
        $now = $clock->now();
        usleep(5);
        $after = new CarbonImmutable();

        $this->assertGreaterThan($before, $now);
        $this->assertLessThan($after, $now);
    }

    /** @test */
    public function it_does_not_accept_an_invalid_timezone(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown or bad timezone (OMG)');

        new NativeClock('OMG');
    }
}
