<?php declare(strict_types=1);

namespace Clock\Contract;

use Carbon\CarbonImmutable;

interface Clock
{
    public function now(): CarbonImmutable;
}
