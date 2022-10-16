<?php declare(strict_types=1);

namespace App\Web\Providers;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    /** @var array<int, string> */
    protected $providers = [
        RouteServiceProvider::class,
    ];
}
