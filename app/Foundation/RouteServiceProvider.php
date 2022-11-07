<?php declare(strict_types=1);

namespace App\Foundation;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    private array $web = [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ];

    public function boot(): void
    {
        $this->middlewareGroup('web', $this->web);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }
}
