<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Tag;

use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class TagServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::MIDDLEWARE)->group($this->app->basePath('routes/tag.php'));
        }
    }

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Tag');
    }
}
