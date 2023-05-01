<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Blog;

use App\UserInterface\Http\Site\View\Navigation;
use HtmlBeautifier\Contract\BeautifyHtml;
use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class BlogServiceProvider extends AggregateServiceProvider
{
    public const NAME = 'Blog';

    protected $providers = [
        \Blogging\BloggingServiceProvider::class,
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, ViewBlogController::ROUTE, 1);

        if (! $this->app->routesAreCached()) {
            $router->middleware(BeautifyHtml::MIDDLEWARE)->group($this->app->basePath('routes/blog.php'));
        }
    }
}
