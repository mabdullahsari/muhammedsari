<?php declare(strict_types=1);

namespace Domain\Clock\Contracts;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
