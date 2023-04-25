<?php declare(strict_types=1);

namespace Contract\Clock;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
