<?php declare(strict_types=1);

namespace App\Web\Uses;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class UsesServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('uses', [UsesController::class, 'index'])->middleware('web');
    }
}
