<?php declare(strict_types=1);

namespace App\UserInterface\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

final class Kernel extends HttpKernel
{
    protected $middleware = [StripTrailingSlash::class];

    public function bootstrappers(): array
    {
        array_splice($this->bootstrappers, 4, 0, ConfigureHttpProviders::class);

        return $this->bootstrappers;
    }
}
