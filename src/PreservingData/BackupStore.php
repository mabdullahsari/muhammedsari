<?php declare(strict_types=1);

namespace PreservingData;

interface BackupStore
{
    public function preserve(string $data): void;
}
