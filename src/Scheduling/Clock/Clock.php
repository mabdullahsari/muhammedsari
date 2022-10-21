<?php declare(strict_types=1);

namespace Domain\Scheduling\Clock;

use DateTimeImmutable;

interface Clock
{
    public function now(): DateTimeImmutable;
}
