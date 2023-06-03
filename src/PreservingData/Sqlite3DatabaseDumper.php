<?php declare(strict_types=1);

namespace PreservingData;

use Symfony\Component\Process\Process;

final readonly class Sqlite3DatabaseDumper implements DatabaseDumper
{
    public function __construct(
        private string $database,
        private array $tables,
    ) {}

    public function dump(): string
    {
        return Process::fromShellCommandline(
            sprintf('sqlite3 %s ".dump %s"', $this->database, implode(' ', $this->tables))
        )->mustRun()->getOutput();
    }
}
