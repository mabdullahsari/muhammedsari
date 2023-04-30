<?php declare(strict_types=1);

namespace App\UI\Http\Site\Page\Blog;

use App\UI\Http\Site\View\Components\Navigation;
use Illuminate\Support\AggregateServiceProvider;

final class BlogServiceProvider extends AggregateServiceProvider
{
    public const NAME = 'Blog';

    protected $providers = [
        \Blogging\BloggingServiceProvider::class,
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(): void
    {
        Navigation::register(self::NAME, GetMyPostsController::ROUTE, 1);
    }

    public function register(): void
    {
        parent::register();

        $this->loadViewsFrom(__DIR__, self::NAME);
    }
}
