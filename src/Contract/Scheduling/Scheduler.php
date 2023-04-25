<?php declare(strict_types=1);

namespace Contract\Scheduling;

interface Scheduler
{
    public function tick(): void;
}
