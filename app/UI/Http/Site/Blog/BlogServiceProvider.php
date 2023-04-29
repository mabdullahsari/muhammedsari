<?php declare(strict_types=1);

namespace App\UI\Http\Site\Blog;

use Illuminate\Support\AggregateServiceProvider;

final class BlogServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__, 'Blog');
    }
}
