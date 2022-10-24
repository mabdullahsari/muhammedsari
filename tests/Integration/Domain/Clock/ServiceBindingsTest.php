<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Clock;

use Domain\Clock\NativeClock;
use Domain\Contracts\Clock\Clock;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

final class ServiceBindingsTest extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $app = $this->createApplication();

        $this->assertTrue($app->isShared(Clock::class));
        $this->assertInstanceOf(NativeClock::class, $app->make(Clock::class));
    }
}
