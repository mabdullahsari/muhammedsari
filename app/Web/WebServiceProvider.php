<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Illuminate\Foundation\Support\Providers\RouteServiceProvider::class,
        \Spatie\Feed\FeedServiceProvider::class,
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(): void
    {
        $this->loadRoutesFrom($this->app->basePath('routes/web.php'));
    }
}
