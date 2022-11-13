<?php declare(strict_types=1);

namespace App\Web\Feature\Uses;

use Illuminate\Support\ServiceProvider;

final class UsesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'Uses');
    }
}
