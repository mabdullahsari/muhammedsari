<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\About;

use App\UI\Http\Site\View\Components\Navigation;
use Html\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public const NAME = 'About';

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, AboutController::INDEX, 0);

        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::NAME)->group($this->app->basePath('routes/about.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}
