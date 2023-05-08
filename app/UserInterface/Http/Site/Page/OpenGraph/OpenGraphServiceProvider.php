<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\OpenGraph;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class OpenGraphServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Previewing\PreviewingServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/open-graph.php'));
        }
    }
}
