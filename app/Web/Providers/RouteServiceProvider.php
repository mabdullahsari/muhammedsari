<?php declare(strict_types=1);

namespace App\Web\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        $this->loadRoutesFrom($this->app->basePath('routes/web.php'));
    }
}
