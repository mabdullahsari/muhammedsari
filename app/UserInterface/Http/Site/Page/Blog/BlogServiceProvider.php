<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Blog;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class BlogServiceProvider extends AggregateServiceProvider
{
    public const NAME = 'Blog';

    protected $providers = [
        \Blogging\BloggingServiceProvider::class,
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/blog.php'));
        }
    }
}
