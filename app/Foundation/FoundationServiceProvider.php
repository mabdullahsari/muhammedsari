<?php declare(strict_types=1);

namespace App\Foundation;

use App\Foundation\Bus\BusServiceProvider;
use App\Foundation\Health\HealthServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

final class FoundationServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Illuminate\Foundation\Support\Providers\RouteServiceProvider::class,

        BusServiceProvider::class,
        HealthServiceProvider::class,
    ];
}
