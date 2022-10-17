<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

final class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('health:check')->everyThirtyMinutes();
        $schedule->command('health:schedule-check-heartbeat')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
