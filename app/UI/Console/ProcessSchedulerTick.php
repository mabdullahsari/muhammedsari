<?php declare(strict_types=1);

namespace App\UI\Console;

use Illuminate\Console\Command;
use Scheduling\Contract\Scheduler;

final class ProcessSchedulerTick extends Command
{
    protected $signature = 'scheduling:tick';

    public function handle(Scheduler $scheduler): int
    {
        $scheduler->tick();

        return self::SUCCESS;
    }
}
