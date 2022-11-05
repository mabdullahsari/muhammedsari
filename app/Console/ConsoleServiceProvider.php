<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\AggregateServiceProvider;

final class ConsoleServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Termwind\Laravel\TermwindServiceProvider::class,
        \Laravel\Tinker\TinkerServiceProvider::class,
    ];

    public function boot(Schedule $schedule): void
    {
        $this->commands([ProcessSchedulerTick::class, PublishBlogPost::class]);

        $schedule->command('health:check')->everyThirtyMinutes();
        $schedule->command('health:schedule-check-heartbeat')->everyMinute();
        $schedule->command('scheduling:tick')->everyMinute();
    }
}
