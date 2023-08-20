<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetAllTags;
use Blogging\Contract\GetMyPosts;
use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\GetPostTitle;
use Blogging\Contract\GetSinglePost;
use Blogging\Contract\GetSingleTag;
use Blogging\Contract\PublishPost;
use Blogging\Integration\PublishingSubscriber;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\AggregateServiceProvider;

final class BloggingServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Clock\ClockServiceProvider::class,
    ];

    public function boot(): void
    {
        $this->app['events']->subscribe(PublishingSubscriber::class);

        Post::observe(PostObserver::class);
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton(PostQueryBus::class, $this->createPostQueryBus(...));
        $this->app->alias(PostQueryBus::class, GetMyPosts::class);
        $this->app->alias(PostQueryBus::class, GetMyPostsByTag::class);
        $this->app->alias(PostQueryBus::class, GetPostTitle::class);
        $this->app->alias(PostQueryBus::class, GetSinglePost::class);

        $this->app->singleton(TagQueryBus::class, $this->createTagQueryBus(...));
        $this->app->alias(TagQueryBus::class, GetAllTags::class);
        $this->app->alias(TagQueryBus::class, GetSingleTag::class);

        $this->app->resolving(Dispatcher::class, $this->registerHandlers(...));
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function createPostQueryBus(): PostQueryBusUsingEloquent
    {
        return new PostQueryBusUsingEloquent(Post::query());
    }

    private function createTagQueryBus(): TagQueryBusUsingEloquent
    {
        return new TagQueryBusUsingEloquent(Tag::query());
    }

    private function registerHandlers(Dispatcher $commands): void
    {
        $commands->map([
            PublishPost::class => PublishPostHandler::class,
        ]);
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Post::class, PostPolicy::class);
        $access->policy(Tag::class, TagPolicy::class);
    }
}
