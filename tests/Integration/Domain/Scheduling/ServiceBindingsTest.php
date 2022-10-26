<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Scheduling;

use Domain\Contracts\Blogging\Events\PostWasDeleted;
use Domain\Contracts\Blogging\Events\PostWasPublished;
use Domain\Contracts\Scheduling\Scheduler;
use Domain\Scheduling\Access\PublicationPolicy;
use Domain\Scheduling\CrontabDrivenScheduler;
use Domain\Scheduling\PublicationRepository;
use Domain\Scheduling\Listeners\RemoveScheduledPublication;
use Domain\Scheduling\Models\Publication;
use Domain\Scheduling\SQLitePublicationRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

final class ServiceBindingsTest extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_registers_singleton_bindings(): void
    {
        $app = $this->createApplication();

        $this->assertTrue($app->isShared(PublicationRepository::class));
        $this->assertInstanceOf(SQLitePublicationRepository::class, $app->make(PublicationRepository::class));

        $this->assertTrue($app->isShared(Scheduler::class));
        $this->assertInstanceOf(CrontabDrivenScheduler::class, $app->make(Scheduler::class));
    }

    /** @test */
    public function it_registers_listeners_for_blogging_events(): void
    {
        $app = $this->createApplication();

        /** @var Dispatcher $events */
        $events = $app->make(Dispatcher::class);
        $listeners = $events->getRawListeners();

        $deleted = $listeners[PostWasDeleted::class];
        $published = $listeners[PostWasPublished::class];

        $this->assertContains(RemoveScheduledPublication::class, $deleted);
        $this->assertContains(RemoveScheduledPublication::class, $published);
    }

    /** @test */
    public function it_registers_entry_policy_at_gate(): void
    {
        $app = $this->createApplication();

        /** @var Gate $gate */
        $gate = $app->make(Gate::class);

        $this->assertInstanceOf(PublicationPolicy::class, $gate->getPolicyFor(Publication::class));
    }
}
