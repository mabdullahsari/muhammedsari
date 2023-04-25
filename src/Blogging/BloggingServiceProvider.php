<?php declare(strict_types=1);

namespace Blogging;

use Blogging\Models\Author;
use Blogging\Models\Post;
use Blogging\Models\PostObserver;
use Blogging\Models\PostPolicy;
use Blogging\Models\Tag;
use Blogging\Models\TagPolicy;
use Contract\Blogging\Command\PublishPost;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class BloggingServiceProvider extends ServiceProvider
{
    public array $singletons = [PostRepository::class => SQLitePostRepository::class];

    public function boot(): void
    {
        Post::observe(PostObserver::class);

        Relation::enforceMorphMap([
            'author' => Author::class,
            'post' => Post::class,
            'tag' => Tag::class,
        ]);
    }

    public function register(): void
    {
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
