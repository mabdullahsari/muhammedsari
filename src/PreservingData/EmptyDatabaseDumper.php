<?php declare(strict_types=1);

namespace PreservingData;

final readonly class EmptyDatabaseDumper implements DatabaseDumper
{
    public function dump(): string
    {
        return '';
    }
}
