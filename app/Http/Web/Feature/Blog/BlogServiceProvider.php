<?php declare(strict_types=1);

namespace App\Http\Web\Feature\Blog;

use Illuminate\Support\AggregateServiceProvider;

final class BlogServiceProvider extends AggregateServiceProvider
{
    public array $bindings = [
        GetMyPosts::class => GetMyPostsUsingEloquent::class,
        GetSinglePost::class => GetSinglePostUsingEloquent::class,
    ];

    protected $providers = [
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__, 'Blog');
    }
}
