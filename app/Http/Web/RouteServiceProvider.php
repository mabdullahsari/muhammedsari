<?php declare(strict_types=1);

namespace App\Http\Web;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->feeds();
    }
}
