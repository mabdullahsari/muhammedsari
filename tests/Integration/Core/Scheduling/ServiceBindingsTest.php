<?php declare(strict_types=1);

namespace Tests\Integration\Core\Scheduling;

use Illuminate\Contracts\Auth\Access\Gate;
use PHPUnit\Framework\Attributes\Test;
use Scheduling\Contract\Scheduler;
use Scheduling\CrontabScheduler;
use Scheduling\Publication;
use Scheduling\PublicationPolicy;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(Scheduler::class));
        $this->assertInstanceOf(CrontabScheduler::class, $this->app->make(Scheduler::class));
    }

    #[Test]
    public function it_registers_entry_policy_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(PublicationPolicy::class, $gate->getPolicyFor(Publication::class));
    }
}
