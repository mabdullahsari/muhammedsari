<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Clock;

use Domain\Clock\NativeClock;
use Domain\Contracts\Clock\Clock;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(Clock::class));
        $this->assertInstanceOf(NativeClock::class, $this->app->make(Clock::class));
    }
}
