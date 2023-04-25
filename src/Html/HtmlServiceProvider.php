<?php declare(strict_types=1);

namespace Html;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class HtmlServiceProvider extends ServiceProvider
{
    public const NAME = 'html';

    public array $singletons = [HtmlBeautifier::class => HtmlBeautifierUsingDindent::class];

    public function boot(Router $router): void
    {
        $router->aliasMiddleware(self::NAME, BeautifyHtml::class);
    }

    public function register(): void
    {
        $this->app->alias(HtmlBeautifier::class, self::NAME);
    }
}