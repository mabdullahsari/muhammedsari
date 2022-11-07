<?php declare(strict_types=1);

namespace App\Web\OSS;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\ServiceProvider;

final class OpenSourceServiceProvider extends ServiceProvider
{
    public function boot(Registrar $router): void
    {
        $router->get('oss', [OpenSourceController::class, 'index'])->middleware('web');
    }
}
