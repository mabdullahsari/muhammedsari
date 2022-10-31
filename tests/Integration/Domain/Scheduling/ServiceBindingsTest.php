<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Scheduling;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Scheduling\Scheduler;
use Domain\Scheduling\CrontabDrivenScheduler;
use Domain\Scheduling\Models\Publication;
use Domain\Scheduling\Models\PublicationPolicy;
use Domain\Scheduling\PublicationRepository;
use Domain\Scheduling\RemoveScheduledPublication;
use Domain\Scheduling\SQLitePublicationRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(PublicationRepository::class));
        $this->assertInstanceOf(SQLitePublicationRepository::class, $this->app->make(PublicationRepository::class));

        $this->assertTrue($this->app->isShared(Scheduler::class));
        $this->assertInstanceOf(CrontabDrivenScheduler::class, $this->app->make(Scheduler::class));
    }

    /** @test */
    public function it_registers_listeners_for_blogging_events(): void
    {
        $events = $this->app->make(Dispatcher::class);
        $listeners = $events->getRawListeners();

        $deleted = $listeners[PostWasDeleted::class];
        $published = $listeners[PostWasPublished::class];

        $this->assertContains(RemoveScheduledPublication::class, $deleted);
        $this->assertContains(RemoveScheduledPublication::class, $published);
    }

    /** @test */
    public function it_registers_entry_policy_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(PublicationPolicy::class, $gate->getPolicyFor(Publication::class));
    }
}
