<?php declare(strict_types=1);

namespace Tests\Integration\Core\Clock;

use Clock\Contract\Clock;
use Clock\NativeClock;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(Clock::class));
        $this->assertInstanceOf(NativeClock::class, $this->app->make(Clock::class));
    }
}
