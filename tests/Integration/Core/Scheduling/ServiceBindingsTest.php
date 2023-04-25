<?php declare(strict_types=1);

namespace Tests\Integration\Core\Scheduling;

use Blogging\Contract\PostDeleted;
use Blogging\Contract\PostPublished;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\Attributes\Test;
use Scheduling\Contract\Scheduler;
use Scheduling\CrontabDrivenScheduler;
use Scheduling\Models\Publication;
use Scheduling\Models\PublicationPolicy;
use Scheduling\PublicationRepository;
use Scheduling\RemoveScheduledPublication;
use Scheduling\SQLitePublicationRepository;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_singleton_bindings(): void
    {
        $this->assertTrue($this->app->isShared(PublicationRepository::class));
        $this->assertInstanceOf(SQLitePublicationRepository::class, $this->app->make(PublicationRepository::class));

        $this->assertTrue($this->app->isShared(Scheduler::class));
        $this->assertInstanceOf(CrontabDrivenScheduler::class, $this->app->make(Scheduler::class));
    }

    #[Test]
    public function it_registers_listeners_for_blogging_events(): void
    {
        $events = $this->app->make(Dispatcher::class);
        $listeners = $events->getRawListeners();

        $deleted = $listeners[PostDeleted::class];
        $published = $listeners[PostPublished::class];

        $this->assertContains(RemoveScheduledPublication::class, $deleted);
        $this->assertContains(RemoveScheduledPublication::class, $published);
    }

    #[Test]
    public function it_registers_entry_policy_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(PublicationPolicy::class, $gate->getPolicyFor(Publication::class));
    }
}
