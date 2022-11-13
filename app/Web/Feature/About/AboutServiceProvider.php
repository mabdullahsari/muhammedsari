<?php declare(strict_types=1);

namespace App\Web\Feature\About;

use Illuminate\Support\ServiceProvider;

final class AboutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'About');
    }
}
