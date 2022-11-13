<?php declare(strict_types=1);

namespace Core\Contract\Scheduling;

interface Scheduler
{
    public function tick(): void;
}
