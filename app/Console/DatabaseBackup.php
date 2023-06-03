<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;
use PreservingData\Contract\BackUpDatabase;

final class DatabaseBackup extends Command
{
    protected $signature = 'db:backup';

    public function handle(Dispatcher $commands): int
    {
        $commands->dispatchSync(new BackUpDatabase());

        $this->info('✅  Database backed up successfully.');

        return self::SUCCESS;
    }
}
