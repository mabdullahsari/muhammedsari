<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class SiteServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Publishing\PublishingServiceProvider::class,

        \App\AppServiceProvider::class,
        \App\UserInterface\Http\RouteServiceProvider::class,
        \App\UserInterface\Http\Site\View\ViewServiceProvider::class,

        Page\About\AboutServiceProvider::class,
        Page\Tags\TagsServiceProvider::class,
        Page\Contact\ContactServiceProvider::class,
        Page\OpenGraph\OpenGraphServiceProvider::class,
        Page\Blog\BlogServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->feeds();
        }
    }
}
