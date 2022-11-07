<?php declare(strict_types=1);

namespace App\Web\About;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('about', [AboutController::class, 'index'])->middleware('web');
    }
}
