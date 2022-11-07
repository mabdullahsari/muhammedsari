<?php declare(strict_types=1);

namespace App\Foundation;

use Illuminate\Support\AggregateServiceProvider;

final class FoundationServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\Feed\FeedServiceProvider::class,

        BusServiceProvider::class,
        HealthServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
