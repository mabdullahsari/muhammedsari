<?php declare(strict_types=1);

namespace Previewing;

use Illuminate\Support\ServiceProvider;
use Previewing\Contract\Previewer;

final class PreviewingServiceProvider extends ServiceProvider
{
    public const NAME = 'previewing';

    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, self::NAME);

        $this->app->singleton(Previewer::class, PreviewerUsingBrowsershot::class);

        $this->app
            ->when(PreviewerUsingBrowsershot::class)
            ->needs('$host')
            ->give(fn () => str_replace('https://', '', $this->app['config']['app.url']));

        $this->app->extend(Previewer::class,
            fn (Previewer $next) => new CachedPreviewer($next, $this->app['cache.store']->tags(self::NAME))
        );
    }
}
