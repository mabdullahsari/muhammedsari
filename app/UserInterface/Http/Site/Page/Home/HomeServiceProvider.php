<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Home;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class HomeServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/home.php'));
        }
    }
}
