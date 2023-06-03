<?php declare(strict_types=1);

namespace App\Http\Site;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class SiteServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \App\AppServiceProvider::class,
        \App\Http\RouteServiceProvider::class,

        \Publishing\PublishingServiceProvider::class,

        \App\Http\Site\View\ViewServiceProvider::class,
        \App\Http\Site\Page\About\AboutServiceProvider::class,
        \App\Http\Site\Page\Tags\TagsServiceProvider::class,
        \App\Http\Site\Page\Contact\ContactServiceProvider::class,
        \App\Http\Site\Page\Blog\BlogServiceProvider::class,

        \App\Http\Site\OpenGraph\OpenGraphServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->feeds();
        }
    }
}
