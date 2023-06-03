<?php declare(strict_types=1);

namespace App;

use Illuminate\Support\AggregateServiceProvider;

final class AppServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \CommandBus\CommandBusServiceProvider::class,
        \Database\DatabaseServiceProvider::class,
        \Queue\QueueServiceProvider::class,
    ];
}
