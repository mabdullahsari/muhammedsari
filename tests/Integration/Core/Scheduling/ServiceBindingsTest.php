<?php declare(strict_types=1);

namespace Tests\Integration\Core\Scheduling;

use Core\Contract\Blogging\Event\PostWasDeleted;
use Core\Contract\Blogging\Event\PostWasPublished;
use Core\Contract\Scheduling\Scheduler;
use Core\Scheduling\CrontabDrivenScheduler;
use Core\Scheduling\Models\Publication;
use Core\Scheduling\Models\PublicationPolicy;
use Core\Scheduling\PublicationRepository;
use Core\Scheduling\RemoveScheduledPublication;
use Core\Scheduling\SQLitePublicationRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\Attributes\Test;
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

        $deleted = $listeners[PostWasDeleted::class];
        $published = $listeners[PostWasPublished::class];

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
