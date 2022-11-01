<?php declare(strict_types=1);

namespace Domain\Showcasing;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class ShowcasingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Repository::observe(RepositoryObserver::class);

        Relation::enforceMorphMap(['repository' => Repository::class]);
    }

    public function register(): void
    {
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Repository::class, RepositoryPolicy::class);
    }
}
