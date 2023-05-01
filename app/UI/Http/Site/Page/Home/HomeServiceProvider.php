<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Home;

use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class HomeServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::MIDDLEWARE)->group($this->app->basePath('routes/home.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Home');
    }
}
