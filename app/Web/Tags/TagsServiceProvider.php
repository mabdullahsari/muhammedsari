<?php declare(strict_types=1);

namespace App\Web\Tags;

use Core\Blogging\Slug;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class TagsServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('tags/{slug}', [TagController::class, 'show'])->middleware('web')->where('slug', Slug::PATTERN);
        $router->get('tags', [TagController::class, 'index'])->middleware('web');
    }
}
