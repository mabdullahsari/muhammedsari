<?php declare(strict_types=1);

namespace App\Http\Web\Feature\OSS;

use Illuminate\Support\ServiceProvider;

final class OSSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__, 'OSS');
    }
}
