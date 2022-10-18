<?php declare(strict_types=1);

namespace App\Foundation\Providers;

use Illuminate\Support\AggregateServiceProvider;

final class FoundationServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Illuminate\Foundation\Support\Providers\RouteServiceProvider::class,

        HealthServiceProvider::class,
    ];
}
