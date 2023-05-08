<?php declare(strict_types=1);

namespace App\UserInterface\Console;

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
        \Previewing\PreviewingServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,

        \App\AppServiceProvider::class,
        \App\UserInterface\Http\Admin\AdminServiceProvider::class,
        \App\UserInterface\Http\Site\SiteServiceProvider::class,
    ];
}
