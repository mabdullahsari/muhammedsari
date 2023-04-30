<?php declare(strict_types=1);

namespace App\UI\Http\Site;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class SiteServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        \Publishing\PublishingServiceProvider::class,
        \Html\HtmlServiceProvider::class,

        \App\AppServiceProvider::class,
        \App\UI\Http\RouteServiceProvider::class,
        \App\UI\Http\Site\View\ViewServiceProvider::class,

        Page\About\AboutServiceProvider::class,
        Page\Blog\BlogServiceProvider::class,
        Page\Contact\ContactServiceProvider::class,
        Page\Home\HomeServiceProvider::class,
        Page\Tag\TagServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->feeds();
        }
    }
}
