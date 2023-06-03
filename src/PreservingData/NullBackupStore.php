<?php declare(strict_types=1);

namespace PreservingData;

final readonly class NullBackupStore implements BackupStore
{
    public function preserve(string $data): void
    {
        // noop
    }
}
