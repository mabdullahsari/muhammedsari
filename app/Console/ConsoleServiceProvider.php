<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,

        \App\Http\Web\WebServiceProvider::class,
        \App\Http\Filament\FilamentServiceProvider::class,

        \Blogging\BloggingServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,
    ];
}
