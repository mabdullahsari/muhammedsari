<?php declare(strict_types=1);

namespace PreservingData;

interface DatabaseDumper
{
    public function dump(): string;
}
