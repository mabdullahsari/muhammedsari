<?php declare(strict_types=1);

namespace HtmlBeautifier;

use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class HtmlBeautifierServiceProvider extends ServiceProvider
{
    public array $singletons = [HtmlBeautifier::class => HtmlBeautifierUsingDindent::class];

    public function boot(Router $router): void
    {
        $router->aliasMiddleware(BeautifyHtml::MIDDLEWARE, BeautifyHtmlDocument::class);
    }
}
