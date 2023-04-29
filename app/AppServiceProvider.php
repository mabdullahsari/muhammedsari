<?php declare(strict_types=1);

namespace App;

use Illuminate\Support\AggregateServiceProvider;

final class AppServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \App\CommandBus\CommandBusServiceProvider::class,
        \App\Database\DatabaseServiceProvider::class,
    ];
}
