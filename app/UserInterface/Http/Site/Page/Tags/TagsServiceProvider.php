<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Tags;

use App\UserInterface\Http\Site\View\Navigation;
use Illuminate\Routing\Router;
use Illuminate\Support\AggregateServiceProvider;

final class TagsServiceProvider extends AggregateServiceProvider
{
    public const NAME = 'Tags';

    protected $providers = [
        \Blogging\BloggingServiceProvider::class,
    ];

    public function boot(Router $router): void
    {
        Navigation::register(self::NAME, ViewTagsController::ROUTE);

        if (! $this->app->routesAreCached()) {
            $router->group([], $this->app->basePath('routes/tags.php'));
        }
    }
}
