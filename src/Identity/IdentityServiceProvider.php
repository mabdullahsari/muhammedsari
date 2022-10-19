<?php declare(strict_types=1);

namespace Domain\Identity;

use Domain\Identity\Access\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class IdentityServiceProvider extends ServiceProvider
{
    private array $policyMap = [
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        Relation::enforceMorphMap(['user' => User::class]);
    }

    public function register(): void
    {
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerPolicies(Gate $access): void
    {
        foreach ($this->policyMap as $model => $policy) {
            $access->policy($model, $policy);
        }
    }
}
