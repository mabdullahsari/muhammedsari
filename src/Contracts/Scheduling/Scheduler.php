<?php declare(strict_types=1);

namespace Domain\Contracts\Scheduling;

interface Scheduler
{
    public function tick(): void;
}
