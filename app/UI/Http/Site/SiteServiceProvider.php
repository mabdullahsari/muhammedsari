<?php declare(strict_types=1);

namespace App\UI\Http\Site;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class SiteServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        \App\AppServiceProvider::class,
        \Blogging\BloggingServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Html\HtmlServiceProvider::class,

        \App\UI\Http\RouteServiceProvider::class,
        \App\UI\Http\Site\About\AboutServiceProvider::class,
        \App\UI\Http\Site\Blog\BlogServiceProvider::class,
        \App\UI\Http\Site\Home\HomeServiceProvider::class,
        \App\UI\Http\Site\Tag\TagServiceProvider::class,
        \App\UI\Http\Site\View\ViewServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->feeds();
        }
    }
}
