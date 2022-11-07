<?php declare(strict_types=1);

namespace Core\Blogging;

use Core\Blogging\Models\Author;
use Core\Blogging\Models\Post;
use Core\Blogging\Models\PostObserver;
use Core\Blogging\Models\PostPolicy;
use Core\Blogging\Models\Tag;
use Core\Blogging\Models\TagPolicy;
use Core\Contracts\Blogging\Commands\PublishPost;
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
