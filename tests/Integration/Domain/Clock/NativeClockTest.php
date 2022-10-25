<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Clock;

use Domain\Clock\NativeClock;
use PHPUnit\Framework\TestCase;

final class NativeClockTest extends TestCase
{
    /** @test */
    public function it_returns_the_system_time(): void
    {
        $clock = new NativeClock('UTC');

        $resultA = $clock->now();
        $resultB = $clock->now();

        $this->assertTrue($resultA->lessThan($resultB));
    }
}
