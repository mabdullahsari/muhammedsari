<?php declare(strict_types=1);

namespace App\Web\OSS;

use Illuminate\Support\ServiceProvider;

final class OSSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'OSS');
    }
}
