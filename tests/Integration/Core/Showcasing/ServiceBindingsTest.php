<?php declare(strict_types=1);

namespace Tests\Integration\Core\Showcasing;

use Core\Showcasing\Repository;
use Core\Showcasing\Resource;
use Core\Showcasing\ResourcePolicy;
use Core\Showcasing\SortingObserver;
use Core\Showcasing\RepositoryPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_models_into_morph_map(): void
    {
        $repository = Relation::getMorphedModel('repository');
        $resource = Relation::getMorphedModel('resource');

        $this->assertSame(Repository::class, $repository);
        $this->assertSame(Resource::class, $resource);
    }

    #[Test]
    public function it_registers_sorting_model_observers(): void
    {
        $events = $this->app->make('events');
        $repository = $events->getRawListeners()['eloquent.creating: ' . Repository::class];
        $resource = $events->getRawListeners()['eloquent.creating: ' . Resource::class];

        $this->assertContains(SortingObserver::class . '@creating', $repository);
        $this->assertContains(SortingObserver::class . '@creating', $resource);
    }

    #[Test]
    public function it_registers_policies_at_gate(): void
    {
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(RepositoryPolicy::class, $gate->getPolicyFor(Repository::class));
        $this->assertInstanceOf(ResourcePolicy::class, $gate->getPolicyFor(Resource::class));
    }
}
