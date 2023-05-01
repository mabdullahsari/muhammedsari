<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\About;

use App\UserInterface\Http\Site\View\Components\Navigation;
use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public const NAME = 'About';

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, AboutController::INDEX, 0);

        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::MIDDLEWARE)->group($this->app->basePath('routes/about.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}
