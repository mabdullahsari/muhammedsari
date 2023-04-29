<?php declare(strict_types=1);

namespace App\UI\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

final class Kernel extends HttpKernel
{
    protected $middleware = [StripTrailingSlash::class];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ],
    ];

    public function bootstrappers(): array
    {
        array_splice($this->bootstrappers, 4, 0, LoadHttpProvider::class);

        return $this->bootstrappers;
    }
}
