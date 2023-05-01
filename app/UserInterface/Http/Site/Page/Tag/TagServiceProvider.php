<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Tag;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class TagServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/tag.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Tag');
    }
}
