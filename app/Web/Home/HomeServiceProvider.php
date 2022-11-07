<?php declare(strict_types=1);

namespace App\Web\Home;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class HomeServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('/', [HomeController::class, 'index'])->middleware('web');
    }
}
