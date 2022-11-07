<?php declare(strict_types=1);

namespace Core\Contracts\Clock;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
