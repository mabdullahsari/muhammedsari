<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Contract\GetAllTags;
use Blogging\Contract\GetMyPosts;
use Blogging\Contract\GetMyPostsByTag;
use Blogging\Contract\GetSinglePost;
use Blogging\Contract\GetSingleTag;
use Blogging\Contract\PublishPost;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\AggregateServiceProvider;

final class BloggingServiceProvider extends AggregateServiceProvider
{
    public array $singletons = [
        GetAllTags::class => GetAllTagsUsingEloquent::class,
        GetMyPosts::class => GetMyPostsUsingEloquent::class,
        GetMyPostsByTag::class => GetMyPostsByTagUsingEloquent::class,
        GetSinglePost::class => GetSinglePostUsingEloquent::class,
        GetSingleTag::class => GetSingleTagUsingEloquent::class,
    ];

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

        $this->app->resolving(Dispatcher::class, $this->registerHandlers(...));
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
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
