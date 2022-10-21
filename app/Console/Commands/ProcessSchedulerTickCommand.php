<?php declare(strict_types=1);

namespace App\Console\Commands;

use Domain\Scheduling\Scheduler;
use Illuminate\Console\Command;

final class ProcessSchedulerTickCommand extends Command
{
    protected $signature = 'scheduling:tick';

    public function handle(Scheduler $scheduler): int
    {
        $scheduler->tick();

        return self::SUCCESS;
    }
}
