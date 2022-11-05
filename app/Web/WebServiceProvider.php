<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\Feed\FeedServiceProvider::class,
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,

        RouteServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->resolving('blade.compiler', $this->registerPageComponent(...));
    }

    private function registerPageComponent(BladeCompiler $blade): void
    {
        $blade->component(Page::class, 'page');
    }
}
