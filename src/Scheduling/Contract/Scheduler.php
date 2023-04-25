<?php declare(strict_types=1);

namespace Scheduling\Contract;

interface Scheduler
{
    public function tick(): void;
}
