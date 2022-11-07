<?php declare(strict_types=1);

namespace App\Web\Blog;

use Core\Blogging\Slug;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class BlogServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('blog/{slug}', [PostController::class, 'show'])->middleware('web')->where('slug', Slug::PATTERN);
        $router->get('blog', [PostController::class, 'index'])->middleware('web');
    }
}
