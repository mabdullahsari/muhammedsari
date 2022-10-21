<?php declare(strict_types=1);

namespace Domain\Clock;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
