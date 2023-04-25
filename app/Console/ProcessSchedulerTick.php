<?php declare(strict_types=1);

namespace App\Console;

use Contract\Scheduling\Scheduler;
use Illuminate\Console\Command;

final class ProcessSchedulerTick extends Command
{
    protected $signature = 'scheduling:tick';

    public function handle(Scheduler $scheduler): int
    {
        $scheduler->tick();

        return self::SUCCESS;
    }
}
