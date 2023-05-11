<?php declare(strict_types=1);

namespace App;

use Illuminate\Support\AggregateServiceProvider;

final class AppServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \App\CommandBus\CommandBusServiceProvider::class,
        \App\Database\DatabaseServiceProvider::class,
        \App\Exceptions\ExceptionServiceProvider::class,
        \App\Health\HealthServiceProvider::class,
        \App\Queue\QueueServiceProvider::class,
    ];
}
