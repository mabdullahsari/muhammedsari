<?php declare(strict_types=1);

namespace App\Http\Health;

use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class HealthServiceProvider extends AggregateServiceProvider
{
    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/health.php'));
        }
    }
}
