<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Access\PostPolicy;
use Domain\Blogging\Access\TagPolicy;
use Domain\Blogging\Contracts\Commands\PublishPost;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
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

    private array $subscriptionMap = [
        PublishPost::class => PublishPostHandler::class,
    ];

    public function boot(): void
    {
        Relation::enforceMorphMap($this->morphMap);
    }

    public function register(): void
    {
        $this->app->resolving(Dispatcher::class, $this->registerSubscribers(...));
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerSubscribers(Dispatcher $bus): void
    {
        $bus->map($this->subscriptionMap);
    }

    private function registerPolicies(Gate $access): void
    {
        foreach ($this->policyMap as $model => $policy) {
            $access->policy($model, $policy);
        }
    }
}
