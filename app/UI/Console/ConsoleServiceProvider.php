<?php declare(strict_types=1);

namespace App\UI\Console;

use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,

        \App\AppServiceProvider::class,
        \App\UI\Http\Admin\AdminServiceProvider::class,
        \App\UI\Http\Site\SiteServiceProvider::class,

        \Blogging\BloggingServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,
    ];
}
