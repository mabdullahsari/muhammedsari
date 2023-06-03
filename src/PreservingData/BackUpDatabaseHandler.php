<?php declare(strict_types=1);

namespace PreservingData;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

final readonly class BackUpDatabaseHandler implements ShouldQueue
{
    use Dispatchable;

    public function __construct(
        private BackupStore $backup,
        private DatabaseDumper $database,
    ) {}

    public function handle(): void
    {
        $this->backup->preserve(
            $this->database->dump()
        );
    }
}
