<?php declare(strict_types=1);

namespace App\Http\Web\Html;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class HtmlServiceProvider extends ServiceProvider
{
    public array $singletons = [
        HtmlBeautifier::class => HtmlBeautifierUsingDindent::class,
    ];

    public function boot(Router $router): void
    {
        $router->aliasMiddleware('html', BeautifyHtml::class);
    }

    public function register(): void
    {
        $this->app->alias(HtmlBeautifier::class, 'html');
    }
}
