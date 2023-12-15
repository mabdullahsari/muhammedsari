<?php declare(strict_types=1);

namespace App\Http\Site\Page\About;

use App\Http\Site\View\Navigation;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public const string NAME = 'About';

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, AboutController::INDEX);

        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/about.php'));
        }
    }
}
