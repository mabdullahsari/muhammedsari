<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            $this->group(['middleware' => 'web'], __DIR__ . '/../../routes/web.php');
        });
    }
}
