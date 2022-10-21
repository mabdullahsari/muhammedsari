<?php declare(strict_types=1);

namespace Domain\Blogging;

use Domain\Blogging\Access\PostPolicy;
use Domain\Blogging\Access\TagPolicy;
use Domain\Blogging\Contracts\Commands\PublishPost;
use Domain\Blogging\Handlers\PublishPostHandler;
use Domain\Blogging\Models\Author;
use Domain\Blogging\Models\Post;
use Domain\Blogging\Models\Tag;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class BloggingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'author' => Author::class,
            'post' => Post::class,
            'tag' => Tag::class,
        ]);
    }

    public function register(): void
    {
        $this->app->resolving(Dispatcher::class, $this->registerSubscribers(...));
        $this->app->resolving(Gate::class, $this->registerPolicies(...));
    }

    private function registerSubscribers(Dispatcher $bus): void
    {
        $bus->map([
            PublishPost::class => PublishPostHandler::class,
        ]);
    }

    private function registerPolicies(Gate $access): void
    {
        $access->policy(Post::class, PostPolicy::class);
        $access->policy(Tag::class, TagPolicy::class);
    }
}
