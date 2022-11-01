<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Showcasing;

use Domain\Showcasing\Repository;
use Domain\Showcasing\RepositoryObserver;
use Domain\Showcasing\RepositoryPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
    public function it_registers_models_into_morph_map(): void
    {
        $repository = Relation::getMorphedModel('repository');

        $this->assertSame(Repository::class, $repository);
    }

    /** @test */
    public function it_registers_a_repository_model_observer(): void
    {
        $events = $this->app->make('events');
        $listeners = $events->getRawListeners()['eloquent.creating: ' . Repository::class];

        $this->assertContains(RepositoryObserver::class . '@creating', $listeners);
    }

    /** @test */
    public function it_registers_policies_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(RepositoryPolicy::class, $gate->getPolicyFor(Repository::class));
    }
}
