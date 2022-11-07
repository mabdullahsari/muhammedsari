<?php declare(strict_types=1);

namespace Core\Contracts\Scheduling;

interface Scheduler
{
    public function tick(): void;
}
