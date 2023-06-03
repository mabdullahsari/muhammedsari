<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,

        \Blogging\BloggingServiceProvider::class,
        \Contacting\ContactingServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \Notifying\NotifyingServiceProvider::class,
        \PreservingData\PreservingDataServiceProvider::class,
        \Previewing\PreviewingServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,

        \App\AppServiceProvider::class,
        \App\Http\Admin\AdminServiceProvider::class,
        \App\Http\Horizon\HorizonServiceProvider::class,
        \App\Http\Site\SiteServiceProvider::class,
    ];
}
