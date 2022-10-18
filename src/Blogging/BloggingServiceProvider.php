<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class BloggingServiceProvider extends ServiceProvider
{
    private array $morphMap = [
        'author' => Author::class,
        'post' => Post::class,
        'tag' => Tag::class,
    ];

    private array $policyMap = [
        Post::class => PostPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    public function boot(): void
    {
        Relation::enforceMorphMap($this->morphMap);
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
