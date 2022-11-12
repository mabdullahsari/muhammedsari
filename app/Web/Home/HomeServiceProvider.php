<?php declare(strict_types=1);

namespace App\Web\Home;

use Illuminate\Support\ServiceProvider;

final class HomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Home');
    }
}
