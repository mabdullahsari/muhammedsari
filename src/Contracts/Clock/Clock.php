<?php declare(strict_types=1);

namespace Domain\Contracts\Clock;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
